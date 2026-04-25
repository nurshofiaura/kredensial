<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Member extends MY_Controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
    parent::__construct();
    $this->load->model('m_member');
    $this->m_auth->all_member();
  }
  // ========================================================================
    function menu_halaman()
    {
	    return [
	        [
	            'type'   => 'parent',
	            'id'     => 'master',
	            'label'  => 'Utama',
	            'icon'   => 'ph-duotone ph-database',
	            'children' => [
	                    ['label'=>'Laporan',            'url'=>'member/report'],
	                    ['label'=>'Biodata',            'url'=>'member/profil'],
	                    ['label'=>'Logbook',            'url'=>'ol_logbook'],
	                    ['label'=>'Latihan Pengajuan',  'url'=>'member/tes'],
	                    ['label'=>'Berkas',             'url'=>'member/berkas'],
	                    ['label'=>'Ijasah',             'url'=>'member/ijasah'],
	                    ['label'=>'Pelatihan',          'url'=>'member/pelatihan'],
	                    ['label'=>'Surat Ijin',         'url'=>'member/surat_ijin'],
	                    ['label'=>'Log Out',			'url'=>'logout']
	            ]
	        ]
	    ];
    }
  // ========================================================================
	function load()
	{
	    $jadwal = $this->m_ol_rancak->ambil_pegawai_jadwal();
	    $event  = $this->m_ol_rancak->ambil_calendar_event([
	        'barcode_pegawai' => $this->session->userdata('barcode_pegawai')
	    ]);

	    $data = [];

	    // ===== JADWAL PEGAWAI =====
	    foreach ($jadwal as $j) {
	        $data[] = [
	            'id'    => 'J-'.$j['tgl_jadwal'],
	            'title' => $j['nama_dinas_jaga'],
	            'start' => $j['tgl_jadwal'],
	            'allDay' => true,
	            'backgroundColor' => $j['kode_warna'],
	            'borderColor' => $j['kode_warna'],
	            'textColor' => $j['text_warna'],
	            'extendedProps' => [
	                'description' => $j['nama_pegawai'].' | '.$j['no_hp'],
	                'source' => 'jadwal'
	            ]
	        ];
	    }
	    // ===== EVENT MANUAL =====
	    foreach ($event as $e) {
	        $data[] = [
	            'id'    => $e['id'],
	            'title' => $e['title'],
	            'start' => $e['start_date'],
	            'end'   => $e['end_date'],
	            'allDay'=> true,
	            'backgroundColor' => $e['color'],
	            'borderColor' => $e['color'],
	            'extendedProps' => [
	                'description' => $e['description'],
	                'source' => 'event'
	            ]
	        ];
	    }

	    echo json_encode($data);
	}
	  // ADD
	function add(){

	  $start = DateTime::createFromFormat('Y-m-d', $this->input->post('start'));
	  $end   = DateTime::createFromFormat('Y-m-d', $this->input->post('end'));
	  $id = $this->m_rancak->kode_generator_urut(15,'EV');
	  $data = [
	    'id'               => $id,
	    'title'            => $this->input->post('title'),
	    'description'      => $this->input->post('description'),
	    'start_date'       => $start->format('Y-m-d'),
	    'end_date'         => $end->format('Y-m-d'),
	    'color'            => $this->input->post('color'),
	    'barcode_pegawai'  => $this->session->userdata('barcode_pegawai')
	  ];

	  $this->db->insert('calendar_event', $data);

		echo json_encode([
		  'status' => true,
		  'id'     => $id
		]);
	}
	  // GET DETAIL
	function get($id){
		echo json_encode(
		  $this->db->get_where('calendar_event',['id'=>$id])->row()
		);
	}
	  // UPDATE
	function update()
	{
	    $id = $this->input->post('id');

	    $data = [];

	    if($this->input->post('title'))
	        $data['title'] = $this->input->post('title', true);

	    if($this->input->post('description'))
	        $data['description'] = $this->input->post('description', true);

	    if($this->input->post('color'))
	        $data['color'] = $this->input->post('color');

	    if($this->input->post('start'))
	        $data['start_date'] = $this->input->post('start');

	    if($this->input->post('end'))
	        $data['end_date'] = $this->input->post('end');

	    $this->db->where('id', $id)->update('calendar_event', $data);

	    echo json_encode(['status' => true]);
	}
	// DELETE
	function delete(){
	  $id = $this->input->post('id');
	  $this->db->delete('calendar_event', ['id' => $id]);
	  echo json_encode(['status' => true]);
	}
	  // DRAG & DROP UPDATE
	function drop()
	{
	    $this->db->where('id', $this->input->post('id'))
	             ->update('calendar_event', [
	                 'start_date' => $this->input->post('start'),
	                 'end_date'   => $this->input->post('end')
	             ]);

	    echo json_encode(['status'=>true]);
	}
	function jadwal_ajax()
	{
		$data = [
		    'page'               => "jadwal_ajax",
		    'ambil_data_pegawai' => $this->m_ol_rancak->ambil_data_pegawai_unit($this->session->unit),
		    'bulan'              => $this->uri->segment(3) ?: date('m'),
		    'tahun'              => $this->uri->segment(4) ?: date('Y'),
		];
		$uni = $this->m_umum->ambil_data('ol_unit','id_unit',$this->session->unit);
		$kondisi = [
		    'bulan'   => $data['bulan'],
		    'tahun'   => $data['tahun'],
		    'id_unit' => $uni['id_unit']
		];
		$offday = $this->m_umum->ambil_data_kondisi('hari_libur', $kondisi);
		$data['tgl_hari_libur'] = !empty($offday['tgl_hari_libur']) ? explode(',', $offday['tgl_hari_libur']) : [];
		$this->load->view('member/isi', $data);
	}
	public function jadwal_dashboard_ajax($bulan = null, $tahun = null)
	{
	    $id_pegawai = $this->session->id_pegawai;

	    // kalau $bulan / $tahun null, pakai bulan & tahun sekarang
	    if (!$bulan) $bulan = date('m');
	    if (!$tahun) $tahun = date('Y');

	    // baseDate = hari ini jika bulan & tahun sama, atau tanggal 1 bulan pilih
	    if ($bulan == date('m') && $tahun == date('Y')) {
	        $baseDate = date('Y-m-d');
	    } else {
	        $baseDate = "$tahun-$bulan-01";
	    }
		$data = [
		    'page'               => "jadwal_dashboard_ajax",
		    'baseDate' 			 => $baseDate,
		    'jadwal'             => $this->m_member->jadwal_dashboard_pegawai($id_pegawai, $baseDate)
		];
	    $this->load->view('member/isi', $data);
	}
	public function pie_logbook_ajax($tahun){
	  $id_pegawai = $this->session->userdata('id_pegawai');

	  $data_raw = $this->m_member->get_logbook_pie($id_pegawai, $tahun);

	  $labels = [];
	  $data = [];
	  $colors = ['#7752FE','#78738C','#FF5733','#33C1FF','#33FF8A','#FFC733','#FF33D1'];

	  foreach($data_raw as $row){
	      $labels[] = $row['nama_kompetensi'];
	      $data[] = (int)$row['jml_logbook'];
	  }

	  // jika tidak ada data, buat default 0
	  if(empty($labels)){
	      $labels = ['Belum ada data'];
	      $data = [1];
	  }

	  echo json_encode([
	      'labels' => $labels,
	      'data' => $data,
	      'colors' => array_slice($colors,0,count($labels))
	  ]);
	}
	public function pie_pelatihan_ajax($tahun){
	  $id_pegawai = $this->session->userdata('id_pegawai');

	  $data_raw = $this->m_member->get_pelatihan_pie($id_pegawai, $tahun);

	  $labels = [];
	  $data = [];
	  $colors = ['#7752FE','#78738C','#FF5733','#33C1FF','#33FF8A','#FFC733','#FF33D1'];

	  foreach($data_raw as $row){
	      $labels[] = $row['nama_kategori_pelatihan'];
	      $data[] = (int)$row['num'];
	  }

	  // jika tidak ada data, buat default 0
	  if(empty($labels)){
	      $labels = ['Belum ada data'];
	      $data = [1];
	  }

	  echo json_encode([
	      'labels' => $labels,
	      'data' => $data,
	      'colors' => array_slice($colors,0,count($labels))
	  ]);
	}
	public function billing_lihat()
	{
		$data = [
		    'page'               => "billing_lihat",
		    'billing'             => $this->m_ol_rancak->ambil_data_mitra()
		];
	  $this->load->view('member/isi', $data);
	}
	function index(){
		$bulan = $this->uri->segment(4) ?? date('m');  // default bulan sekarang
		$tahun = $this->uri->segment(5) ?? date('Y');  // default tahun sekarang

		$id_pegawai = $this->session->id_pegawai;

    	$pelatihan = $this->m_ol_rancak->ambil_struktur_lihat_pelatihan($id_pegawai);

	    // Hitung total kredit
	    $total_kredit = 0;
	    $kategori_data = [];
	    foreach($pelatihan as $row) {
	        $total_kredit += $row['kredit'];
	        // Hitung kredit per kategori
	        if(isset($kategori_data[$row['nama_kategori_pelatihan']])){
	            $kategori_data[$row['nama_kategori_pelatihan']] += $row['kredit'];
	        } else {
	            $kategori_data[$row['nama_kategori_pelatihan']] = $row['kredit'];
	        }
	    }

	    // baseDate default = hari ini jika bulan & tahun sama, atau tgl 1 bulan terpilih
	    if ($bulan == date('m') && $tahun == date('Y')) {
	        $baseDate = date('Y-m-d');
	    } else {
	        $baseDate = "$tahun-$bulan-01";
	    }

	    $trend = $this->m_member->lt_trend($id_pegawai, 10); // top 10 kompetensi
	    $data['categories_json'] = json_encode($trend['categories']);
	    $data['series_json'] = json_encode($trend['series']);

		$tahun_list = $this->m_member->get_tahun_logbook($id_pegawai);

		$periode = [];
		for ($i = 6; $i >= 0; $i--) {
		    $tgl = date('Y-m-d', strtotime("-$i days"));
		    $periode[$tgl] = 0; // default 0 jam
		}
		$data_db = $this->m_member->logbook_mingguan($this->session->id_pegawai);
		$total_bulan = $this->m_member->total_logbook_bulanan($this->session->id_pegawai);
		foreach ($data_db as $row) {
		    $tgl = $row['tanggal'];
		    if (isset($periode[$tgl])) {
		        $periode[$tgl] = (int)$row['total_jam'];
		    }
		}
		$labels = [];
		$spent  = [];
		$total = [];
		$akumulasi = 0;

		foreach ($periode as $tgl => $jam) {
		    $labels[] = date('D', strtotime($tgl)); // Mon Tue Wed...
		    $spent[]  = $jam;
		    $total[]  = $akumulasi; 
		}

		// isi array total dengan nilai yang sama (7 hari)
		//	$total = array_fill(0, 7, $total_bulan);

		$pie = $this->m_member->logbook_pie_bulanan($this->session->id_pegawai);

		$pie_series = [];
		$pie_labels = [];

		foreach ($pie as $row) {
		    $pie_series[] = (int)$row['total_jam'];
		    $pie_labels[] = $row['nama_kompetensi'];
		}
		if (empty($pie_series)) {
		    $data['pie_series'] = json_encode([0]);
		    $data['pie_labels'] = json_encode(['Belum ada data']);
		}
	// 	$data = array_merge($data, [
	 	$data = [
	      'page'          		=> 'home',
	      'header'        		=> 'BERANDA',
	      'title'         		=> 'BERANDA',
	      'ambil_data_pegawai'	=> $this->m_ol_rancak->ambil_data_pegawai_unit($this->session->unit),
	      'cmd_bulan'     		=> $this->m_rancak->dropdown_bulan(),
	      'cmd_tahun'     		=> $this->m_rancak->dropdown_tahun(5),
	      'bulan'         		=> $this->uri->segment(4) ?: date('m'),
	      'tahun'         		=> $this->uri->segment(5) ?: date('Y'),
	      'labels'      			=> json_encode($labels),
	      'spent'      				=> json_encode($spent),
	      'total'      				=> json_encode($total),
	      'pie_series'      				=> json_encode($pie_series),
	      'pie_labels'      				=> json_encode($pie_labels),
	      'kategori_labels'    	=> array_keys($kategori_data),
	      'kategori_values'    	=> array_values($kategori_data),
	      'baseDate'      		=> $baseDate,
	      'cards'      			=> $this->generate_cards(),
	      'categories_json'		=> json_encode($trend['categories']),
	      'series_json'			=> json_encode($trend['series']),
		  'jadwal' 		  		=> $this->m_member->jadwal_dashboard_pegawai($this->session->id_pegawai, $baseDate),
		  'grafik' 		  		=> $this->m_member->get_logbook_bulan_ini(),
		  'tahun_list' 	 		=> $this->m_member->get_tahun_logbook($id_pegawai),
		  'tahun_pie' 			=> !empty($tahun_list) ? max($tahun_list) : date('Y')
	  ];
		$this->renderpage('home', $data, 'ra');
	}
	public function upload_images()
	{
	    $id_pegawai = $this->input->post('id_pegawai', true);

	    if (empty($_FILES['image']['name'])) {
	        echo json_encode(['status' => 'error', 'message' => 'Tidak ada file yang diupload']);
	        return;
	    }

	    $config['upload_path']   = './assets/foto/ol/';
	    $config['allowed_types'] = 'jpg|jpeg|png';
	    $config['max_size']      = 2048; // 2MB
	    $config['file_name']     = 'avatar_' . $id_pegawai . '_' . time();

	    $this->load->library('upload', $config);

	    if (!$this->upload->do_upload('image')) {
	        echo json_encode(['status' => 'error', 'message' => strip_tags($this->upload->display_errors())]);
	        return;
	    }

	    // Hapus file lama jika ada
	    $user_pic = $this->m_umum->ambil_data('pegawai','id_pegawai',$id_pegawai);
	    $cek_file = FCPATH.'assets/foto/ol/'.$user_pic['foto'];
	    if(file_exists($cek_file) && !empty($user_pic['foto'])){
	        unlink($cek_file);
	    }

	    $uploadData = $this->upload->data();

	    // Simpan nama file saja di DB
	    $data = ['foto' => $uploadData['file_name']];
	    $this->db->where('id_pegawai', $id_pegawai);
	    $this->db->update('ol_pegawai', $data);

	    // Kirim URL yang benar ke JS
	    echo json_encode([
	        'status' => 'success',
	        'url_thumb' => base_url('assets/foto/ol/' . $uploadData['file_name'])
	    ]);
	}
	public function upload_image()
	{
	    $id_pegawai = $this->input->post('id_pegawai', true);

	    if (empty($_FILES['image']['name'])) {
	        echo json_encode([
	            'status' => 'error', 
	            'message' => 'Tidak ada file yang diupload'
	        ]);
	        return;
	    }

	    $config['upload_path']   = './assets/foto/ol/';
	    $config['allowed_types'] = 'jpg|jpeg|png';
	    $config['max_size']      = 2048; // 2MB
	    $config['file_name']     = 'avatar_' . $id_pegawai . '_' . time();

	    $this->load->library('upload', $config);

	    if (!$this->upload->do_upload('image')) {
	        echo json_encode([
	            'status' => 'error', 
	            'message' => strip_tags($this->upload->display_errors())
	        ]);
	        return;
	    }

	    // Hapus file lama jika ada
	    $user_pic = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$id_pegawai);
	    $cek_file = FCPATH.'assets/foto/ol/'.$user_pic['foto'];
	    if(file_exists($cek_file) && !empty($user_pic['foto'])){
	        unlink($cek_file);
	    }

	    $uploadData = $this->upload->data();

	    // Simpan nama file saja di DB
	    $data = ['foto' => $uploadData['file_name']];
	    $this->db->where('id_pegawai', $id_pegawai);
	    $this->db->update('ol_pegawai', $data);

	    // Kirim response JSON lengkap
	    echo json_encode([
	        'status'    => 'success',
	        'message'   => 'Foto profil berhasil diperbarui!',
	        'url_thumb' => base_url('assets/foto/ol/' . $uploadData['file_name'])
	    ]);
	}
	function profil()
	{
	    $pegawai = $this->data['pegawai'];

	    // ==========================
	    // JIKA POST -> UPDATE
	    // ==========================
	    if ($this->input->post()) {

	        $id_pegawai = $this->input->post('id_pegawai', true);

	        // username wajib
	        $username = strtolower($this->input->post('username', true));
	        $username = str_replace(' ', '-', $username);
	        $username = preg_replace('/[^A-Za-z0-9\-]/', '', $username);

	        if (empty($username)) {
	            $this->session->set_flashdata('error', 'Username tidak boleh kosong!');
	            redirect('member/profil');
	        }

	        // password optional
	        $password = $this->input->post('password', true);

	        // konversi tgl_lahir
	        $tgl_lahir_input = $this->input->post('tgl_lahir', true);
	        $tgl_lahir_db = null;

	        if (!empty($tgl_lahir_input)) {
	            $tgl_lahir_db = date('Y-m-d', strtotime(str_replace('/', '-', $tgl_lahir_input)));
	        }

	        // ==========================
	        // DATA UPDATE PEGAWAI
	        // ==========================
	        $dataPegawai = [
	            'nama_pegawai'          => $this->input->post('nama_pegawai', true),
	            'tmp_lahir'             => $this->input->post('tmp_lahir', true),
	            'tgl_lahir'             => $tgl_lahir_db,
	            'jk'                    => $this->input->post('jk', true),
	            'id_status_kawin'       => $this->input->post('id_status_kawin', true),
	            'id_agama'              => $this->input->post('id_agama', true),
	            'tipe_pegawai'          => $this->input->post('tipe_pegawai', true),
	            'id_jabatan_fungsional' => $this->input->post('id_jabatan_fungsional', true),
	            'nip'                   => $this->input->post('nip', true),
	            'nik'                   => $this->input->post('nik', true),
	            'no_hp'                 => $this->input->post('no_hp', true),
	            'email'                 => $this->input->post('email', true),
	            'no_profesi'            => $this->input->post('no_profesi', true),
	            'id_pendidikan'         => $this->input->post('id_pendidikan', true),
	            'alamat'                => $this->input->post('alamat', true),
	            'id_prov'               => $this->input->post('id_prov', true),
	            'id_kab'                => $this->input->post('id_kab', true),
	            'id_kec'                => $this->input->post('id_kec', true),
	            'id_kel'                => $this->input->post('id_kel', true),
	        ];

	        // ==========================
	        // DATA UPDATE USER
	        // ==========================
	        $dataUser = [
	            'username' => $username
	        ];

	        if (!empty($password)) {
	            $dataUser['password'] = password_hash($password, PASSWORD_DEFAULT);
	        }

	        // ==========================
	        // TRANSACTION UPDATE
	        // ==========================
	        $this->db->trans_begin();

	        $this->db->where('id_pegawai', $id_pegawai);
	        $this->db->update('ol_pegawai', $dataPegawai);

	        $this->db->where('id_pegawai', $id_pegawai);
	        $this->db->update('ol_user', $dataUser);

	        if ($this->db->trans_status() === FALSE) {
	            $this->db->trans_rollback();
	            $this->session->set_flashdata('error', 'Gagal update profil!');
	        } else {
	            $this->db->trans_commit();
	            $this->session->set_flashdata('success', 'Profil berhasil diperbarui!');
	        }

	        redirect('member/profil');
	    }

	    // ==========================
	    // FORM DEFAULT
	    // ==========================
	    $pegawai_fields = [
	        'id_pegawai',
	        'nama_pegawai',
	        'email',
	        'username',
	        'no_hp',
	        'jk',
	        'foto',
	        'tipe_pegawai',
	        'nik',
	        'nip',
	        'id_status_kawin',
	        'id_agama',
	        'alamat',
	        'id_pendidikan',
	        'id_jabatan_fungsional',
	        'no_profesi',
	        'tmp_lahir',
	        'id_pengcab',
	        'id_prov',
	        'id_kab',
	        'id_kec',
	        'id_kel',
	    ];

	    foreach ($pegawai_fields as $field) {
	        $form_default[$field] = $pegawai[$field] ?? null;
	    }

	    $form_default['tgl_lahir'] = !empty($pegawai['tgl_lahir'])
	        ? date('d-m-Y', strtotime($pegawai['tgl_lahir']))
	        : null;

			$form_default['username_lama'] = $pegawai['username'];
			$form_default['password_lama'] = $pegawai['password'];

	    foreach ($form_default as $field => $value) {
	        $form_data[$field] = set_value($field, $value);
	    }

	    // ==========================
	    // DATA VIEW
	    // ==========================
	    $data = [
	        'page'              => 'profil',
	        'header'            => 'PROFIL USER',
	        'title'             => 'PROFIL USER',
	        'kol_provinsi'      => $this->m_ol_rancak->cmd_kol_provinsi(),
	        'cmd_tipe_pegawai'  => $this->m_rancak->cmd_tipe_pegawai(),
	        'status'            => $this->m_rancak->cmd_status(),
	        'cmd_jabfung'       => $this->m_ol_rancak->cmd_jabatan_fungsional_no_null(),
	        'gender'            => $this->m_rancak->cmd_jk(),
	        'cmd_agama'         => $this->m_rancak->cmd_agama(),
	        'cmd_status_kawin'  => $this->m_rancak->cmd_status_kawin(),
	        'cmd_pendidikan'    => $this->m_ol_rancak->cmd_pendidikan(),

	        // FIXED CHAIN
	        'kab'               => $this->m_ol_rancak->ambil_data_dropdown_kab($pegawai['id_prov']),
	        'kec'               => $this->m_ol_rancak->ambil_data_dropdown_kec($pegawai['id_kab']),
	        'kel'               => $this->m_ol_rancak->ambil_data_dropdown_kel($pegawai['id_kec']),

	        'cards'             => $this->generate_cards()
	    ];

	    $data = array_merge($data, $form_data);

	    $this->renderpage('profil', $data, 'ra');
	}
	function report($mode = 'view')
	{
	    switch ($mode) {
		    case 'view':
		    	$pegawai = $this->data['pegawai'];

				$first_date = request('uri', 4, 'date', [
				    'required' => false,
				    'default'  => $this->session->first_date_report_mutu ?? date('Y-m-01')
				]);

				$last_date = request('uri', 5, 'date', [
				    'required' => false,
				    'default'  => $this->session->last_date_report_mutu ?? date('Y-m-d')
				]);

				$kompetensi = request('uri', 6, 'string', [
				    'required' => false,
				    'default'  => $this->session->kompetensi_report_mutu ?? null
				]);

				$range = request('uri', 7, 'string', [
				    'required' => false,
				    'default'  => $this->session->range_report_mutu ?? null
				]);

				// Jika $kategori berisi lebih dari satu, misal "1,2,3" → explode ke array
				//$kategori_array = $kategori ? array_map('trim', explode(',', $kategori)) : [];

		        $data = [
		            'page'       => 'kompetensi',
		            'header'     => 'MASTER KOMPETENSI',
		            'title'      => 'MASTER KOMPETENSI',
		            'first_date' => $first_date,
		            'last_date'  => $last_date,
		            'kompetensi' => $kompetensi,
		            'range' 	 => $range,
		            'opsi' 	 => $this->m_ol_rancak->ambil_equipment_mutu_null(),
		            'all_kah' 	 => array('0'=>'Range Tanggal','1'=>'Semua')
		        ];
		        $this->renderpage('report', $data, 'ra');
		    break;

			case 'filter':

			    $first_date  = $this->input->post('first_date', true);
			    $last_date   = $this->input->post('last_date', true);
			    $kompetensi  = $this->input->post('kompetensi', true);
			    $range       = $this->input->post('range', true);

			    // validasi minimal
			    if (!$first_date || !$last_date) {
			        $this->session->set_flashdata(
			            'danger',
			            'Periode tanggal wajib diisi'
			        );
			        redirect(base_url('member/report'));
			    }

			    // simpan ke session
			    $this->session->set_userdata([
			        'first_date_report_mutu' => $first_date,
			        'last_date_report_mutu'  => $last_date,
			        'kompetensi_report_mutu'  => $kompetensi,
			        'range_report_mutu'  => $range
			    ]);

			    redirect(
			        base_url(
			            'member/report/view/'
			            . $first_date . '/'
			            . $last_date . '/'
			            . $kompetensi . '/'
			            . $range
			        )
			    );
			break;

			case 'data_report':

			    header('Content-Type: application/json');

			    $dt  = $this->datatable_request();

				$dt['first_date']    = $this->input->post('first_date');
				$dt['last_date']     = $this->input->post('last_date');
				$dt['kompetensi'] = $this->input->post('kompetensi');
				$dt['range']   = (int)$this->input->post('range');

			    $res = $this->m_ol_rancak->datatable_report($dt);

			    $this->datatable_response(
			        $res['draw'],
			        $res['total'],
			        $res['filtered'],
			        $res['data']
			    );
			    exit;
			break;

			case 'child_report':

			    header('Content-Type: application/json');

			    // BARCODE → harus string, optional false (wajib ada)
			    $barcode = request('post', 'id_laporan', 'string', [
			        'required' => true
			    ]);

			    // datatable standard payload
			    $dt = $this->datatable_request();

			    // inject barcode ke dt supaya model konsisten 1 param saja
			    $dt['id_laporan'] = $barcode;

			    $res = $this->m_ol_rancak->child_laporan_detil($dt);

			    $this->datatable_response(
			        $res['draw'],
			        $res['total'],
			        $res['filtered'],
			        $res['data']
			    );
			    exit;
			break;

			case 'tambah':

			    $data = [
			        'page'  => 'report_tambah',
			        'header'=> 'LAPORAN TAMBAH',
			        'title' => 'LAPORAN TAMBAH',

			        'link_kembali'  => base_url('member'),
			        'link_awal'     => base_url('ol_logbook/logbook'),

			        'id_laporan' => '',

			        'header_laporan'      => set_value('header_laporan'),
			        'sub_header_laporan'  => set_value('sub_header_laporan'),
			        'sub_sub_header_laporan' => set_value('sub_sub_header_laporan'),
			        'judul_laporan'       => set_value('judul_laporan'),
			        'tujuan_laporan'      => set_value('tujuan_laporan'),
			        'sumber_laporan'      => set_value('sumber_laporan'),
			        'periode_laporan'     => set_value('periode_laporan'),

			        'tgl_laporan' => date('d-m-Y'),
			        'tgl_awal'    => date('d-m-Y'),
			        'tgl_akhir'   => date('d-m-Y')
			    ];

			    $this->load->view("member/isi",$data);

			break;

			case 'edit':

			    $data = $this->input->method() === 'post'
			        ? $this->input->post()
			        : $this->input->get();

			    $id = $data['id_laporan'] ?? null;

			    $row = $this->m_ol_rancak
			        ->get_row_laporan_by_id($id);

			    if(!$row){
			        echo "Data tidak ditemukan";
			        return;
			    }

			    $data = [
			        'page'  => 'report_edit',
			        'header'=> 'LAPORAN EDIT',
			        'title' => 'LAPORAN EDIT',

			        'link_kembali'  => base_url('member'),
			        'link_awal'     => base_url('ol_logbook/logbook'),

			        'id_laporan' => $row['id_laporan'],

			        'tgl_laporan' => date('d-m-Y',strtotime($row['tgl_laporan'])),
			        'tgl_awal'    => date('d-m-Y',strtotime($row['tgl_awal'])),
			        'tgl_akhir'   => date('d-m-Y',strtotime($row['tgl_akhir'])),

			        'header_laporan'         => $row['header_laporan'],
			        'sub_header_laporan'     => $row['sub_header_laporan'],
			        'sub_sub_header_laporan' => $row['sub_sub_header_laporan'],
			        'judul_laporan'          => $row['judul_laporan'],
			        'tujuan_laporan'         => $row['tujuan_laporan'],
			        'sumber_laporan'         => $row['sumber_laporan'],
			        'periode_laporan'        => $row['periode_laporan']
			    ];

			    $this->load->view("member/isi",$data);

			break;

			case 'simpan':

			    $session_id = $this->session->userdata('barcode_pegawai');
			    $session_unit = $this->session->userdata('unit');

			    $data_array = [

			        'header_laporan'      => trim($this->input->post('header_laporan', true)),
			        'sub_header_laporan'  => trim($this->input->post('sub_header_laporan', true)),
			        'sub_sub_header_laporan' => trim($this->input->post('sub_sub_header_laporan', true)),

			        'judul_laporan'   => trim($this->input->post('judul_laporan', true)),
			        'tujuan_laporan'  => trim($this->input->post('tujuan_laporan', true)),
			        'sumber_laporan'  => trim($this->input->post('sumber_laporan', true)),
			        'periode_laporan' => trim($this->input->post('periode_laporan', true)),

			        'tgl_laporan' => date('Y-m-d', strtotime($this->input->post('tgl_laporan'))),
			        'tgl_awal'    => date('Y-m-d', strtotime($this->input->post('tgl_awal'))),
			        'tgl_akhir'   => date('Y-m-d', strtotime($this->input->post('tgl_akhir')))
			    ];

			    // validasi
			    if(empty($data_array['judul_laporan'])){
			        echo json_encode([
			            'ok'=>false,
			            'msg'=>'Judul laporan wajib diisi'
			        ]);
			        return;
			    }

			    $id_laporan = $this->input->post('id_laporan', true);

			    $this->db->trans_begin();

			    if(!empty($id_laporan)){

			        // cek data lama
			        $old = $this->db->get_where('ol_per_laporan',[
			            'id_laporan'=>$id_laporan
			        ])->row_array();

			        if(!$old){
			            $this->db->trans_rollback();
			            echo json_encode([
			                'ok'=>false,
			                'msg'=>'Data laporan tidak ditemukan'
			            ]);
			            return;
			        }

			        // update
			        $this->db->where('id_laporan',$id_laporan);
			        $this->db->update('ol_per_laporan',$data_array);

			    }else{

			        $data_array['id_laporan'] = 
			            $this->m_rancak->kode_generator_urut(15,'RP');

			        $data_array['pembuat_laporan'] = $session_id;
			        $data_array['laporan_unit'] = $session_unit;

			        $this->db->insert('ol_per_laporan',$data_array);
			    }

			    if($this->db->trans_status() === false){
			        $this->db->trans_rollback();

			        echo json_encode([
			            'ok'=>false,
			            'msg'=>'Gagal menyimpan laporan'
			        ]);
			        return;
			    }

			    $this->db->trans_commit();

			    echo json_encode([
			        'ok'=>true,
			        'msg'=>'Laporan berhasil disimpan'
			    ]);

			break;

			case 'add_sheet':

			    $data = $this->input->method() === 'post'
			        ? $this->input->post()
			        : $this->input->get();

			    $id = $data['id_laporan'] ?? null;

			    $data = [
			        'page'  => 'add_sheet',
			        'header' => 'TAMBAH HALAMAN',
			        'title' => 'TAMBAH HALAMAN',
			        'jns_eq' => 2,
			        'ambil_tabel' => $this->m_rancak->ambil_sn_tabel(),
			        'cmd_ya_tidak' => $this->m_rancak->cmd_ya_tidak(),
			        'periode' => $this->m_rancak->cmd_periode_laporan_detil(),
			        'jenis_imut' => $this->m_rancak->jenis_imut(),
			        'id_laporan' => $id,
			        'id_laporan_detil' => '',
			        'jenis_per_laporan_detil' => set_value('jenis_per_laporan_detil'),
			        'judul_laporan_detil' => set_value('judul_laporan_detil'),
			        'analisa_laporan_detil' => set_value('analisa_laporan_detil'),
			        'rekomendasi_laporan_detil'       => set_value('rekomendasi_laporan_detil'),
			        'urutan_laporan_detil'      => 0,
			        'periode_laporan_detil'      => set_value('periode_laporan_detil'),
			        'min_laporan_detil'      => 0,
			        'max_laporan_detil'      => 0,
			        'tabel'      => set_value('tabel'),
			        'button'     => 1
			    ];

			    $this->load->view("member/isi",$data);

			break;

			case 'edit_sheet':

			    $data = [
			        'page'              		=> 'edit_sheet',
			        'header'					=> 'EDIT HALAMAN',
			        'title' 					=> 'EDIT HALAMAN',
			        'jns_eq' 					=> 2,
			        'ambil_tabel' 				=> $this->m_rancak->ambil_sn_tabel(),
			        'cmd_ya_tidak' 				=> $this->m_rancak->cmd_ya_tidak(),
			        'periode' 					=> $this->m_rancak->cmd_periode_laporan_detil(),
			        'jenis_imut' 				=> $this->m_rancak->jenis_imut(),
			        'id_laporan_detil' 			=> $this->input->get('id_laporan_detil'),
			        'id_laporan' 				=> $this->input->get('id_laporan'),
			        'urutan_laporan_detil' 		=> $this->input->get('urutan_laporan_detil'),
			        'periode_laporan_detil'		=> $this->input->get('pld'),
			        'jenis_per_laporan_detil'	=> $this->input->get('jpld'),
			        'judul_laporan_detil'  		=> $this->input->get('judul_laporan_detil'),
			        'analisa_laporan_detil'  	=> $this->input->get('analisa_laporan_detil'),
			        'rekomendasi_laporan_detil' => $this->input->get('rekomendasi_laporan_detil'),
			        'tabel'  					=> $this->input->get('tabel'),
			        'button'  					=> $this->input->get('button'),
			        'max_laporan_detil'  		=> $this->input->get('max_laporan_detil'),
			        'min_laporan_detil'  		=> $this->input->get('min_laporan_detil'),
			        'child_table_id' 			=> $this->input->get('child_table_id'),
			    ];

			    $this->load->view("member/isi",$data);
			break;
		    
			case 'save_sheet':

			    $session_id = $this->session->userdata('barcode_pegawai');
			    $session_unit = $this->session->userdata('unit');

			    $data_array = [

			        'judul_laporan_detil'      => trim($this->input->post('judul_laporan_detil', true)),
			        'tabel'  => trim($this->input->post('tabel', true)),
			        'urutan_laporan_detil' => trim($this->input->post('urutan_laporan_detil', true)),
			        'id_laporan' => trim($this->input->post('id_laporan', true)),
			        'periode_laporan_detil'   => trim($this->input->post('periode_laporan_detil', true)),
			        'jenis_per_laporan_detil'  => trim($this->input->post('jenis_per_laporan_detil', true)),
			        'min_laporan_detil'  => trim($this->input->post('min_laporan_detil', true)),
			        'max_laporan_detil' => trim($this->input->post('max_laporan_detil', true)),
			        'button' => trim($this->input->post('button', true)),
			    ];

			    // validasi
			    if(empty($data_array['judul_laporan_detil'])){
			        echo json_encode([
			            'ok'=>false,
			            'msg'=>'Judul laporan wajib diisi'
			        ]);
			        return;
			    }

			    $id_laporan_detil = $this->input->post('id_laporan_detil', true);

			    $this->db->trans_begin();

			    if(!empty($id_laporan_detil)){

			        // cek data lama
			        $old = $this->db->get_where('ol_per_laporan_detil',[
			            'id_laporan_detil'=>$id_laporan_detil
			        ])->row_array();

			        if(!$old){
			            $this->db->trans_rollback();
			            echo json_encode([
			                'ok'=>false,
			                'msg'=>'Data laporan tidak ditemukan'
			            ]);
			            return;
			        }

			        // update
			        $this->db->where('id_laporan_detil',$id_laporan_detil);
			        $this->db->update('ol_per_laporan_detil',$data_array);

			    }else{

			        $data_array['id_laporan_detil'] = 
			            $this->m_rancak->kode_generator_urut(15,'LT');

			        $this->db->insert('ol_per_laporan_detil',$data_array);
			    }

			    if($this->db->trans_status() === false){
			        $this->db->trans_rollback();

			        echo json_encode([
			            'ok'=>false,
			            'msg'=>'Gagal menyimpan laporan'
			        ]);
			        return;
			    }

			    $this->db->trans_commit();

			    echo json_encode([
			        'ok'=>true,
			        'msg'=>'Laporan berhasil disimpan'
			    ]);

			break;

		    case 'delete_sheet':

			    $data = [
			    	'page'              	=> 'delete_sheet',
			        'header'            	=> 'HAPUS HALAMAN',
			        'title'             	=> 'HAPUS HALAMAN',
			        'id_laporan_detil' 		=> $this->input->get('id_laporan_detil'),
			        'child_table_id' 		=> $this->input->get('child_table_id'),
			        'judul_laporan_detil'  	=> $this->input->get('judul_laporan_detil')
			    ];

			    $this->load->view("member/isi",$data);
		    break;

			case 'remove_sheet':

			    $id_laporan_detil = $this->input->post('id_laporan_detil');

			    $this->db->where('id_laporan_detil', $id_laporan_detil);
			    $ok = $this->db->update('ol_per_laporan_detil', [
			        'deleted_by' => $this->session->userdata('barcode_pegawai'),
			        'deleted_at' => date('Y-m-d H:i:s')
			    ]);

			    echo json_encode([
			        'ok'  => $ok,
			        'msg' => $ok ? 'Data berhasil dihapus' : 'Hapus gagal'
			    ]);
			break;
	    }
	}
//===================================================== LAPORAN
  function reports($mode='view'){
    $data['page']="reports";
    $data['title'] = "LAPORAN";
    $data['header'] = "LAPORAN PERSONAL";
		$this->m_auth->hak_member();
				$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
		$data['ambil_data_a_enabled'] = $this->m_ol_rancak->ambil_data_a_enabled();
//		$data['ol_akses'] = $this->m_ol_rancak->ol_akses($this->session->id_pegawai);
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
		$data['photo'] = $pegawai["foto"];
    //======================= IMPORTANT =========================================
    $data['id'] = $this->uri->segment(4, 0);
    $data['id2'] = $this->uri->segment(5, 0);
    $data['id3'] = $this->uri->segment(6, 0);
    $data['id4'] = $this->uri->segment(7, 0);
    $kon = array('status_equipment'=>1,'id_unit'=>$this->session->unit);
    $data['opsi'] = $this->m_ol_rancak->ambil_equipment_mutu_null($kon);
    $data['all_kah'] = array('0'=>'Range Tanggal','1'=>'Semua');
    if($mode=='view'){
      if(empty($data['id'])){
        if($this->session->has_userdata('tgl_report_imutu1')){
          $data['id'] = $this->session->tgl_report_imutu1;
        }else{
          $data['id'] = '01-'.date('m-Y');
        }
      }
      if(empty($data['id2'])){
        if($this->session->has_userdata('tgl_report_imutu2')){
          $data['id2'] = $this->session->tgl_report_imutu2;
        }else{
          $data['id2'] = date('d-m-Y');
        }
      }
      if(empty($data['id3'])){
        if($this->session->has_userdata('opsi_report_imutu')){
          $data['id3'] = $this->session->opsi_report_imutu;
        }else{
          $data['id3'] = 0;
        }
      }
      if(empty($data['id4'])){
        if($this->session->has_userdata('range_report_imutu')){
          $data['id4'] = $this->session->range_report_imutu;
        }else{
          $data['id4'] = 1;
        }
      }
      $this->tampil($data);
      $action = $this->input->post('action');
      if($action == 'BtnProses') {
        $first_date = $this->input->post("id");
        $last_date = $this->input->post("id2");
        $opsi_report_imutu = $this->input->post("id3");
        $range_report_imutu = $this->input->post("id4");
        $data_user_level = array(
          'tgl_report_imutu1'     => $first_date,
          'tgl_report_imutu2'     => $last_date,
          'opsi_report_imutu'     => $opsi_report_imutu,
          'range_report_imutu'     => $range_report_imutu
        );
        $this->session->set_userdata($data_user_level); 
        redirect(base_url('member/'.$data['page'].'/view/'.$first_date.'/'.$last_date.'/'.$opsi_report_imutu.'/'.$range_report_imutu));
      }
    }
    else if($mode=='data'){
      echo json_encode($this->m_member->laporan_all($data['id'],$data['id2'],$data['id3'],$data['id4'],1));
    }
    else{
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
        $data['tgl_laporan']  = set_value('tgl_laporan',date('d-m-Y'));
        $data['tgl_awal']  = set_value('tgl_awal',date('d-m-Y'));
        $data['tgl_akhir']  = set_value('tgl_akhir',date('d-m-Y'));           
        $data['header_laporan']  = set_value('header_laporan',$this->input->post("header_laporan"));        
        $data['sub_header_laporan']  = set_value('sub_header_laporan',$this->input->post("sub_header_laporan"));        
        $data['sub_sub_header_laporan']  = set_value('sub_sub_header_laporan',$this->input->post("sub_sub_header_laporan"));        
        $data['judul_laporan']  = set_value('judul_laporan',$this->input->post("judul_laporan"));       
        $data['tujuan_laporan']  = set_value('tujuan_laporan',$this->input->post("tujuan_laporan"));        
        $data['sumber_laporan']  = set_value('sumber_laporan',$this->input->post("sumber_laporan"));              
        $data['periode_laporan']  = set_value('periode_laporan',$this->input->post("periode_laporan"));       
        $this->load->view("member/isi",$data);
      }
      if($mode=='simpan_tambah'){
            if($this->m_member->simpan_report()){
              $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
              redirect(base_url('member/report'));
            }else{
              $this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
              redirect(base_url('member/report'));
            }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
        $keuangan = $this->m_umum->ambil_data('ol_per_laporan','id_laporan',$data['id']);   
        $data['tgl_laporan']  = set_value('tgl_laporan',date('d-m-Y', strtotime($keuangan["tgl_laporan"])));
        $data['tgl_awal']  = set_value('tgl_awal',date('d-m-Y', strtotime($keuangan["tgl_awal"])));
        $data['tgl_akhir']  = set_value('tgl_akhir',date('d-m-Y', strtotime($keuangan["tgl_akhir"])));
        $data['id_laporan']  = set_value('id_laporan',$keuangan["id_laporan"]);
        $data['header_laporan']  = set_value('header_laporan',$keuangan["header_laporan"]);
        $data['sub_header_laporan']  = set_value('sub_header_laporan',$keuangan["sub_header_laporan"]);
        $data['sub_sub_header_laporan']  = set_value('sub_sub_header_laporan',$keuangan["sub_sub_header_laporan"]);
        $data['judul_laporan']  = set_value('judul_laporan',$keuangan["judul_laporan"]);
        $data['tujuan_laporan']  = set_value('tujuan_laporan',$keuangan["tujuan_laporan"]);
        $data['sumber_laporan']  = set_value('sumber_laporan',$keuangan["sumber_laporan"]);
        $data['periode_laporan']  = set_value('periode_laporan',$keuangan["periode_laporan"]);
        $this->load->view("member/isi",$data);
      }
      if($mode=='simpan_edit'){
      $id_laporan = $this->input->post('id_laporan');
      $kondisi=array('pembuat_laporan'=>$this->session->barcode_pegawai,'id_laporan'=>$id_laporan);
      $jml = $this->m_umum->jumlah_record_filter('ol_per_laporan',$kondisi);
      if($jml == 0){
          $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
          redirect(base_url('member/report'));
      }else{
          if($this->m_member->rubah_report()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
            redirect(base_url('member/report'));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
            redirect(base_url('member/report'));
          }
        }
      }
    }
  }
  function sheet($mode='view'){
    $data['page']="sheet";
    $data['title'] = "LAPORAN";
    $data['header'] = "LAPORAN PERSONAL";
    $data['link_kembali'] = base_url('member/report');
    $data['link_awal'] = base_url('member/report');
		$this->m_auth->hak_member();
				$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
		$data['ambil_data_a_enabled'] = $this->m_ol_rancak->ambil_data_a_enabled();
//		$data['ol_akses'] = $this->m_ol_rancak->ol_akses($this->session->id_pegawai);
		$data['instance_id'] = $instansi["id_instansi"];
		$data['instance_name'] = $instansi["nama_instansi"];
		$data['idescription'] = $instansi["description"];
		$data['ikeywords'] = $instansi["keywords"];
		$data['iheader'] = $instansi["header"];
		$data['iheader_mini'] = $instansi["header_mini"];
		$data['ifooter'] = $instansi["footer"];
		$data['ilicensed'] = $instansi["licensed"];
		$data['member_id'] = $pegawai["id_pegawai"];
		$data['level_name'] = 'MEMBER';
		$data['member_name'] = $pegawai["nama_pegawai"];
		$data['photo'] = $pegawai["foto"];   
    //======================= IMPORTANT =========================================
    $data['idlap'] = $this->uri->segment(4, 0);
    $data['iddet'] = $this->uri->segment(5, 0);
    //======================= LINK =========================================
    $lp = $this->m_ol_rancak->ambil_data_per_laporan_detil($data['iddet']); // id_laporan_detil
    $data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
    $data['nama_pegawai']  = set_value('nama_pegawai',$lp["nama_pegawai"]);
    $data['id_equipment']  = set_value('id_equipment',$lp["id_equipment"]);
    $data['nama_unit']  = set_value('nama_unit',$lp["nama_unit"]);
    $data['tgl_laporan']  = set_value('tgl_laporan',date('d-m-Y', strtotime($lp["tgl_laporan"])));
    $data['tgl_awal']  = set_value('tgl_awal',date('d-m-Y', strtotime($lp["tgl_awal"])));
    $data['tgl_akhir']  = set_value('tgl_akhir',date('d-m-Y', strtotime($lp["tgl_akhir"])));
    $data['id_pegawai']  = set_value('id_pegawai',$lp["id_pegawai"]);
    $data['barcode_pegawai']  = set_value('barcode_pegawai',$lp["barcode_pegawai"]);
    $data['header_laporan']  = set_value('header_laporan',$lp["header_laporan"]);
    $data['sub_header_laporan']  = set_value('sub_header_laporan',$lp["sub_header_laporan"]);
    $data['sub_sub_header_laporan']  = set_value('sub_sub_header_laporan',$lp["sub_sub_header_laporan"]);
    $data['judul_laporan']  = set_value('judul_laporan',$lp["judul_laporan"]);
    $data['tujuan_laporan']  = set_value('tujuan_laporan',$lp["tujuan_laporan"]);
    $data['periode_laporan']  = set_value('periode_laporan',$lp["periode_laporan"]);
    $data['sumber_laporan']  = set_value('sumber_laporan',$lp["sumber_laporan"]);
    $data['id_laporan_detil']  = set_value('id_laporan_detil',$lp["id_laporan_detil"]);
    $data['judul_laporan_detil']  = set_value('judul_laporan_detil',$lp["judul_laporan_detil"]);
    $data['analisa_laporan_detil']  = set_value('analisa_laporan_detil',$lp["analisa_laporan_detil"]);
    $data['rekomendasi_laporan_detil']  = set_value('rekomendasi_laporan_detil',$lp["rekomendasi_laporan_detil"]);
    $data['min_laporan_detil']  = set_value('min_laporan_detil',$lp["min_laporan_detil"]);
    $data['max_laporan_detil']  = set_value('max_laporan_detil',$lp["max_laporan_detil"]);
    $data['periode_laporan_detil']  = set_value('periode_laporan_detil',$lp["periode_laporan_detil"]);
    $data['numerator_laporan_detil']  = set_value('numerator_laporan_detil',$lp["numerator_laporan_detil"]);
    $data['denumerator_laporan_detil']  = set_value('denumerator_laporan_detil',$lp["denumerator_laporan_detil"]);
    $data['nudenum']  = set_value('nudenum',$lp["nudenum"]);
    $data['urutan_laporan_detil']  = set_value('urutan_laporan_detil',$lp["urutan_laporan_detil"]);
    $data['equipment_detil']  = set_value('equipment_detil',$lp["equipment_detil"]);
    $data['show_pdf']  = set_value('show_pdf',$lp["show_pdf"]);
    $data['tabel']  = set_value('tabel',$lp["tabel"]);
    $data['button']  = set_value('button',$lp["button"]);
    $data['jenis_per_laporan_detil']  = set_value('jenis_per_laporan_detil',$lp["jenis_per_laporan_detil"]);
    //========================================================
  //  $data['jns_eq'] = array('1','2');
    $data['jns_eq'] = 2;
    //========================================================
    $kondisi_cek = array('id_laporan_detil'=>$data['iddet'],'pembuat_laporan'=>$this->session->barcode_pegawai);
    $data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_per_laporan_detil',$kondisi_cek,'ol_per_laporan','id_laporan');
    $data['ambil_tabel'] = $this->m_rancak->ambil_sn_tabel();
    $data['cmd_ya_tidak'] = $this->m_rancak->cmd_ya_tidak();
    $data['periode'] = $this->m_rancak->cmd_periode_laporan_detil();
    $data['jenis_imut'] = $this->m_rancak->jenis_imut();
    //========================================================
    if($mode=='view'){
      $this->tampil_top($data);
    }
    else if($mode=='data'){
      echo json_encode($this->m_member->laporan_detil_all($data['idlap'],1));
    }
    else{
      $kon = array('status_per_imqc'=>1,'id_unit'=>$this->session->unit,'pembuat_per_imqc'=>$this->session->barcode_pegawai);
      $data['equipment'] = $this->m_ol_rancak->ambil_per_imqc($kon);
      if($mode=='tambah_tabel'){
        $data['page'] =  $data['page']."_tambah_tabel";   
        $data['min_laporan_detil']  = set_value('min_laporan_detil',0);       
        $data['max_laporan_detil']  = set_value('max_laporan_detil',0);             
        $data['periode_laporan_detil']  = set_value('periode_laporan_detil',2);             
        $data['analisa_laporan_detil']  = set_value('analisa_laporan_detil','Analisa : ');             
        $data['rekomendasi_laporan_detil']  = set_value('rekomendasi_laporan_detil','Hasil / Rekomendasi : ');
        $data['jenis_per_laporan_detil']  = set_value('jenis_per_laporan_detil',$this->input->post("jenis_per_laporan_detil")); 
        $kondisi_cek = array('id_laporan'=>$data['idlap'],'pembuat_laporan'=>$this->session->barcode_pegawai);
        $data['cek'] = $this->m_umum->jumlah_record_filter('ol_per_laporan',$kondisi_cek);
        $this->load->view("member/isi",$data);
      }
      if($mode=='simpan_tambah_tabel'){
        $id_laporan = $this->input->post("id_laporan");
        $tabel = $this->input->post("tabel");
        $id_equipment = $this->input->post("id_equipment");
        $kondisi=array('pembuat_laporan'=>$this->session->barcode_pegawai,'id_laporan'=>$id_laporan);
        $jml = $this->m_umum->jumlah_record_filter('ol_per_laporan',$kondisi);
        if($jml == 0){
            $this->session->set_flashdata('danger', 'Hanya Dapat Mengakses Data Sendiri');
            redirect(base_url('member/report'));
        }else{
          if($tabel){
      //      if($id_equipment){
              if($Q = $this->m_member->tambah_tabel_per_laporan()){
                $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
                redirect(base_url('member/sheet/view/'.$id_laporan.'/'.$Q));
              }else{
                $this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
                redirect(base_url('member/sheet/view/'.$id_laporan.'/'.$Q));
              }
/*            }else{
               $this->session->set_flashdata('danger', 'Belum Ada Data');
              redirect(base_url('member/report'));              
            }*/
          }else{
             $this->session->set_flashdata('danger', 'Data Tabel Kosong');
            redirect(base_url('member/report'));           
          }
        }
      }
      if($mode=='rubah_tabel'){
        $data['page'] =  $data['page']."_rubah_tabel"; 
        $this->load->view("member/isi",$data);
      }
      if($mode=='simpan_rubah_tabel'){
      $id_laporan = $this->input->post('id_laporan');
      $id_laporan_detil = $this->input->post('id_laporan_detil');
      $tabel = $this->input->post('tabel');
      $id_equipment = $this->input->post('id_equipment');
      $kondisi=array('pembuat_laporan'=>$this->session->barcode_pegawai,'ol_per_laporan_detil.id_laporan'=>$id_laporan);
      $jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_per_laporan_detil',$kondisi,'ol_per_laporan','id_laporan');
      if($jml == 0){
          $this->session->set_flashdata('danger', 'Hanya Dapat Mengakses Data Sendiri');
          redirect(base_url('member/sheet/view/'.$id_laporan.'/'.$id_laporan_detil));
      }else{
        if($tabel){
  //        if($id_equipment){
              if($this->m_member->rubah_tabel_per_laporan()){
                $this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
                redirect(base_url('member/sheet/view/'.$id_laporan.'/'.$id_laporan_detil));
              }else{
                $this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
                redirect(base_url('member/sheet/view/'.$id_laporan.'/'.$id_laporan_detil));
              }
/*            }else{
              $this->session->set_flashdata('danger', 'Belum Ada Data');
              redirect(base_url('member/sheet/view/'.$id_laporan.'/'.$id_laporan_detil));               
            }*/
          }else{
            $this->session->set_flashdata('danger', 'Data Tabel Kosong');
            redirect(base_url('member/sheet/view/'.$id_laporan.'/'.$id_laporan_detil));           
          }
        }
      }
      if($mode=='clone'){
        $data['page'] =  $data['page']."_clone"; 
        $this->load->view("member/isi",$data);
      }
      if($mode=='simpan_clone'){
      $id_laporan = $this->input->post('id_laporan');
      $id_laporan_detil = $this->input->post('id_laporan_detil');
      $tabel = $this->input->post('tabel');
      $kondisi=array('pembuat_laporan'=>$this->session->barcode_pegawai,'ol_per_laporan_detil.id_laporan'=>$id_laporan);
      $jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_per_laporan_detil',$kondisi,'ol_per_laporan','id_laporan');
      if($jml == 0){
          $this->session->set_flashdata('danger', 'Hanya Dapat Mengakses Data Sendiri');
          redirect(base_url('member/sheet/view/'.$id_laporan.'/'.$id_laporan_detil));
      }else{
        if($tabel){
            if($this->m_member->tambah_tabel_per_laporan()){
              $this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
              redirect(base_url('member/sheet/view/'.$id_laporan.'/'.$id_laporan_detil));
            }else{
              $this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
              redirect(base_url('member/sheet/view/'.$id_laporan.'/'.$id_laporan_detil));
            }
          }else{
            $this->session->set_flashdata('danger', 'Data Tabel Kosong');
            redirect(base_url('member/sheet/view/'.$id_laporan.'/'.$id_laporan_detil));           
          }
        }
      }
    if($mode=='seting_im'){
      $data['page'] =  $data['page']."_seting_im";
      if($lp["jenis_per_laporan_detil"] == 2){
        $data['chk_eq_detil'] = $this->m_member->ambil_equipment_lap($data['iddet'],'ol_per_imqc_detil.id_per_imqc',$data['jns_eq']);
        $data['coun_kat_lv1'] = 'coun_per_imqc';
        $data['nama_kat_lv1'] = 'nama_per_imqc';
      }
      else if($lp["jenis_per_laporan_detil"] == 3){
        $data['chk_eq_detil'] = $this->m_member->ambil_logbook_laporan($data['iddet'],'nkr_kewenangan.id_kompetensi');
        $data['coun_kat_lv1'] = 'coun_kompetensi';
        $data['nama_kat_lv1'] = 'nama_kompetensi';
      }
      else if($lp["jenis_per_laporan_detil"] == 4){
        $data['chk_eq_detil'] = $this->m_member->ambil_equipment_ruangan($data['iddet'],'ol_eq_detil.id_equipment',2);
        $data['coun_kat_lv1'] = 'coun_equipment';
        $data['nama_kat_lv1'] = 'nama_equipment';
      }
      else if($lp["jenis_per_laporan_detil"] == 5){
        $data['chk_eq_detil'] = $this->m_member->ambil_berkas_personal('ol_berkas.id_kategori_berkas');
        $data['coun_kat_lv1'] = 'id_berkas_kategori';
        $data['nama_kat_lv1'] = 'nama_berkas_kategori';
      }
      $this->load->view("member/isi",$data);
    }
    if($mode=='simpan_seting_im'){
      $id_laporan = $this->input->post("id_laporan");
      $id_laporan_detil = $this->input->post("id_laporan_detil");
      $kondisi=array('pembuat_laporan'=>$this->session->barcode_pegawai,'ol_per_laporan_detil.id_laporan'=>$id_laporan);
      $jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_per_laporan_detil',$kondisi,'ol_per_laporan','id_laporan');
        if($jml == 0){
            $this->session->set_flashdata('danger', 'Hanya Dapat Mengakses Data Sendiri');
            redirect(base_url('member/sheet/view/'.$id_laporan.'/'.$id_laporan_detil));
        }else{
            $this->m_member->simpan_eq_lap();
            $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
            redirect(base_url('member/sheet/view/'.$id_laporan.'/'.$id_laporan_detil));
        }
      }
    if($mode=='seting'){
      $data['page'] =  $data['page']."_seting";
      if($lp["jenis_per_laporan_detil"] == 2){
        $data['chk_eq_detil'] = $this->m_member->ambil_eq_detil($data['iddet'],'ol_per_imqc_hasil.id_per_imqc_detil',$data['jns_eq']);
        $data['coun_kat_lv1'] = 'coun_per_imqc';
        $data['nama_kat_lv1'] = 'nama_per_imqc';
        $data['coun_kat_lv2'] = 'coun_per_imqc_detil';
        $data['nama_kat_lv2'] = 'nama_per_imqc_detil';
      }
      else if($lp["jenis_per_laporan_detil"] == 3){
        $data['chk_eq_detil'] = $this->m_member->ambil_logbook_detil($data['iddet'],'ol_logbook.id_kewenangan');
        $data['coun_kat_lv1'] = 'coun_kompetensi';
        $data['nama_kat_lv1'] = 'nama_kompetensi';
        $data['coun_kat_lv2'] = 'coun_kewenangan';
        $data['nama_kat_lv2'] = 'nama_kewenangan';
      }
      else if($lp["jenis_per_laporan_detil"] == 4){
        $data['chk_eq_detil'] = $this->m_member->ambil_eq_unit_detil($data['iddet'],'ol_eq_imut.id_eq_detil',2);
        $data['coun_kat_lv1'] = 'coun_equipment';
        $data['nama_kat_lv1'] = 'nama_equipment';
        $data['coun_kat_lv2'] = 'coun_eq_detil';
        $data['nama_kat_lv2'] = 'nama_eq_detil';
      }
      else if($lp["jenis_per_laporan_detil"] == 5){
        $data['chk_eq_detil'] = $this->m_member->ambil_berkas_personal();
        $data['coun_kat_lv1'] = 'id_berkas_kategori';
        $data['nama_kat_lv1'] = 'nama_berkas_kategori';
        $data['coun_kat_lv2'] = 'id_berkas';
        $data['nama_kat_lv2'] = 'nama_berkas';
      }
      $this->load->view("member/isi",$data);
    }
    if($mode=='simpan_seting'){
      $id_laporan = $this->input->post("id_laporan");
      $id_laporan_detil = $this->input->post("id_laporan_detil");
      $kondisi=array('pembuat_laporan'=>$this->session->barcode_pegawai,'ol_per_laporan_detil.id_laporan'=>$id_laporan);
      $jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_per_laporan_detil',$kondisi,'ol_per_laporan','id_laporan');
        if($jml == 0){
            $this->session->set_flashdata('danger', 'Hanya Dapat Mengakses Data Sendiri');
            redirect(base_url('member/sheet/view/'.$id_laporan.'/'.$id_laporan_detil));
        }else{
            $this->m_member->simpan_eq_detil();
            $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
            redirect(base_url('member/sheet/view/'.$id_laporan.'/'.$id_laporan_detil));
        }
      }
    }
  }
//===================================================== !LAPORAN
 // ================================================ USER ==================================
  public function check_unique()
  {
      $fields = [];

      if ($this->input->post('nip')) {
          $fields['nip'] = $this->input->post('nip', true);
      }
      if ($this->input->post('nik')) {
          $fields['nik'] = $this->input->post('nik', true);
      }
      if ($this->input->post('username')) {
          $username = strtolower($this->input->post('username', true));
          $username = str_replace(' ', '-', $username);
          $username = preg_replace('/[^A-Za-z0-9\-]/', '', $username);
          $fields['username'] = $username;
      }
      if ($this->input->post('email')) {
          $fields['email'] = $this->input->post('email', true);
      }

      if (empty($fields)) {
          echo "<span style='color:red'>Tidak ada field untuk dicek.</span>";
          return;
      }

      // panggil helper universal
      check_unique_field('ol_pegawai', $fields);
  }
	
  function kab_data($id)
  {
    $dt=$this->m_rancak->ambil_data_dropdown_kab($id);
    echo json_encode($dt);
  }
  function kec_data($id)
  {
    $dt=$this->m_rancak->ambil_data_dropdown_kec($id);
    echo json_encode($dt);
  }
  function kel_data($id)
  {
    $dt=$this->m_rancak->ambil_data_dropdown_kel($id);
    echo json_encode($dt);
  }
  function jabfung_data($id)
  {
    if($id < 3){
      $ids = '1';
    }else{
      $ids = '3';
    }
    $dt=$this->m_rancak->ambil_data_dropdown_jabfung_status($ids);
    echo json_encode($dt);
  }
 // ================================================ TES ==================================
	function tes($mode='view'){
		$data['page']="tes";
		$data['header'] = "TES / LATIHAN PENGAJUAN KOMPETENSI / KREDENSIAL";
		$data['title'] = "TES / LATIHAN PENGAJUAN KOMPETENSI / KREDENSIAL";
		$this->m_auth->hak_member();
		$data['kembali'] = base_url('member/tes');	
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$kondisi_lunas = array('barcode_pegawai'=>$this->session->barcode_pegawai,'status_lunas'=>1);
		$kondisi_blm_lunas = array('barcode_pegawai'=>$this->session->barcode_pegawai,'status_pengajuan_temp'=>1);
		$data['asesor'] = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
		$data['lunas'] = $this->m_umum->jumlah_record_filter('ol_pengajuan',$kondisi_lunas);
		$data['blm_lunas'] = $this->m_umum->jumlah_record_filter('ol_pengajuan_temp',$kondisi_blm_lunas);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$grade = $this->m_umum->ambil_data('ol_pegawai_grade','id_grade',$pegawai['id_grade']);
		$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
		$data['ambil_data_a_enabled'] = $this->m_ol_rancak->ambil_data_a_enabled();
		$data['ambil_data_instansi'] = $this->m_ol_rancak->ambil_data_instansi();
		$data['ambil_data_instansi_null'] = $this->m_ol_rancak->ambil_data_instansi_null();
		$data['ambil_data_ab'] = $this->m_umum->ambil_data('aplikasi_bayar','id_konsumen',$this->session->id_pegawai);
		$data['my_instansi'] = $this->m_umum->ambil_data('kol_working','id_working',$this->session->refer);
		$data['my_unit'] = $this->m_umum->ambil_data('ol_unit','id_unit',$this->session->unit);
		$data['instance_status'] = $instansi["status_instansi"];
		$data['instance_id'] = $instansi["id_instansi"];
		$data['instance_name'] = $instansi["nama_instansi"];
		$data['idescription'] = $instansi["description"];
		$data['ikeywords'] = $instansi["keywords"];
		$data['iheader'] = $instansi["header"];
		$data['iheader_mini'] = $instansi["header_mini"];
		$data['ifooter'] = $instansi["footer"];
		$data['ilicensed'] = $instansi["licensed"];
		$data['iconik'] = $instansi["icon"];
		$data['logonik'] = $instansi["logo"];
		$data['member_id'] = $pegawai["id_pegawai"];
		$data['member_name'] = $pegawai["nama_pegawai"];
		$data['level_name'] = "ASESI";
		$data['photo'] = $pegawai["foto"];	
		//======================= IMPORTANT =========================================
/*		$ole = $this->m_ol_rancak->ambil_data_dropdown_pengurus_pengcab($this->session->id_pegawai);
		$arr = array();
		foreach($ole as $val){
				$arr[] = $val['id_pengcab'];
		}
		$eimplo = implode(",", $arr);
		$data['ambil_pengumuman'] = $this->m_ol_rancak->ambil_pengumuman($eimplo);*/
		$data['id'] = $this->uri->segment(4, 0);
		$data['id2'] = $this->uri->segment(5, 0);
		if($mode=='view'){
			$this->tampil_top($data);
		}
    else if($mode=='data'){
			echo json_encode($this->m_member->tes_pengajuan_kompetensi_all());
		}
    else if($mode=='tabel'){
			echo json_encode($this->m_member->tabel_logbook($data['id']));
		}
		else{
		if($mode=='pdf_logbook'){
			  $report = $this->load->view('cetak/ol_logbook_tespengajuan', $data, TRUE);
			  $filename = $data['header'].".pdf";
			  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
			  $mpdf->AddPage('P', '', '', '', 2, 5, 5, 5, 10, 3, 3);
			  $mpdf->SetTitle($data['header']);
			  $mpdf->SetAuthor($data['instance_name']);
			  $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
			  //$mpdf->SetFooter('Page : {PAGENO}');
			  ini_set("pcre.backtrack_limit", "5000000");
			  $mpdf->WriteHTML($report);
			  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
			}
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
	      $data['status_diusulkan_all']  = $this->m_ol_rancak->status_diusulkan_all();
	      $data['id_status_diusulkan']  = set_value('id_status_diusulkan',$this->input->post("id_status_diusulkan"));
	      $data['id_instansi']  = set_value('id_instansi',$this->input->post("id_instansi"));
	      $this->load->view("member/isi",$data);
      }
      if($mode=='simpan_tambah'){
      	$kondisi = array('barcode_pegawai'=>$this->session->barcode_pegawai);
      	$count = $this->m_umum->jumlah_record_filter('ol_pengajuan_tes',$kondisi);
      	if($count >= 2){
					$this->session->set_flashdata('danger', 'Tes hanya di batasi 2x pengajuan');
					redirect(base_url('member/tes'));
      	}else{
				  $last = $this->m_member->simpan_pengajuan_kompetensi_tes();
					$this->session->set_flashdata('sukses', 'Silahkan Hubungi Administrator untuk Aktifasi');
					redirect(base_url('member/tes/sukses/'.$last));
				}
      }
      if($mode=='sukses'){
        $data['page'] =  $data['page']."_sukses";
				$data['title'] = "SUKSES MELAKUKAN TES / LATIHAN PENGAJUAN KOMPETENSI";
				$keuangan = $this->m_umum->ambil_data('ol_pengajuan_tes','id_pengajuan',$data['id']);
				$status = $this->m_umum->ambil_data('ol_status_diusulkan','id_status_diusulkan',$keuangan['id_status_diusulkan']);
				$name = $this->m_umum->ambil_data('ol_pegawai','barcode_pegawai',$keuangan['barcode_pegawai']);
		    $data['tgl_pengajuan']  = date('d-m-Y', strtotime($keuangan["tgl_pengajuan"]));
		    $data['nama_status_diusulkan']  = $status["nama_status_diusulkan"];
		    $data['nama_pegawai']  = $name["nama_pegawai"];
				$this->tampil_top($data);
	  	} 
      if($mode=='isi'){
        $data['page'] =  $data['page']."_isi";
				$data['ambil_link'] = $this->m_member->ambil_link_asesi($data['id']);
				$data['ambil_berkas_data']=$this->m_ol_rancak->ambil_id_berkas_data($this->session->id_pegawai);
				$d	=$this->m_member->ambil_pengajuan_kompetensi($data['id']); //barcode_pengajuan
				$data['ambil_data_etik_pegawai_oppe'] = $this->m_ol_rancak->ambil_data_etik_pegawai_oppe($this->session->id_pegawai,date('Y'));
		    if($d["id_pegawai"] !== $this->session->id_pegawai){
		      redirect(base_url('member/tes'));
		    }
				$data['id_pengajuan']  = set_value('id_pengajuan',$d["id_pengajuan"]);
				$kondisi_logbooke=array('id_pengajuan'=>$d["id_pengajuan"]);
				$data['jml_logbooke']=$this->m_umum->jumlah_record_filter('ol_logbook',$kondisi_logbooke);
				$data['list_asesor'] = $this->m_ol_rancak->ambil_data_nkr_pengajuan_validator_asesor($d["id_pengajuan"]);
				$data['kode_unit_pengajuan']  = set_value('kode_unit_pengajuan',$d["kode_unit_pengajuan"]);
				$data['id_status_diusulkan']  = set_value('id_status_diusulkan',$d["id_status_diusulkan"]);
				$data['nama_status_diusulkan']  = set_value('nama_status_diusulkan',$d["nama_status_diusulkan"]);
				$data['id_berkas']  = explode(",", $d["id_berkas"]);
				$data['berkas']  = $d["id_berkas"];
				$data['id_ijasah']  = explode(",", $d["id_ijasah"]);
				$data['ijasah']  = $d["id_ijasah"];
				$data['id_str']  = explode(",", $d["id_str"]);
				$data['str']  = $d["id_str"];
				$data['id_sertifikat']  = explode(",", $d["id_sertifikat"]);
				$data['etike']  = explode(",", $d["id_etik_pegawai"]);
				$data['sertifikat']  = $d["id_sertifikat"];
				$data['status_pengajuan']  = set_value('status_pengajuan',$d["status_pengajuan"]);
				$data['id_etik_pegawai']  = set_value('id_etik_pegawai',$d["id_etik_pegawai"]);
				$data['ambil_lobook_validasi_group_pengajuan']=$this->m_ol_rancak->ambil_lobook_validasi_group_pengajuan($d["id_pengajuan"]);
				$this->tampil_top($data);
				$action = $this->input->post('action');
				$id_pengajuan = $this->input->post('id_pengajuan');
				if($action == 'Btnsimpan') {
					$this->m_member->edit_pengajuan();
					$this->session->set_flashdata('sukses', 'Pengajuan Sudah Di Simpan');
					redirect(base_url('member/tes'));
				}
				if($action == 'BtnKirim') {
				//	$this->m_profil->simpan_pengajuan_logbook_pegawai($id_pengajuan);
					$this->m_ol_pengajuan->terkirim();
					$this->session->set_flashdata('sukses', 'Pengajuan Sudah Diproses Cek Tabel Untuk Kelengkapan Data');
					redirect(base_url('member/tes'));
				}
	  	}
      if($mode=='tambah_kompetensi'){
        $data['page'] =  $data['page']."_tambah_kompetensi";
        $data['kompetensi']=$this->m_ol_rancak->ambil_lobook_nkr_kompetensi_group_pengajuan();
				$keuangan = $this->m_umum->ambil_data('ol_pengajuan_tes','id_pengajuan',$data['id']);
				$data['id_pengajuan']  = set_value('id_pengajuan',$keuangan["id_pengajuan"]);
				$data['kode_unit_pengajuan']  = set_value('kode_unit_pengajuan',$keuangan["kode_unit_pengajuan"]);
				$this->load->view("member/isi",$data);
      }
      if($mode=='simpan_tambah_kompetensi'){
				$kode_unit_pengajuan = $this->input->post('kode_unit_pengajuan');
				$barcode_pengajuan = $this->input->post('id_pengajuan');
		//		if(empty($kode_unit_pengajuan)){
/*					$chk = $this->input->post('chk[]');
					$jml_kode = count($chk);*/
		//			if($jml_kode == 1){
						$this->m_member->simpan_kode_unit_pengajuan();
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('member/tes/isi/'.$barcode_pengajuan));
/*					}else{
						$this->session->set_flashdata('danger', 'Untuk saat ini hanya satu Kompetensi');
						redirect(base_url('member/tes/isi/'.$barcode_pengajuan));						
					}*/
		//	  }
      }
      if($mode=='tambah_logbook'){
        $data['page'] =  $data['page']."_tambah_logbook";
				$keuangan = $this->m_umum->ambil_data('ol_pengajuan_tes','id_pengajuan',$data['id']);
        $data['kompetensi']=$this->m_member->ambil_berkas_logbookku($keuangan["kode_unit_pengajuan"],$keuangan["id_instansi"]);
				$data['id_pengajuan']  = set_value('id_pengajuan',$keuangan["id_pengajuan"]);
				$data['logbook']  = set_value('logbook',$keuangan["logbook"]);
				$data['id_status_diusulkan']  = set_value('id_status_diusulkan',$keuangan["id_status_diusulkan"]);
				$this->load->view("member/isi",$data);
      }
      if($mode=='simpan_tambah_logbook'){
				$barcode_pengajuan = $this->input->post('id_pengajuan');
				$this->m_member->simpan_logbook_pengajuan();
				$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
				redirect(base_url('member/tes/isi/'.$barcode_pengajuan));
      }
      if($mode=='simpan_berkas'){
				$id = $this->input->post('id');
				$barcode_pengajuan = $this->input->post('id_pengajuan');
					$chk = $this->input->post('chk[]');
						$eimplo = implode(",",$chk);
						$this->m_member->simpan_berkas_modal($id,$eimplo);
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('member/tes/isi/'.$barcode_pengajuan));
      }
      if($mode=='tambah_ijasah'){
        $data['page'] =  $data['page']."_tambah_ijasah";
        $data['kompetensi']=$this->m_ol_rancak->ambil_berkas_ijasahku();
				$keuangan = $this->m_umum->ambil_data('ol_pengajuan_tes','id_pengajuan',$data['id']);
				$data['id_pengajuan']  = set_value('id_pengajuan',$keuangan["id_pengajuan"]);
				$data['berkase']  = $keuangan["id_ijasah"];
				$this->load->view("member/isi",$data);
      }
      if($mode=='tambah_str'){
        $data['page'] =  $data['page']."_tambah_str";
        $data['kompetensi']=$this->m_ol_rancak->ambil_berkas_strku();
				$keuangan = $this->m_umum->ambil_data('ol_pengajuan_tes','id_pengajuan',$data['id']);
				$data['id_pengajuan']  = set_value('id_pengajuan',$keuangan["id_pengajuan"]);
				$data['berkase']  = $keuangan["id_str"];
				$this->load->view("member/isi",$data);
      }
      if($mode=='tambah_sertifikat'){
        $data['page'] =  $data['page']."_tambah_sertifikat";
        $data['kompetensi']=$this->m_ol_rancak->ambil_berkas_sertifikatku();
				$keuangan = $this->m_umum->ambil_data('ol_pengajuan_tes','id_pengajuan',$data['id']);
				$data['id_pengajuan']  = set_value('id_pengajuan',$keuangan["id_pengajuan"]);
				$data['berkase']  = $keuangan["id_sertifikat"];
				$this->load->view("member/isi",$data);
      }
      if($mode=='tambah_berkaslain'){
        $data['page'] =  $data['page']."_tambah_berkaslain";
        $data['kompetensi']=$this->m_ol_rancak->ambil_berkas_berkasku();
				$keuangan = $this->m_umum->ambil_data('ol_pengajuan_tes','id_pengajuan',$data['id']);
				$data['id_pengajuan']  = set_value('id_pengajuan',$keuangan["id_pengajuan"]);
				$data['berkase']  = $keuangan["id_berkas"];
				$this->load->view("member/isi",$data);
      }
      if($mode=='tambah_etik'){
        $data['page'] =  $data['page']."_tambah_etik";
        $data['kompetensi']=$this->m_ol_rancak->ambil_berkas_etikku();
				$keuangan = $this->m_umum->ambil_data('ol_pengajuan_tes','id_pengajuan',$data['id']);
				$data['id_pengajuan']  = set_value('id_pengajuan',$keuangan["id_pengajuan"]);
				$data['berkase']  = $keuangan["id_etik_pegawai"];
				$this->load->view("member/isi",$data);
      }
      if($mode=='kirim'){
      	$cek = $this->m_umum->ambil_data('ol_pengajuan_tes','id_pengajuan',$data['id2']);
      	if($cek['status_pengajuan'] > 0){
						$this->session->set_flashdata('danger', 'Status Sudah Terkirim');
						redirect(base_url('member/tes'));
      	}else{
				  if($this->m_member->rubah_status_kompetensi($data['id'],$data['id2'])){
						redirect(base_url('member/tes'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
						redirect(base_url('member/tes'));
				  }      		
      	}

      }
      if($mode=='unkirim'){
      	$cek = $this->m_umum->ambil_data('ol_pengajuan_tes','id_pengajuan',$data['id2']);
      	if($cek['status_pengajuan'] == 0){
						$this->session->set_flashdata('danger', 'Status Belum Terkirim');
						redirect(base_url('member/tes'));
      	}else{
				  if($this->m_member->rubah_status_kompetensi($data['id'],$data['id2'])){
						redirect(base_url('member/tes'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
						redirect(base_url('member/tes'));
				  }      		
      	}

      }
			if($mode=='pdf_etika'){
			  $report = $this->load->view('cetak/tes_etika_profesi', $data, TRUE);
			  $filename = $data['header'].".pdf";
			  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-L']);
			  $mpdf->AddPage('P', '', '', '', 2, 5, 5, 5, 10, 3, 3);
			  $mpdf->SetTitle($data['header']);
			  $mpdf->SetAuthor($data['instance_name']);
			  $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
			  //$mpdf->SetFooter('Page : {PAGENO}');
			  ini_set("pcre.backtrack_limit", "5000000");
			  $mpdf->WriteHTML($report);
			  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
			}
		}
	}
	function signature($mode='view'){
		$data['page']="signature"; 
		$data['header'] = "UPLOAD SIGNATURE DOKTER";
		$data['title'] = "UPLOAD SIGNATURE DOKTER UNTUK KEPERLUAN PRINT HASIL JIKA DISETUJUI";
		$this->m_auth->hak_member();
				$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
//		$data['forpengurus_pengcab'] = $this->m_ol_rancak->ambil_data_dropdown_pengurus_pengcab($this->session->id_pegawai);
//		$propinsie = $this->m_umum->ambil_data('ol_pengcab','id_pengcab',$pegawai['id_pengcab']);
		$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
		$data['ambil_data_a_enabled'] = $this->m_ol_rancak->ambil_data_a_enabled();
//		$data['prov_id'] = $propinsie["id_prov"];
		$data['aran_jabatan'] = $jabatanekuh["nama_jabatan"];
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
				if(!empty($data['asesor'])){
			$data['level_name'] = $asesor["nama_komite"];
		}else{
			$data['level_name'] = $pegawai["nama_level"];			
  	}
		$data['photo'] = $pegawai["foto"];	
		//======================= IMPORTANT =========================================
		$mine = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$this->session->id_pegawai);
		$data['id_pegawai']  = set_value('id_pegawai',$mine['id_pegawai']);
		$data['ttd_pegawai']  = set_value('ttd_pegawai',$mine['ttd_pegawai']);
		$data['nama_pegawai']  = set_value('nama_pegawai',$mine['nama_pegawai']);
		$this->form_validation->set_rules('id_pegawai','id_pegawai','required');
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
				$uploadPath = 'assets/berkas/kop/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'png';
				$config['encrypt_name'] = TRUE;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$id_pegawai = $this->input->post('id_pegawai');
				$user_pic=$this->m_umum->ambil_data('ol_pegawai','id_pegawai',$id_pegawai);
				$cek_file=FCPATH.'assets/berkas/kop/'.$user_pic['ttd_pegawai'];
				if(file_exists($cek_file)){
					unlink(FCPATH."assets/berkas/kop/".$user_pic['ttd_pegawai']);
				}
				if($this->upload->do_upload('upload_File')){
					$fileData = $this->upload->data();
					$this->m_member->edit_signature_pegawai($fileData['file_name']);
					$this->session->set_flashdata('sukses', 'Data berhasil Di Upload');
					redirect(base_url('member/signature'));
				}else{
					$this->session->set_flashdata('danger', 'Tidak Ada Data Terupload');
					redirect(base_url('member'));
				}
			}
		}
	}
  function blaporan($mode='view'){
		$data['page']  = "blaporan";
		$data['header'] = "BERKAS LAPORAN QUALITY CONTROL / INDIKATOR MUTU";
		$data['title'] = "BERKAS LAPORAN QUALITY CONTROL / INDIKATOR MUTU";
				$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
/*		$data['multi_level'] = $this->m_ol_rancak->ambil_data_link_pengurus($this->session->id_pegawai);
		$data['multi_struktur'] = $this->m_ol_rancak->ambil_data_link_struktur($this->session->id_pegawai);
		$data['ol_akses'] = $this->m_ol_rancak->ol_akses($this->session->id_pegawai);*/
		$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
		$data['ambil_data_a_enabled'] = $this->m_ol_rancak->ambil_data_a_enabled();
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
				if(!empty($data['asesor'])){
			$data['level_name'] = $asesor["nama_komite"];
		}else{
			$data['level_name'] = $pegawai["nama_level"];			
  	}
		$data['photo'] = $pegawai["foto"];	
		//======================= IMPORTANT =========================================
		$data['id']   = $this->uri->segment(4, 0);
	  if($mode=='view'){
			$this->tampil($data);
		}
	  else if($mode=='data'){
			echo json_encode($this->m_member->berkas_imut_all());
		}
/*  	else if($mode=='hapus'){
			$this->db->select("COUNT(*) as num");
			$this->db->where('find_in_set("'.$data['id'].'", id_berkas) != 0');
			$this->db->or_where('find_in_set("'.$data['id'].'", id_ijasah) != 0');
			$this->db->or_where('find_in_set("'.$data['id'].'", id_str) != 0');
			$this->db->or_where('find_in_set("'.$data['id'].'", id_sertifikat) != 0');
			$q = $this->db->get('kr_pengajuan')->row();
			$jml = $q->num;
			if($jml == 0){
				$berkase=$this->m_umum->ambil_data('berkas','id_berkas',$data['id']);
				$cek_file=FCPATH.'assets/berkas/ol/'.$berkase['link_berkas'];
				if(file_exists($cek_file)){
					unlink(FCPATH."assets/berkas/ol/".$berkase['link_berkas']);
				}
				$this->m_umum->hapus_data('berkas','id_berkas',$data['id']);
				$this->session->set_flashdata('sukses', 'Berkas Sudah Di Hapus');
				redirect(base_url('pegawai/berkas'));
			}else{
				$this->session->set_flashdata('danger', 'Berkas Sudah Di Pakai Pengajuan');
				redirect(base_url('pegawai/berkas'));
			}
    }*/
  	else{
			$data['ambil_kategori_berkas']=$this->m_ol_rancak->ambil_kategori_berkas();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
    		$data['nama_berkas']  = set_value('nama_berkas',$this->input->post("nama_berkas"));
    		$data['id_kategori_berkas']  = set_value('id_kategori_berkas',$this->input->post("id_kategori_berkas"));
    		$data['no_berkas']  = set_value('no_berkas',$this->input->post("no_berkas"));
    		$this->form_validation->set_rules('nama_berkas','nama_berkas','required');
        if ($this->form_validation->run() === FALSE){
			       $this->tampil($data);
        }else{
        	$id_kategori_berkas = $this->input->post('id_kategori_berkas');
	    			$data = array();
	    			$filesCount = count($_FILES['upload_Files']['name']);
				    for($i = 0; $i < $filesCount; $i++){
	    				$_FILES['upload_File']['name'] = $_FILES['upload_Files']['name'][$i];
	    				$_FILES['upload_File']['type'] = $_FILES['upload_Files']['type'][$i];
	    				$_FILES['upload_File']['tmp_name'] = $_FILES['upload_Files']['tmp_name'][$i];
	    				$_FILES['upload_File']['error'] = $_FILES['upload_Files']['error'][$i];
	    				$_FILES['upload_File']['size'] = $_FILES['upload_Files']['size'][$i];
	    				$uploadPath = 'assets/berkas/ol/';
	    				$config['upload_path'] = $uploadPath;
	    				$config['allowed_types'] = 'pdf';
	    				$config['encrypt_name'] = TRUE;
	    				$this->load->library('upload', $config);
	    				$this->upload->initialize($config);
	    				if($this->upload->do_upload('upload_File')){
	    					$fileData = $this->upload->data();
	    					$this->m_member->simpan_berkas_imut_file($fileData['file_name']);
	    					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
	    					redirect(base_url('member/blaporan'));
	    				}else{
	    					$nole = '';
	    					$this->m_member->simpan_berkas_imut_file($nole);
	    					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
	    					redirect(base_url('member/blaporan'));
	    				}
				    }
		    }	
	    }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
        $berkase = $this->m_umum->ambil_data('ol_berkas','barcode_berkas',$data['id']);
    		if($berkase['id_pegawai'] !== $this->session->id_pegawai){
    			redirect(base_url('member/blaporan'));
    		}
    		$data['id_berkas']  = set_value('id_berkas',$berkase['id_berkas']);
    		$data['nama_berkas']  = set_value('nama_berkas',$berkase['nama_berkas']);
    		$data['link_berkas']  = set_value('link_berkas',$berkase['link_berkas']);
    		$data['id_kategori_berkas']  = set_value('id_kategori_berkas',$berkase['id_kategori_berkas']);
    		$data['no_berkas']  = set_value('no_berkas',$berkase['no_berkas']);
    		$this->form_validation->set_rules('nama_berkas','nama_berkas','required');
        if ($this->form_validation->run() === FALSE){
			       $this->tampil($data);
        }else{
        	$id_kategori_berkas = $this->input->post('id_kategori_berkas');
	    			$data = array();
	    			$filesCount = count($_FILES['upload_Files']['name']);
				    for($i = 0; $i < $filesCount; $i++){
	    				$_FILES['upload_File']['name'] = $_FILES['upload_Files']['name'][$i];
	    				$_FILES['upload_File']['type'] = $_FILES['upload_Files']['type'][$i];
	    				$_FILES['upload_File']['tmp_name'] = $_FILES['upload_Files']['tmp_name'][$i];
	    				$_FILES['upload_File']['error'] = $_FILES['upload_Files']['error'][$i];
	    				$_FILES['upload_File']['size'] = $_FILES['upload_Files']['size'][$i];
	    				$uploadPath = 'assets/berkas/ol/';
	    				$config['upload_path'] = $uploadPath;
	    				$config['allowed_types'] = 'pdf';
	    				$config['encrypt_name'] = TRUE;
	    				$this->load->library('upload', $config);
	    				$this->upload->initialize($config);
	    				if($this->upload->do_upload('upload_File')){
		  					$fileData = $this->upload->data();
		  					$this->m_member->edit_berkas_imut_file($fileData['file_name']);
	    					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
	    					redirect(base_url('member/blaporan'));
	    				}else{
	    					$nole = '';
	    					$this->m_member->edit_berkas_file($nole);
	    					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
	    					redirect(base_url('member/blaporan'));
	    				}
				    }
		    }	
	    }
	  }
  } 
  function berkas($mode='view'){
		$data['page']  = "berkas";
		$data['header'] = "BERKAS UMUM";
		$data['title'] = "BERKAS UMUM";
				$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
/*		$data['multi_level'] = $this->m_ol_rancak->ambil_data_link_pengurus($this->session->id_pegawai);
		$data['multi_struktur'] = $this->m_ol_rancak->ambil_data_link_struktur($this->session->id_pegawai);
		$data['ol_akses'] = $this->m_ol_rancak->ol_akses($this->session->id_pegawai);*/
		$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
		$data['ambil_data_a_enabled'] = $this->m_ol_rancak->ambil_data_a_enabled();
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
				if(!empty($data['asesor'])){
			$data['level_name'] = $asesor["nama_komite"];
		}else{
			$data['level_name'] = $pegawai["nama_level"];			
  	}
		$data['photo'] = $pegawai["foto"];	
		//======================= IMPORTANT =========================================
		$data['id']   = $this->uri->segment(4, 0);
	  if($mode=='view'){
			$this->tampil($data);
		}
	  else if($mode=='data'){
			echo json_encode($this->m_member->berkas_pribadi_all());
		}
/*  	else if($mode=='hapus'){
			$this->db->select("COUNT(*) as num");
			$this->db->where('find_in_set("'.$data['id'].'", id_berkas) != 0');
			$this->db->or_where('find_in_set("'.$data['id'].'", id_ijasah) != 0');
			$this->db->or_where('find_in_set("'.$data['id'].'", id_str) != 0');
			$this->db->or_where('find_in_set("'.$data['id'].'", id_sertifikat) != 0');
			$q = $this->db->get('kr_pengajuan')->row();
			$jml = $q->num;
			if($jml == 0){
				$berkase=$this->m_umum->ambil_data('berkas','id_berkas',$data['id']);
				$cek_file=FCPATH.'assets/berkas/ol/'.$berkase['link_berkas'];
				if(file_exists($cek_file)){
					unlink(FCPATH."assets/berkas/ol/".$berkase['link_berkas']);
				}
				$this->m_umum->hapus_data('berkas','id_berkas',$data['id']);
				$this->session->set_flashdata('sukses', 'Berkas Sudah Di Hapus');
				redirect(base_url('pegawai/berkas'));
			}else{
				$this->session->set_flashdata('danger', 'Berkas Sudah Di Pakai Pengajuan');
				redirect(base_url('pegawai/berkas'));
			}
    }*/
  	else{
			$data['ambil_kategori_berkas']=$this->m_ol_rancak->ambil_kategori_berkas();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
    		$data['nama_berkas']  = set_value('nama_berkas',$this->input->post("nama_berkas"));
    		$data['id_kategori_berkas']  = set_value('id_kategori_berkas',$this->input->post("id_kategori_berkas"));
    		$data['no_berkas']  = set_value('no_berkas',$this->input->post("no_berkas"));
    		$this->form_validation->set_rules('nama_berkas','nama_berkas','required');
        if ($this->form_validation->run() === FALSE){
			       $this->tampil($data);
        }else{
        	$id_kategori_berkas = $this->input->post('id_kategori_berkas');
        	if(empty($id_kategori_berkas)){
	    					$this->session->set_flashdata('danger', 'Kategori Masih Kosong');
	    					redirect(base_url('member/berkas'));
        	}else{
	    			$data = array();
	    			$filesCount = count($_FILES['upload_Files']['name']);
				    for($i = 0; $i < $filesCount; $i++){
	    				$_FILES['upload_File']['name'] = $_FILES['upload_Files']['name'][$i];
	    				$_FILES['upload_File']['type'] = $_FILES['upload_Files']['type'][$i];
	    				$_FILES['upload_File']['tmp_name'] = $_FILES['upload_Files']['tmp_name'][$i];
	    				$_FILES['upload_File']['error'] = $_FILES['upload_Files']['error'][$i];
	    				$_FILES['upload_File']['size'] = $_FILES['upload_Files']['size'][$i];
	    				$uploadPath = 'assets/berkas/ol/';
	    				$config['upload_path'] = $uploadPath;
	    				$config['allowed_types'] = 'pdf';
	    				$config['encrypt_name'] = TRUE;
	    				$this->load->library('upload', $config);
	    				$this->upload->initialize($config);
	    				if($this->upload->do_upload('upload_File')){
	    					$fileData = $this->upload->data();
	    					$this->m_member->simpan_berkas_file($fileData['file_name']);
	    					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
	    					redirect(base_url('member/berkas'));
	    				}else{
	    					$nole = '';
	    					$this->m_member->simpan_berkas_file($nole);
	    					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
	    					redirect(base_url('member/berkas'));
	    				}
				    }
				  }
		    }	
	    }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
        $berkase = $this->m_umum->ambil_data('ol_berkas','barcode_berkas',$data['id']);
    		if($berkase['id_pegawai'] !== $this->session->id_pegawai){
    			redirect(base_url('member/berkas'));
    		}
    		$data['id_berkas']  = set_value('id_berkas',$berkase['id_berkas']);
    		$data['nama_berkas']  = set_value('nama_berkas',$berkase['nama_berkas']);
    		$data['link_berkas']  = set_value('link_berkas',$berkase['link_berkas']);
    		$data['id_kategori_berkas']  = set_value('id_kategori_berkas',$berkase['id_kategori_berkas']);
    		$data['no_berkas']  = set_value('no_berkas',$berkase['no_berkas']);
    		$this->form_validation->set_rules('nama_berkas','nama_berkas','required');
        if ($this->form_validation->run() === FALSE){
			       $this->tampil($data);
        }else{
        	$id_kategori_berkas = $this->input->post('id_kategori_berkas');
        	if(empty($id_kategori_berkas)){
	    					$this->session->set_flashdata('danger', 'Kategori Masih Kosong');
	    					redirect(base_url('member/berkas'));
        	}else{
	    			$data = array();
	    			$filesCount = count($_FILES['upload_Files']['name']);
				    for($i = 0; $i < $filesCount; $i++){
	    				$_FILES['upload_File']['name'] = $_FILES['upload_Files']['name'][$i];
	    				$_FILES['upload_File']['type'] = $_FILES['upload_Files']['type'][$i];
	    				$_FILES['upload_File']['tmp_name'] = $_FILES['upload_Files']['tmp_name'][$i];
	    				$_FILES['upload_File']['error'] = $_FILES['upload_Files']['error'][$i];
	    				$_FILES['upload_File']['size'] = $_FILES['upload_Files']['size'][$i];
	    				$uploadPath = 'assets/berkas/ol/';
	    				$config['upload_path'] = $uploadPath;
	    				$config['allowed_types'] = 'pdf';
	    				$config['encrypt_name'] = TRUE;
	    				$this->load->library('upload', $config);
	    				$this->upload->initialize($config);
	    				if($this->upload->do_upload('upload_File')){
		  					$fileData = $this->upload->data();
		  					$this->m_member->edit_berkas_file($fileData['file_name']);
	    					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
	    					redirect(base_url('member/berkas'));
	    				}else{
	    					$nole = '';
	    					$this->m_member->edit_berkas_file($nole);
	    					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
	    					redirect(base_url('member/berkas'));
	    				}
				    }
				  }
		    }	
	    }
	  }
  } 
  function ijasah($mode='view')
  {
	$data['page']  = "ijasah";
	$data['header'] = "BERKAS IJASAH";
	$data['title'] = "BERKAS IJASAH";
			$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
/*		$data['multi_level'] = $this->m_ol_rancak->ambil_data_link_pengurus($this->session->id_pegawai);
		$data['multi_struktur'] = $this->m_ol_rancak->ambil_data_link_struktur($this->session->id_pegawai);
	$data['ol_akses'] = $this->m_ol_rancak->ol_akses($this->session->id_pegawai);*/
	$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
	$data['ambil_data_a_enabled'] = $this->m_ol_rancak->ambil_data_a_enabled();
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
			if(!empty($data['asesor'])){
			$data['level_name'] = $asesor["nama_komite"];
		}else{
			$data['level_name'] = $pegawai["nama_level"];			
  	}
	$data['photo'] = $pegawai["foto"];	
	//======================= IMPORTANT =========================================
	$data['id']   = $this->uri->segment(4, 0);
    if($mode=='view'){
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_member->berkas_ijasah_all());
	}
/*  	else if($mode=='hapus'){
			$this->db->select("COUNT(*) as num");
			$this->db->where('find_in_set("'.$data['id'].'", id_berkas) != 0');
			$this->db->or_where('find_in_set("'.$data['id'].'", id_ijasah) != 0');
			$this->db->or_where('find_in_set("'.$data['id'].'", id_str) != 0');
			$this->db->or_where('find_in_set("'.$data['id'].'", id_sertifikat) != 0');
			$q = $this->db->get('kr_pengajuan')->row();
			$jml = $q->num;
			if($jml == 0){
				$berkase=$this->m_umum->ambil_data('berkas','id_berkas',$data['id']);
				$cek_file=FCPATH.'assets/berkas/ol/'.$berkase['link_berkas'];
				if(file_exists($cek_file)){
					unlink(FCPATH."assets/berkas/ol/".$berkase['link_berkas']);
				}
				$this->m_umum->hapus_data('berkas','id_berkas',$data['id']);
				$this->session->set_flashdata('sukses', 'Berkas Sudah Di Hapus');
				redirect(base_url('pegawai/berkas'));
			}else{
				$this->session->set_flashdata('danger', 'Berkas Sudah Di Pakai Pengajuan');
				redirect(base_url('pegawai/berkas'));
			}
    }*/
  	else{
		$data['cmd_pendidikan']=$this->m_rancak->cmd_pendidikan();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
    		$data['nama_berkas']  = set_value('nama_berkas',$this->input->post("nama_berkas"));
    		$data['id_pendidikan']  = set_value('id_pendidikan',$this->input->post("id_pendidikan"));
    		$data['no_berkas']  = set_value('no_berkas',$this->input->post("no_berkas"));
    		$data['tgl_b_berkas']  = set_value('tgl_b_berkas',date('d-m-Y'));
    		$this->form_validation->set_rules('nama_berkas','nama_berkas','required');
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
						$uploadPath = 'assets/berkas/ol/';
						$config['upload_path'] = $uploadPath;
						$config['allowed_types'] = 'pdf';
						$config['encrypt_name'] = TRUE;
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if($this->upload->do_upload('upload_File')){
							$fileData = $this->upload->data();
							$this->m_member->simpan_berkas_file_ijasah($fileData['file_name']);
							$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
							redirect(base_url('member/ijasah'));
						}else{
    					$nole = '';
    					$this->m_member->simpan_berkas_file_ijasah($nole);
    					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
							redirect(base_url('member/ijasah'));
						}
					}
				}
	  	}
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
        $berkase = $this->m_umum->ambil_data('ol_berkas','barcode_berkas',$data['id']);
    		if($berkase['id_pegawai'] !== $this->session->id_pegawai){
    			redirect(base_url('member/ijasah'));
    		}
    		$data['id_berkas']  = set_value('id_berkas',$berkase['id_berkas']);
    		$data['nama_berkas']  = set_value('nama_berkas',$berkase['nama_berkas']);
    		$data['link_berkas']  = set_value('link_berkas',$berkase['link_berkas']);
    		$data['id_pendidikan']  = set_value('id_pendidikan',$berkase['id_pendidikan']);
    		$data['no_berkas']  = set_value('no_berkas',$berkase['no_berkas']);
    		$data['tgl_b_berkas']  = set_value('tgl_b_berkas',date('d-m-Y', strtotime($berkase["tgl_b_berkas"])));
    		$this->form_validation->set_rules('nama_berkas','nama_berkas','required');
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
    				$uploadPath = 'assets/berkas/ol/';
    				$config['upload_path'] = $uploadPath;
    				$config['allowed_types'] = 'pdf';
    				$config['encrypt_name'] = TRUE;
    				$this->load->library('upload', $config);
    				$this->upload->initialize($config);
    				if($this->upload->do_upload('upload_File')){
	  					$fileData = $this->upload->data();
	  					$this->m_member->edit_berkas_file_ijasah($fileData['file_name']);
    					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
    					redirect(base_url('member/ijasah'));
    				}else{
    					$nole = '';
    					$this->m_member->edit_berkas_file_ijasah($nole);
    					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
    					redirect(base_url('member/ijasah'));
    				}
			    }
		    }	
	    }
		}
  }
  function pelatihan($mode='view')
  {
	$data['page']  = "pelatihan";
	$data['header'] = "BERKAS PELATIHAN UMUM / KHUSUS BAGI UNIT DAN JENJANG KARIR";
	$data['title'] = "BERKAS PELATIHAN UMUM / KHUSUS BAGI UNIT DAN JENJANG KARIR";
			$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
/*		$data['multi_level'] = $this->m_ol_rancak->ambil_data_link_pengurus($this->session->id_pegawai);
		$data['multi_struktur'] = $this->m_ol_rancak->ambil_data_link_struktur($this->session->id_pegawai);
	$data['ol_akses'] = $this->m_ol_rancak->ol_akses($this->session->id_pegawai);*/
	$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
	$data['ambil_data_a_enabled'] = $this->m_ol_rancak->ambil_data_a_enabled();
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
			if(!empty($data['asesor'])){
			$data['level_name'] = $asesor["nama_komite"];
		}else{
			$data['level_name'] = $pegawai["nama_level"];			
  	}
	$data['photo'] = $pegawai["foto"];	
	//======================= IMPORTANT =========================================
	$data['id'] = $this->uri->segment(4, 0);
    if($mode=='view'){
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_member->berkas_pelatihan_all());
	}
/*  	else if($mode=='hapus'){
			$this->db->select("COUNT(*) as num");
			$this->db->where('find_in_set("'.$data['id'].'", id_berkas) != 0');
			$this->db->or_where('find_in_set("'.$data['id'].'", id_ijasah) != 0');
			$this->db->or_where('find_in_set("'.$data['id'].'", id_str) != 0');
			$this->db->or_where('find_in_set("'.$data['id'].'", id_sertifikat) != 0');
			$q = $this->db->get('kr_pengajuan')->row();
			$jml = $q->num;
			if($jml == 0){
				$berkase=$this->m_umum->ambil_data('berkas','id_berkas',$data['id']);
				$cek_file=FCPATH.'assets/berkas/ol/'.$berkase['link_berkas'];
				if(file_exists($cek_file)){
					unlink(FCPATH."assets/berkas/ol/".$berkase['link_berkas']);
				}
				$this->m_umum->hapus_data('berkas','id_berkas',$data['id']);
				$this->session->set_flashdata('sukses', 'Berkas Sudah Di Hapus');
				redirect(base_url('pegawai/berkas'));
			}else{
				$this->session->set_flashdata('danger', 'Berkas Sudah Di Pakai Pengajuan');
				redirect(base_url('pegawai/berkas'));
			}
    }*/
  else{
		$data['kategori_pelatihan']=$this->m_ol_rancak->kategori_pelatihan();
		$data['ambil_kategori_berkas']=$this->m_ol_rancak->ambil_kategori_berkas_pelatihan();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
    		$data['nama_berkas']  = set_value('nama_berkas',$this->input->post("nama_berkas"));
    		$data['id_kategori_pelatihan']  = set_value('id_kategori_pelatihan',$this->input->post("id_kategori_pelatihan"));
    		$data['id_kategori_berkas']  = set_value('id_kategori_berkas',$this->input->post("id_kategori_berkas"));
    		$data['no_sertifikat']  = set_value('no_sertifikat',$this->input->post("no_sertifikat"));
    		$data['kredit']  = set_value('kredit',$this->input->post("kredit"));
    		$data['penyelenggara']  = set_value('penyelenggara',$this->input->post("penyelenggara"));
    		$data['tgl_a_berkas']  = set_value('tgl_a_berkas',date('d-m-Y'));
    		$data['tgl_b_berkas']  = set_value('tgl_b_berkas',date('d-m-Y'));
    		$this->form_validation->set_rules('nama_berkas','nama_berkas','required');
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
    				$uploadPath = 'assets/berkas/ol/';
    				$config['upload_path'] = $uploadPath;
    				$config['allowed_types'] = 'pdf';
    				$config['encrypt_name'] = TRUE;
    				$this->load->library('upload', $config);
    				$this->upload->initialize($config);
    				if($this->upload->do_upload('upload_File')){
    					$fileData = $this->upload->data();
    					$this->m_member->simpan_berkas_file_pelatihan($fileData['file_name']);
    					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
    					redirect(base_url('member/pelatihan'));
    				}else{
    					$nole = '';
    					$this->m_member->simpan_berkas_file_pelatihan($nole);
    					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
							redirect(base_url('member/pelatihan'));
    				}
    			   }
		      }
	  	}
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
        $berkase = $this->m_umum->ambil_data('ol_berkas','barcode_berkas',$data['id']);
    		if($berkase['id_pegawai'] !== $this->session->id_pegawai){
    			redirect(base_url('member/berkas'));
    		}
    		$data['id_berkas']  = set_value('id_berkas',$berkase['id_berkas']);
    		$data['nama_berkas']  = set_value('nama_berkas',$berkase['nama_berkas']);
    		$data['link_berkas']  = set_value('link_berkas',$berkase['link_berkas']);
    		$data['id_kategori_pelatihan']  = set_value('id_kategori_pelatihan',$berkase['id_kategori_pelatihan']);
    		$data['id_kategori_berkas']  = set_value('id_kategori_berkas',$berkase['id_kategori_berkas']);
    		$data['no_sertifikat']  = set_value('no_sertifikat',$berkase['no_sertifikat']);
    		$data['kredit']  = set_value('kredit',$berkase['kredit']);
    		$data['penyelenggara']  = set_value('penyelenggara',$berkase['penyelenggara']);
    		$data['tgl_a_berkas']  = set_value('tgl_a_berkas',date('d-m-Y', strtotime($berkase["tgl_a_berkas"])));
    		$data['tgl_b_berkas']  = set_value('tgl_b_berkas',date('d-m-Y', strtotime($berkase["tgl_b_berkas"])));
    		$this->form_validation->set_rules('nama_berkas','nama_berkas','required');
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
    				$uploadPath = 'assets/berkas/ol/';
    				$config['upload_path'] = $uploadPath;
    				$config['allowed_types'] = 'pdf';
    				$config['encrypt_name'] = TRUE;
    				$this->load->library('upload', $config);
    				$this->upload->initialize($config);
    				if($this->upload->do_upload('upload_File')){
	  					$fileData = $this->upload->data();
	  					$this->m_member->edit_berkas_file_pelatihan($fileData['file_name']);
    					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
    					redirect(base_url('member/pelatihan'));
    				}else{
    					$nole = '';
    					$this->m_member->edit_berkas_file_pelatihan($nole);
    					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
    					redirect(base_url('member/pelatihan'));
    				}
			    }
		    }	
	    }
		}
  }
  function surat_ijin($mode='view')
  {
	$data['page']  = "surat_ijin";
	$data['header'] = "BERKAS SURAT IJIN";
	$data['title'] = "BERKAS SURAT IJIN";
			$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
/*		$data['multi_level'] = $this->m_ol_rancak->ambil_data_link_pengurus($this->session->id_pegawai);
		$data['multi_struktur'] = $this->m_ol_rancak->ambil_data_link_struktur($this->session->id_pegawai);*/
	$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
	$data['ambil_data_a_enabled'] = $this->m_ol_rancak->ambil_data_a_enabled();
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
			if(!empty($data['asesor'])){
			$data['level_name'] = $asesor["nama_komite"];
		}else{
			$data['level_name'] = $pegawai["nama_level"];			
  	}
	$data['photo'] = $pegawai["foto"];	
	//======================= IMPORTANT =========================================
	$data['id'] = $this->uri->segment(4, 0);
    if($mode=='view'){
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_member->berkas_str_all());
	}
/*    else if($mode=='hapus'){
		$this->db->select("COUNT(*) as num");
		$this->db->where('find_in_set("'.$data['id'].'", id_berkas) != 0');
		$this->db->or_where('find_in_set("'.$data['id'].'", id_ijasah) != 0');
		$this->db->or_where('find_in_set("'.$data['id'].'", id_str) != 0');
		$this->db->or_where('find_in_set("'.$data['id'].'", id_sertifikat) != 0');
		$q = $this->db->get('kr_pengajuan')->row();
		$jml = $q->num;
		if($jml == 0){
			$berkase=$this->m_umum->ambil_data('berkas','id_berkas',$data['id']);
			$cek_file=FCPATH.'assets/berkas/ol/'.$berkase['link_berkas'];
			if(file_exists($cek_file)){
				unlink(FCPATH."assets/berkas/ol/".$berkase['link_berkas']);
			}
			$this->m_umum->hapus_data('berkas','id_berkas',$data['id']);
			$this->session->set_flashdata('sukses', 'Berkas Sudah Di Hapus');
			redirect(base_url('pegawai/surat_ijin'));
		}else{
			$this->session->set_flashdata('danger', 'Berkas Sudah Di Pakai Pengajuan');
			redirect(base_url('pegawai/surat_ijin'));
		}
    }*/
  else{
		$data['kategori_str_all']=$this->m_ol_rancak->ambil_kategori_str();
		$data['lifetimekah'] = array('0'=>'Tidak Seumur Hidup','1'=>'Seumur Hidup');
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
    		$data['nama_berkas']  = set_value('nama_berkas',$this->input->post("nama_berkas"));
    		$data['no_berkas']  = set_value('no_berkas',$this->input->post("no_berkas"));
    		$data['id_kategori_berkas']  = set_value('id_kategori_berkas',$this->input->post("id_kategori_berkas"));
    		$data['lifetime_berkas']  = set_value('lifetime_berkas',$this->input->post("lifetime_berkas"));
    		$data['tgl_a_berkas']  = set_value('tgl_a_berkas',date('d-m-Y'));
    		$data['tgl_b_berkas']  = set_value('tgl_b_berkas',date('d-m-Y'));
    		$this->form_validation->set_rules('nama_berkas','nama_berkas','required');
        if ($this->form_validation->run() === FALSE){
			       $this->tampil($data);
        }else{
    			$id_kategori_berkas = $this->input->post('id_kategori_berkas');
    			$id_pegawai = $this->session->id_pegawai;
    			$kondisi=array('id_kategori_berkas'=>$id_kategori_berkas,'id_pegawai'=>$id_pegawai,'status_berkas'=>'1');
    			$jml = $this->m_umum->jumlah_record_filter('ol_berkas',$kondisi);
    			if($jml == 0){
    				$data = array();
    				$filesCount = count($_FILES['upload_Files']['name']);
    				for($i = 0; $i < $filesCount; $i++){
    					$_FILES['upload_File']['name'] = $_FILES['upload_Files']['name'][$i];
    					$_FILES['upload_File']['type'] = $_FILES['upload_Files']['type'][$i];
    					$_FILES['upload_File']['tmp_name'] = $_FILES['upload_Files']['tmp_name'][$i];
    					$_FILES['upload_File']['error'] = $_FILES['upload_Files']['error'][$i];
    					$_FILES['upload_File']['size'] = $_FILES['upload_Files']['size'][$i];
    					$uploadPath = 'assets/berkas/ol/';
    					$config['upload_path'] = $uploadPath;
    					$config['allowed_types'] = 'pdf';
    					$config['encrypt_name'] = TRUE;
    					$this->load->library('upload', $config);
    					$this->upload->initialize($config);
    					if($this->upload->do_upload('upload_File')){
    						$fileData = $this->upload->data();
    						$this->m_member->simpan_berkas_file_surat_ijin($fileData['file_name']);
    						$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
    						redirect(base_url('member/surat_ijin'));
    					}else{
  							$nole = '';
	    					$this->m_member->simpan_berkas_file_surat_ijin($nole);
	    					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
    						redirect(base_url('member/surat_ijin'));
    					}
    				}
    			}
    			else{
    				$this->session->set_flashdata('danger', 'Berkas Sudah Di Ada, Silahkan Pilih Perpanjangan');
    				redirect(base_url('member/surat_ijin'));
      		}
		    }
	  	}
      if($mode=='perpanjangan'){
        $data['page'] =  $data['page']."_perpanjangan";
				$old = $this->m_umum->ambil_data('ol_berkas','barcode_berkas',$data['id']);
    		if($old['id_pegawai'] !== $this->session->id_pegawai){
    			redirect(base_url('member/berkas'));
    		}
				$data['id_berkas'] = set_value('id_berkas',$old['id_berkas']);
				$data['id_kategori_berkas'] = set_value('id_kategori_berkas',$old['id_kategori_berkas']);
				$data['lifetime_berkas'] = set_value('lifetime_berkas',$old['lifetime_berkas']);
				$data['tgl_a_berkas'] = set_value('tgl_a_berkas',date('d-m-Y'));
				$data['tgl_b_berkas'] = set_value('tgl_b_berkas',date('d-m-Y'));
				$data['nama_berkas']  = set_value('nama_berkas',$this->input->post("nama_berkas"));
				$data['no_berkas']  = set_value('no_berkas',$this->input->post("no_berkas"));
				$this->form_validation->set_rules('nama_berkas','nama_berkas','required');
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
						$uploadPath = 'assets/berkas/ol/';
						$config['upload_path'] = $uploadPath;
						$config['allowed_types'] = 'pdf';
						$config['encrypt_name'] = TRUE;
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if($this->upload->do_upload('upload_File')){
							$fileData = $this->upload->data();
							$this->m_member->simpan_perpanjangan_berkas_file_surat_ijin($fileData['file_name']);
							$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
							redirect(base_url('member/surat_ijin'));
						}else{
  							$nole = '';
	    					$this->m_member->simpan_perpanjangan_berkas_file_surat_ijin($nole);
	    					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
    						redirect(base_url('member/surat_ijin'));
						}
					}
				}
	 	 	}
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
        $berkase = $this->m_umum->ambil_data('ol_berkas','barcode_berkas',$data['id']);
    		if($berkase['id_pegawai'] !== $this->session->id_pegawai){
    			redirect(base_url('member/berkas'));
    		}
    		$data['id_berkas']  = set_value('id_berkas',$berkase['id_berkas']);
    		$data['nama_berkas']  = set_value('nama_berkas',$berkase['nama_berkas']);
    		$data['no_berkas']  = set_value('no_berkas',$berkase['no_berkas']);
    		$data['link_berkas']  = set_value('link_berkas',$berkase['link_berkas']);
    		$data['id_kategori_berkas']  = set_value('id_kategori_berkas',$berkase['id_kategori_berkas']);
    		$data['lifetime_berkas']  = set_value('lifetime_berkas',$berkase['lifetime_berkas']);
    		$data['tgl_a_berkas']  = set_value('tgl_a_berkas',date('d-m-Y', strtotime($berkase["tgl_a_berkas"])));
    		$data['tgl_b_berkas']  = set_value('tgl_b_berkas',date('d-m-Y', strtotime($berkase["tgl_b_berkas"])));
    		$this->form_validation->set_rules('nama_berkas','nama_berkas','required');
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
    				$uploadPath = 'assets/berkas/ol/';
    				$config['upload_path'] = $uploadPath;
    				$config['allowed_types'] = 'pdf';
    				$config['encrypt_name'] = TRUE;
    				$this->load->library('upload', $config);
    				$this->upload->initialize($config);
    				if($this->upload->do_upload('upload_File')){
	  					$fileData = $this->upload->data();
	  					$this->m_member->edit_berkas_file_surat_ijin($fileData['file_name']);
    					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
    					redirect(base_url('member/surat_ijin'));
    				}else{
    					$nole = '';
    					$this->m_member->edit_berkas_file_surat_ijin($nole);
    					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
    					redirect(base_url('member/surat_ijin'));
    				}
			    }
		    }	
	    }
		}
  }
	function peminatan($mode='view'){
		$data['page']="peminatan"; 
		$data['header'] = "DATA PEMINATAN";
		$data['title'] = "DATA PEMINATAN";
		$this->m_auth->hak_member();
				$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
/*		$data['multi_level'] = $this->m_ol_rancak->ambil_data_link_pengurus($this->session->id_pegawai);
		$data['multi_struktur'] = $this->m_ol_rancak->ambil_data_link_struktur($this->session->id_pegawai);*/
		$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
		$data['ambil_data_a_enabled'] = $this->m_ol_rancak->ambil_data_a_enabled();
//		$data['ol_akses'] = $this->m_ol_rancak->ol_akses($this->session->id_pegawai);
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
		$data['photo'] = $pegawai["foto"];	
		//======================= IMPORTANT =========================================
		$data['id']   = $this->uri->segment(4, 0);
		if($mode=='view'){
			$this->tampil($data);
		}
		else if($mode=='data'){
			echo json_encode($this->m_member->peminatan_all());
		}
		else{
			  $data['cmd_status'] = $this->m_rancak->cmd_status();
			  $data['ambil_peminatan'] = $this->m_ol_rancak->ambil_peminatan();
			if($mode=='tambah'){
			  $data['page'] =  $data['page']."_tambah";
    		$data['id_peminatan']  = set_value('id_peminatan',$this->input->post("id_peminatan"));
    		$data['status_minat']  = set_value('status_minat',$this->input->post("status_minat"));    		
				$this->load->view("member/isi",$data);
			}
			if($mode=='simpan_tambah'){
				if($this->input->post('id_peminatan')){
				$id_peminatan = $this->input->post('id_peminatan');
				$kondisi=array('id_peminatan'=>$id_peminatan,'id_pegawai'=>$this->session->id_pegawai);
				$jml = $this->m_umum->jumlah_record_filter('ol_pegawai_minat',$kondisi);
				if($jml == 0){
					  if($this->m_member->simpan_peminatan()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
							redirect(base_url('member/peminatan'));
						}else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
							redirect(base_url('member/peminatan'));
						}
					}else{
							$this->session->set_flashdata('danger', 'Data Sudah Ada');
							redirect(base_url('member/peminatan'));					
					}
				}else{
					redirect(base_url('member'));
				}
			}
			if($mode=='edit'){
			  $data['page'] =  $data['page']."_edit";
				$take = $this->m_umum->ambil_data('ol_pegawai_minat','id_minat',$data['id']);		
				$data['id_peminatan']  = set_value('id_peminatan',$take['id_peminatan']);
				$data['status_minat']  = set_value('status_minat',$take['status_minat']);
				$this->load->view("member/isi",$data);
			}
			if($mode=='simpan_edit'){
			$id_peminatan = $this->input->post('id_peminatan');
			$id_peminatan_lama = $this->input->post('id_peminatan_lama');
			$kondisi=array('id_peminatan'=>$id_peminatan,'id_peminatan !='=>$id_peminatan_lama,'id_pegawai'=>$this->session->id_pegawai);
			$jml = $this->m_umum->jumlah_record_filter('ol_pegawai_minat',$kondisi);
			if($jml == 0){
				  if($this->m_member->rubah_peminatan()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('member/peminatan'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
						redirect(base_url('member/peminatan'));
					}
				}else{
						$this->session->set_flashdata('danger', 'Data Sudah Ada');
						redirect(base_url('member/peminatan'));					
				}
			}
		}
	}
  function pasien_cari_data(){
    $id=$this->input->get('query');
    $hasil=array();
    $data=$this->m_member->cmd_pasien($id);
    $hasil['suggestions']=$data;
    echo json_encode($hasil);
  }
  function rm_cari_data(){
    $id=$this->input->get('query');
    $hasil=array();
    $data=$this->m_member->cmd_rm($id);
    $hasil['suggestions']=$data;
    echo json_encode($hasil);
  }
	function pasien($mode='view'){
		$data['page']="pasien"; 
		$data['header'] = "DATA PASIEN";
		$data['title'] = "DATA PASIEN";
				$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
/*		$data['multi_level'] = $this->m_ol_rancak->ambil_data_link_pengurus($this->session->id_pegawai);
		$data['multi_struktur'] = $this->m_ol_rancak->ambil_data_link_struktur($this->session->id_pegawai);*/
		$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
		$data['ambil_data_a_enabled'] = $this->m_ol_rancak->ambil_data_a_enabled();
//		$data['ol_akses'] = $this->m_ol_rancak->ol_akses($this->session->id_pegawai);
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
		$data['photo'] = $pegawai["foto"];	
		//======================= IMPORTANT =========================================
		$data['id'] = $this->uri->segment(4, 0);
		$data['idp'] = $this->uri->segment(5, 0);
		$data['jml'] = $this->uri->segment(6, 0);
		$koendisi3 = array('id_logbook'=>$data['id']);
		$nm_kwn = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_logbook',$koendisi3,'nkr_kewenangan','id_kewenangan');
		$data['nm_kewenangan'] = $nm_kwn["nama_kewenangan"];
		if($mode=='view'){
			$this->tampil($data);
		}
		else if($mode=='data'){
			echo json_encode($this->m_member->logbook_pasien($data['id']));
		}
  else if($mode=='hapus_pasien'){
  		$this->m_member->hapus_dan_hitung_px($data['id'],$data['idp']);
    	redirect(base_url('member/pasien/view/'.$data['id']));
  }
		else{
      $data['cmd_jk']    = $this->m_rancak->cmd_jk();
      $data['cmd_bahan']    = $this->m_ol_rancak->cmd_bahan();
      $data['cmd_reject']    = $this->m_ol_rancak->cmd_bahan();
      if($mode=='pasien'){
        $data['page'] =  $data['page']."_pasien";
        $lp = $this->m_umum->ambil_crew_logbook_laporan_tabel($data['id']);
				$data['link_awal'] = base_url('member/tabel/view/'.$lp['id_laporan']);
			  $kondisi_cek = array('id_laporan_tabel'=>$data['id'],'barcode_pegawai'=>$this->session->barcode_pegawai);
				$data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan');	
				$select_pasien = array("*");
				$data['ambil_pasien_range'] = $this->m_ol_rancak->ambil_pasien_range($data['idl'],$select_pasien,'jml_logbook');
				$data['lhu']  = set_value('lhu',$lp["lhu"]);
				$this->tampil($data);
      }
			if($mode=='tambah'){
			  $data['page'] =  $data['page']."_tambah";
			  $lpd = $this->m_umum->ambil_data('ol_logbook','id_logbook',$data['id']);
			  $data['id_logbook']  = set_value('id_logbook',$lpd["id_logbook"]);
			  $data['id_pegawai']  = set_value('id_pegawai',$lpd["id_logbooker"]);
			  $data['jml_logbook']  = set_value('jml_logbook',$lpd["jml_logbook"]);
	//		  $data['ambil_pasien'] = $this->m_ol_rancak->ambil_pasien_range($data['idl'],$select_pasien,'jml_logbook');
    		$data['tgl_lahir']  = set_value('tgl_lahir',date('d-m-Y'));
    		$data['nama_pasien']  = set_value('nama_pasien',$this->input->post("nama_pasien"));    		
    		$data['rm']  = set_value('rm',$this->input->post("rm"));    		
    		$data['jk']  = set_value('jk',$this->input->post("jk"));    		
    		$data['alamat']  = set_value('alamat',$this->input->post("alamat"));    		
    		$data['jml_bahan']  = set_value('jml_bahan','0');    		
    		$data['jml_reject']  = set_value('jml_reject','0');    		
    		$data['id_reject']  = set_value('id_reject',$this->input->post("id_reject"));    		
    		$data['id_bahan']  = set_value('id_bahan',$this->input->post("id_bahan"));    		   		    		
				$this->load->view("member/isi",$data);
			}
			if($mode=='simpan_tambah'){
				$id_logbook = $this->input->post("id_logbook");
				$id_pegawai = $this->input->post("id_pegawai");
				$kondisi=array('id_logbook'=>$id_logbook,'id_logbooker'=>$id_pegawai);
				$jml = $this->m_umum->jumlah_record_filter('ol_logbook',$kondisi);
				if($jml == 0){
					$this->session->set_flashdata('danger', 'Data Tidak Valid');
					redirect(base_url('member/pasien/view/'.$id_logbook));
				}else{
				 		$this->m_member->simpan_ol_lpasien();
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('member/pasien/view/'.$id_logbook));
				}
			}
			if($mode=='edit'){
			  $data['page'] =  $data['page']."_edit";
				$keuangan = $this->m_ol_rancak->ambil_logbook_pasien($data['id']);		
				$data['id_logbook_pasien']  = set_value('id_logbook_pasien',$keuangan["id_logbook_pasien"]);
				$data['id_logbook']  = set_value('id_logbook',$keuangan["id_logbook"]);
				$data['id_pasien']  = set_value('id_pasien',$keuangan["id_pasien"]);
				$data['jml_logbook']  = set_value('jml_logbook',$keuangan["jml_logbook"]);
				$data['rm']  = set_value('rm',$keuangan["rm"]);
				$data['nama_pasien']  = set_value('nama_pasien',$keuangan["nama_pasien"]);
				$data['tgl_lahir']  = set_value('tgl_lahir',date('d-m-Y', strtotime($keuangan["tgl_lahir"])));
				$data['jk']  = set_value('jk',$keuangan["jk"]);
				$data['alamat']  = set_value('alamat',$keuangan["alamat"]);
/*				$data['jml_bahan']  = set_value('jml_bahan',$keuangan["jml_bahan"]);
				$data['id_bahan']  = set_value('id_bahan',$keuangan["id_bahan"]);
				$data['jml_reject']  = set_value('jml_reject',$keuangan["jml_reject"]);
				$data['id_reject']  = set_value('id_reject',$keuangan["id_reject"]);*/
				$this->load->view("member/isi",$data);
			}
			if($mode=='simpan_edit'){
				$id_logbook = $this->input->post("id_logbook");
		 		$this->m_member->rubah_ol_lpasien();
				$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
				redirect(base_url('member/pasien/view/'.$id_logbook));
			}
		}
	}
	function ps_pakai($mode='view'){
		$data['page']="ps_pakai"; 
		$data['header'] = "DATA PEMAKAIAN BAKHP";
		$data['title'] = "DATA PEMAKAIAN BAKHP";
				$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
/*		$data['multi_level'] = $this->m_ol_rancak->ambil_data_link_pengurus($this->session->id_pegawai);
		$data['multi_struktur'] = $this->m_ol_rancak->ambil_data_link_struktur($this->session->id_pegawai);*/
		$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
		$data['ambil_data_a_enabled'] = $this->m_ol_rancak->ambil_data_a_enabled();
//		$data['ol_akses'] = $this->m_ol_rancak->ol_akses($this->session->id_pegawai);
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
		$data['photo'] = $pegawai["foto"];	
		//======================= IMPORTANT =========================================
		$data['id'] = $this->uri->segment(4, 0);
		$data['idp'] = $this->uri->segment(5, 0);
		$data['jml'] = $this->uri->segment(6, 0);
		$data['link_awal'] = base_url('member/pasien/view/'.$data['idp']);  
		$koendisi3 = array('id_logbook_pasien'=>$data['id']);
		$nm_kwn = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_logbook_pasien',$koendisi3,'ol_pasien','id_pasien');
		$data['nm_pasien'] = $nm_kwn["nama_pasien"];
		$data['rm'] = $nm_kwn["rm"];
		if($mode=='view'){
			$this->tampil($data);
		}
		else if($mode=='data'){
			echo json_encode($this->m_member->logbook_pasien_pakai($data['id']));
		}
  else if($mode=='hapus_pakai'){
  		  if($this->m_umum->hapus_data('ol_logbook_pakai','id_logbook_pakai',$data['id'])){
    			$this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
    			redirect(base_url('member/ps_pakai/view/'.$data['idp'].'/'.$data['jml']));
  		  }else{
    			$this->session->set_flashdata('danger', 'Masalah Hapus Data');
    			redirect(base_url('member/ps_pakai/view/'.$data['idp'].'/'.$data['jml']));
  		  }
  }
		else{
      $data['cmd_bahan']    = $this->m_ol_rancak->cmd_bahan();
      $data['cmd_reject']    = $this->m_ol_rancak->cmd_reject();
			if($mode=='tambah'){
			  $data['page'] =  $data['page']."_tambah";
        $data['data_pasien'] = $this->m_member->ambil_logbook_pakai($data['id']);  		   		    		
				$this->load->view("member/isi",$data);
			}
			if($mode=='simpan_tambah'){
				$id_logbook_pasien = $this->input->post("id_logbook_pasien");
				$id_logbook = $this->input->post("id_logbook");
				$kondisi=array('id_logbook_pasien'=>$id_logbook_pasien);
				$jml = $this->m_umum->jumlah_record_filter('ol_logbook_pasien',$kondisi);
				if($jml == 0){
					$this->session->set_flashdata('danger', 'Data Tidak Valid');
					redirect(base_url('member/ps_pakai/view/'.$id_logbook_pasien.'/'.$id_logbook));
				}else{
				 		$this->m_member->simpan_bakhp();
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('member/ps_pakai/view/'.$id_logbook_pasien.'/'.$id_logbook));
				}
			}
			if($mode=='edit'){
			  $data['page'] =  $data['page']."_edit";
				$keuangan = $this->m_umum->ambil_data('ol_logbook_pakai','id_logbook_pakai',$data['id']);		
				$data['id_logbook_pasien']  = set_value('id_logbook_pasien',$keuangan["id_logbook_pasien"]);
				$data['id_bahan']  = set_value('id_bahan',$keuangan["id_bahan"]);
				$data['jml_bahan']  = set_value('jml_bahan',$keuangan["jml_bahan"]);
				$this->load->view("member/isi",$data);
			}
			if($mode=='simpan_edit'){
				$id_logbook_pasien = $this->input->post("id_logbook_pasien");
				$id_logbook = $this->input->post("id_logbook");
				$id_logbook_pakai = $this->input->post("id_logbook_pakai");
				$kondisi=array('id_logbook_pasien'=>$id_logbook_pasien);
				$jml = $this->m_umum->jumlah_record_filter('ol_logbook_pasien',$kondisi);
				if($jml == 0){
					$this->session->set_flashdata('danger', 'Data Tidak Valid');
					redirect(base_url('member/ps_pakai/view/'.$id_logbook_pasien.'/'.$id_logbook));
				}else{
				 		$this->m_member->edit_log_bakhp();
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('member/ps_pakai/view/'.$id_logbook_pasien.'/'.$id_logbook));
				}
			}
		}
	}
  function data_bahan()
  {
		$dt=$this->m_ol_rancak->ambil_bahan();
		$data = array();
		foreach($dt as $row){
			$data[] = array("id"=>$row['id_bahan'], "text"=>$row['nama_bahan']);
		}
		echo json_encode($data);
  }
  function data_reject()
  {
		$dt=$this->m_ol_rancak->ambil_reject();
		$data = array();
		foreach($dt as $row){
			$data[] = array("id"=>$row['id_reject'], "text"=>$row['nama_reject']);
		}
		echo json_encode($data);
  }
	function absen($mode='view'){
		$data['page']="absen"; 
		$data['header'] = "DATA ABSENSI";
		$data['title'] = "DATA ABSENSI";
		$this->m_auth->hak_member();
				$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
/*		$data['multi_level'] = $this->m_ol_rancak->ambil_data_link_pengurus($this->session->id_pegawai);
		$data['multi_struktur'] = $this->m_ol_rancak->ambil_data_link_struktur($this->session->id_pegawai);*/
		$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
		$data['ambil_data_a_enabled'] = $this->m_ol_rancak->ambil_data_a_enabled();
//		$data['ol_akses'] = $this->m_ol_rancak->ol_akses($this->session->id_pegawai);
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
		$data['photo'] = $pegawai["foto"];	
		//======================= IMPORTANT =========================================
		$data['id'] = $this->uri->segment(4, 0);
		$data['id2'] = $this->uri->segment(5, 0);
		$data['cmd_ya_tidak'] = $this->m_rancak->cmd_ya_tidak();
		$data['cmd_abs_kategori_absen'] = $this->m_ol_rancak->cmd_abs_kategori_absen();
		// abs_seting
		$kondisi_abs = array('id_unit'=>$this->session->unit,'status_seting'=>1);
		$data['jml'] = $this->m_umum->jumlah_record_filter('abs_seting',$kondisi_abs);
		$ambil_seting = $this->m_umum->ambil_data_kondisi('abs_seting',$kondisi_abs);
		$data['base_location']  = set_value('base_location',$ambil_seting["location"]);
		$data['zoom']  = set_value('zoom',$ambil_seting["zoom"]);
		$data['radius']  = set_value('radius',$ambil_seting["radius"]);
		$data['id_seting']  = set_value('id_seting',$ambil_seting["id_seting"]);
		$data['nama_seting']  = set_value('nama_seting',$ambil_seting["nama_seting"]);
		$data['include_set_radius']  = set_value('include_set_radius',$ambil_seting["include_set_radius"]);
		$unite = $this->m_umum->ambil_data('ol_unit','id_unit',$ambil_seting['id_unit']);
		$data['nama_unit']  = set_value('nama_unit',$unite["nama_unit"]);
		// abs_absen - 1
		$yesterday = date("Y-m-d",strtotime("-1 days"));
		$daykemarin = date("d")-1;
		$yexsterday = date("Y-m")."-".$daykemarin;
		$skr = date("Y-m-d");
		$kondisi_yesterday = array('barcode_pegawai'=>$this->session->barcode_pegawai,'tgl_absen'=>$yesterday);
		$absen_yesterday = $this->m_umum->ambil_data_kondisi('abs_absen',$kondisi_yesterday);
		if(empty($absen_yesterday['clock_out'] && !empty($absen_yesterday['clock_in']))){
			$kondisi_klik = $kondisi_yesterday;
		}else{
			$kondisi_klik = array('barcode_pegawai'=>$this->session->barcode_pegawai,'tgl_absen'=>$skr);
		}
			$kondisi_skr = array('barcode_pegawai'=>$this->session->barcode_pegawai,'tgl_absen'=>$skr);
			$data['absensie'] = $this->m_umum->jumlah_record_filter('abs_absen',$kondisi_skr);
			$absene = $this->m_umum->ambil_data_kondisi('abs_absen',$kondisi_klik);
			$data['id_absen']  = set_value('id_absen',$absene["id_absen"]);
			$data['absclock_in']  = set_value('absclock_in',$absene["clock_in"]);
			$data['absclock_out']  = set_value('absclock_out',$absene["clock_out"]);
		// abs_absen
		$data['id_kategori_absen']  = set_value('id_kategori_absen',$this->input->post('id_kategori_absen'));
if($data['jml'] == 0){
	$data['tombole'] = '<span class="btn btn-danger btn-block"><i class="fa fa-close"></i> &nbsp;Absensi Belum Aktif</span>';
}else{
	if(empty($absen_yesterday['clock_out']) && !empty($absen_yesterday['clock_in'])){
		$data['tombole'] = '<button type="submit" name="action" value="BtnPulang" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Absen Pulang</button>';
	}elseif($data['absensie'] == 0){
		$data['tombole'] = '<button type="submit" name="action" value="BtnMasuk" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Absen Masuk</button>';
	}elseif(empty($absene["clock_out"]) && !empty($absene["clock_in"])){
		$data['tombole'] = '<button type="submit" name="action" value="BtnPulang" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Absen Pulang</button>';		
	}else{
		$data['tombole'] = '<span class="btn btn-danger btn-block"><i class="fa fa-close"></i> &nbsp;Absensi Sudah Dilakukan</span>';
	}
}
		if($mode=='view'){
			if(empty($data['id'])){
				if($this->session->has_userdata('id_absensi')){
					$data['id'] = $this->session->id_absensi;
				}else{
					$data['id'] = '01-'.date('m-Y');
				}
			}
			if(empty($data['id2'])){
				if($this->session->has_userdata('id2_absensi')){
					$data['id2'] = $this->session->id2_absensi;
				}else{
					$data['id2'] = date('d-m-Y');
				}
			}
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$id = $this->input->post("id");
				$id2 = $this->input->post("id2");
				$data_user_level = array(
					'id_absensi'     => $id,
					'id2_absensi'     => $id2
				);
				$this->session->set_userdata($data_user_level);	
				redirect(base_url('member/absen/view/'.$id.'/'.$id2));
			}
			if($action == 'BtnMasuk') {
				$radius = $this->input->post('radius');
				$include_set_radius = $this->input->post('include_set_radius');
				$location = $this->input->post('location');
				$base_location = $this->input->post('base_location');
				$id_kategori_absen = $this->input->post('id_kategori_absen');
				if(empty($location) || empty($id_kategori_absen)){
					$this->session->set_flashdata('danger', 'Data Belum Lengkap Tidak Aktif');
				}else{
					if($include_set_radius == 0){
						$this->m_member->absen_masuk();
						$this->session->set_flashdata('sukses', 'success');
					}else{
						$location_user_exp   = explode(',', $location);
						$latitude_user       = $location_user_exp[0];
						$longitude_user      = trim($location_user_exp[1]);

						$location_office_exp = explode(',', $base_location);
						$latitude_office     = $location_office_exp[0];
						$longitude_office    = trim($location_office_exp[1]);
						$radius_office       = $radius;

						$distance = $this->m_ol_rancak->distance($latitude_office, $longitude_office, $latitude_user, $longitude_user);
						$distance = round($distance['meters']);
						if($distance < $radius_office){
							$this->m_member->absen_masuk();
							$this->session->set_flashdata('sukses', 'success');
						}else{
							$this->session->set_flashdata('danger', 'Your distance exceeds the maximum office radius');
						}
					}
				}
				redirect(base_url('member/absen'));
			}
			if($action == 'BtnPulang') {
				$radius = $this->input->post('radius');
				$include_set_radius = $this->input->post('include_set_radius');
				$location = $this->input->post('location');
				$base_location = $this->input->post('base_location');
				$id_kategori_absen = $this->input->post('id_kategori_absen');
				if(empty($location) || empty($id_kategori_absen)){
					$this->session->set_flashdata('danger', 'Data Belum Lengkap Tidak Aktif');
				}else{
					if($include_set_radius == 0){
						$this->m_member->absen_keluar();
						$this->session->set_flashdata('sukses', 'success');
					}else{
						$location_user_exp   = explode(',', $location);
						$latitude_user       = $location_user_exp[0];
						$longitude_user      = trim($location_user_exp[1]);

						$location_office_exp = explode(',', $base_location);
						$latitude_office     = $location_office_exp[0];
						$longitude_office    = trim($location_office_exp[1]);
						$radius_office       = $radius;

						$distance = $this->m_ol_rancak->distance($latitude_office, $longitude_office, $latitude_user, $longitude_user);
						$distance = round($distance['meters']);
						if($distance < $radius_office){
							$this->m_member->absen_keluar();
							$this->session->set_flashdata('sukses', 'success');
						}else{
							$this->session->set_flashdata('danger', 'Your distance exceeds the maximum office radius');
						}
					}
				}
				redirect(base_url('member/absen'));
			}
		}
		else if($mode=='data'){
			echo json_encode($this->m_member->absensi($data['id'],$data['id2']));
		}else{
			if($mode=='lihat_in'){
			  $data['page'] =  $data['page']."_lihat_in";
				$keuangan = $this->m_ol_rancak->ambil_abs_absen($data['id']);		
				$data['nama_pegawai']  = set_value('nama_pegawai',$keuangan["nama_pegawai"]);
				$data['nama_kategori_absen']  = set_value('nama_kategori_absen',$keuangan["nama_kategori_absen"]);
				$data['nama_seting']  = set_value('nama_seting',$keuangan["nama_seting"]);
				$data['clock_in']  = set_value('clock_in',$keuangan["clock_in"]);
				$data['clock_out']  = set_value('clock_out',$keuangan["clock_out"]);
				$data['location_in']  = set_value('location_in',$keuangan["location_in"]);
				$data['location_out']  = set_value('location_out',$keuangan["location_out"]);
		    $location_user_exp = explode(',', $keuangan["location_in"]);
		    $data['latitude_user']       = $location_user_exp[0];
		    $data['longitude_user']      = trim($location_user_exp[1]);
				$this->load->view("member/isi",$data);
			}
			if($mode=='lihat_out'){
			  $data['page'] =  $data['page']."_lihat_out";
				$keuangan = $this->m_ol_rancak->ambil_abs_absen($data['id']);		
				$data['nama_pegawai']  = set_value('nama_pegawai',$keuangan["nama_pegawai"]);
				$data['nama_kategori_absen']  = set_value('nama_kategori_absen',$keuangan["nama_kategori_absen"]);
				$data['nama_seting']  = set_value('nama_seting',$keuangan["nama_seting"]);
				$data['clock_in']  = set_value('clock_in',$keuangan["clock_in"]);
				$data['clock_out']  = set_value('clock_out',$keuangan["clock_out"]);
				$data['location_in']  = set_value('location_in',$keuangan["location_in"]);
				$data['location_out']  = set_value('location_out',$keuangan["location_out"]);
		    $location_user_exp = explode(',', $keuangan["location_out"]);
		    $data['latitude_user']       = $location_user_exp[0];
		    $data['longitude_user']      = trim($location_user_exp[1]);
				$this->load->view("member/isi",$data);
			}
		}
	}
	function ps_reject($mode='view'){
		$data['page']="ps_reject"; 
		$data['header'] = "DATA PEMAKAIAN REJECT";
		$data['title'] = "DATA PEMAKAIAN REJECT";
				$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
/*		$data['multi_level'] = $this->m_ol_rancak->ambil_data_link_pengurus($this->session->id_pegawai);
		$data['multi_struktur'] = $this->m_ol_rancak->ambil_data_link_struktur($this->session->id_pegawai);*/
		$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
		$data['ambil_data_a_enabled'] = $this->m_ol_rancak->ambil_data_a_enabled();
//		$data['ol_akses'] = $this->m_ol_rancak->ol_akses($this->session->id_pegawai);
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
		$data['photo'] = $pegawai["foto"];	
		//======================= IMPORTANT =========================================
		$data['id'] = $this->uri->segment(4, 0);
		$data['idp'] = $this->uri->segment(5, 0);
		$data['jml'] = $this->uri->segment(6, 0);
		$data['link_awal'] = base_url('member/pasien/view/'.$data['idp']);  
		$koendisi3 = array('id_logbook_pasien'=>$data['id']);
		$nm_kwn = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_logbook_pasien',$koendisi3,'ol_pasien','id_pasien');
		$data['nm_pasien'] = $nm_kwn["nama_pasien"];
		$data['rm'] = $nm_kwn["rm"];
		if($mode=='view'){
			$this->tampil($data);
		}
		else if($mode=='data'){
			echo json_encode($this->m_member->logbook_pasien_reject($data['id']));
		}
  else if($mode=='hapus_reject'){
  		  if($this->m_umum->hapus_data('ol_logbook_reject','id_logbook_reject',$data['id'])){
    			$this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
    			redirect(base_url('member/ps_reject/view/'.$data['idp'].'/'.$data['jml']));
  		  }else{
    			$this->session->set_flashdata('danger', 'Masalah Hapus Data');
    			redirect(base_url('member/ps_reject/view/'.$data['idp'].'/'.$data['jml']));
  		  }
  }
		else{
      $data['cmd_bahan']    = $this->m_ol_rancak->cmd_bahan();
      $data['cmd_reject']    = $this->m_ol_rancak->cmd_reject();
			if($mode=='tambah'){
			  $data['page'] =  $data['page']."_tambah";
        $data['data_pasien'] = $this->m_member->ambil_logbook_reject($data['id']);  		   		    		
				$this->load->view("member/isi",$data);
			}
			if($mode=='simpan_tambah'){
				$id_logbook_pasien = $this->input->post("id_logbook_pasien");
				$id_logbook = $this->input->post("id_logbook");
				$kondisi=array('id_logbook_pasien'=>$id_logbook_pasien);
				$jml = $this->m_umum->jumlah_record_filter('ol_logbook_pasien',$kondisi);
				if($jml == 0){
					$this->session->set_flashdata('danger', 'Data Tidak Valid');
					redirect(base_url('member/ps_reject/view/'.$id_logbook_pasien.'/'.$id_logbook));
				}else{
				 		$this->m_member->simpan_reject();
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('member/ps_reject/view/'.$id_logbook_pasien.'/'.$id_logbook));
				}
			}
			if($mode=='edit'){
			  $data['page'] =  $data['page']."_edit";
				$keuangan = $this->m_umum->ambil_data('ol_logbook_reject','id_logbook_reject',$data['id']);		
				$data['id_logbook_pasien']  = set_value('id_logbook_pasien',$keuangan["id_logbook_pasien"]);
				$data['id_bahan']  = set_value('id_bahan',$keuangan["id_bahan"]);
				$data['id_reject']  = set_value('id_reject',$keuangan["id_reject"]);
				$data['jml_bahan']  = set_value('jml_bahan',$keuangan["jml_reject"]);
				$this->load->view("member/isi",$data);
			}
			if($mode=='simpan_edit'){
				$id_logbook_pasien = $this->input->post("id_logbook_pasien");
				$id_logbook = $this->input->post("id_logbook");
				$kondisi=array('id_logbook_pasien'=>$id_logbook_pasien);
				$jml = $this->m_umum->jumlah_record_filter('ol_logbook_pasien',$kondisi);
				if($jml == 0){
					$this->session->set_flashdata('danger', 'Data Tidak Valid');
					redirect(base_url('member/ps_reject/view/'.$id_logbook_pasien.'/'.$id_logbook));
				}else{
				 		$this->m_member->edit_log_reject();
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('member/ps_reject/view/'.$id_logbook_pasien.'/'.$id_logbook));
				}
			}
		}
	}
	function analisis($mode='view'){
		$data['page']="analisis"; 
		$data['header'] = "DATA ANALISIS KUALITAS";
		$data['title'] = "DATA ANALISIS KUALITAS";
				$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
/*		$data['multi_level'] = $this->m_ol_rancak->ambil_data_link_pengurus($this->session->id_pegawai);
		$data['multi_struktur'] = $this->m_ol_rancak->ambil_data_link_struktur($this->session->id_pegawai);*/
		$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
		$data['ambil_data_a_enabled'] = $this->m_ol_rancak->ambil_data_a_enabled();
//		$data['ol_akses'] = $this->m_ol_rancak->ol_akses($this->session->id_pegawai);
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
		$data['photo'] = $pegawai["foto"];	
		//======================= IMPORTANT =========================================
		$data['all_kah'] = array('0'=>'Range Tanggal','1'=>'Semua');
		$data['ambil_kompetensi_null'] = $this->m_ol_rancak->ambil_kompetensi_null();
		$data['ambil_punit_nonull'] = $this->m_ol_rancak->ambil_punit_nonull2();
		$data['id'] = $this->uri->segment(4, 0);
		$data['id2'] = $this->uri->segment(5, 0);
		$data['id3'] = $this->uri->segment(6, 0);
		$data['id4'] = $this->uri->segment(7, 0);
		if($mode=='view'){
/*			if(empty($data['id'])){
				$data['id'] = '01-01-'.date('Y');
			}
			if(empty($data['id2'])){
				$data['id2'] = date('d-m-Y');
			} */
		if(empty($data['id'])){
			if($this->session->has_userdata('id_analisis')){
				$data['id'] = $this->session->id_analisis;
			}else{
				$data['id'] = '01-'.date('m-Y');
			}
		}
		if(empty($data['id2'])){
			if($this->session->has_userdata('id2_analisis')){
				$data['id2'] = $this->session->id2_analisis;
			}else{
				$data['id2'] = date('d-m-Y');
			}
		}
		if(empty($data['id3'])){
			if($this->session->has_userdata('id3_analisis')){
				$data['id3'] = $this->session->id3_analisis;
			}
		}
		if(empty($data['id4'])){
			if($this->session->has_userdata('id4_analisis')){
				$data['id4'] = $this->session->id4_analisis;
			}
		}
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$first_date = $this->input->post("id");
				$last_date = $this->input->post("id2");
				$tgl = $this->input->post("id3");
				$kat = $this->input->post("id4");
			$data_user_level = array(
				'id_analisis'     => $first_date,
				'id2_analisis'     => $last_date,
				'id3_analisis'     => $tgl,
				'id4_analisis'     => $kat
			);
			$this->session->set_userdata($data_user_level);	
				redirect(base_url('member/analisis/view/'.$first_date.'/'.$last_date.'/'.$tgl.'/'.$kat));
			}
		}
		else if($mode=='data'){
			echo json_encode($this->m_member->logbook_laporan_all($data['id'],$data['id2'],$data['id3'],$data['id4']));
		}
		else{
      if($mode=='share_unit'){
        $data['page'] =  $data['page']."_share_unit";
			  $kondisi_cek = array('id_laporan'=>$data['id'],'barcode_pegawai'=>$this->session->barcode_pegawai);
				$data['cek'] = $this->m_umum->jumlah_record_filter('ol_logbook_laporan',$kondisi_cek);				
				$keuangan = $this->m_umum->ambil_data('ol_logbook_laporan','id_laporan',$data['id']);		
				$data['barcode_pegawai']  = set_value('barcode_pegawai',$keuangan["barcode_pegawai"]);
				$data['id_laporan']  = set_value('id_laporan',$keuangan["id_laporan"]);
				$data['share_it']  = set_value('share_it',$keuangan["share_it"]);
				$data['share_peg']  = set_value('share_peg',$keuangan["share_peg"]);
				$data['share_ins']  = set_value('share_ins',$keuangan["share_ins"]);
    		$data['ambil_unit_instansi'] = $this->m_rancak->ambil_unit_instansi();
				$this->load->view("member/isi",$data);
      }
      if($mode=='simpan_share_unit'){
				$id_laporan = $this->input->post("id_laporan");
				$barcode_pegawai = $this->input->post("barcode_pegawai");
				if($barcode_pegawai == $this->session->barcode_pegawai){
					if($this->m_umum->edit_check('ol_logbook_laporan','share_it','id_laporan',$id_laporan)){
					  $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
						redirect(base_url('member/analisis'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
							redirect(base_url('member/analisis'));
					}
				}else{
						$this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
						redirect(base_url('member/analisis'));					
				}
      }
      if($mode=='share_user'){
        $data['page'] =  $data['page']."_share_user";
			  $kondisi_cek = array('id_laporan'=>$data['id'],'barcode_pegawai'=>$this->session->barcode_pegawai);
				$data['cek'] = $this->m_umum->jumlah_record_filter('ol_logbook_laporan',$kondisi_cek);				
				$keuangan = $this->m_umum->ambil_data('ol_logbook_laporan','id_laporan',$data['id']);		
				$data['barcode_pegawai']  = set_value('barcode_pegawai',$keuangan["barcode_pegawai"]);
				$data['id_laporan']  = set_value('id_laporan',$keuangan["id_laporan"]);
				$data['share_it']  = set_value('share_it',$keuangan["share_it"]);
				$data['share_peg']  = set_value('share_peg',$keuangan["share_peg"]);
				$data['share_ins']  = set_value('share_ins',$keuangan["share_ins"]);
    		$data['ambil_unit_instansi'] = $this->m_rancak->ambil_pegawai_unit_instansi();
				$this->load->view("member/isi",$data);
      }
      if($mode=='simpan_share_user'){
				$id_laporan = $this->input->post("id_laporan");
				$barcode_pegawai = $this->input->post("barcode_pegawai");
				if($barcode_pegawai == $this->session->barcode_pegawai){
					if($this->m_umum->edit_check('ol_logbook_laporan','share_peg','id_laporan',$id_laporan)){
					  $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
						redirect(base_url('member/analisis'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
							redirect(base_url('member/analisis'));
					}
				}else{
						$this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
						redirect(base_url('member/analisis'));					
				}
      }
      if($mode=='share_instansi'){
        $data['page'] =  $data['page']."_share_instansi";
			  $kondisi_cek = array('id_laporan'=>$data['id'],'barcode_pegawai'=>$this->session->barcode_pegawai);
				$data['cek'] = $this->m_umum->jumlah_record_filter('ol_logbook_laporan',$kondisi_cek);				
				$keuangan = $this->m_umum->ambil_data('ol_logbook_laporan','id_laporan',$data['id']);		
				$data['barcode_pegawai']  = set_value('barcode_pegawai',$keuangan["barcode_pegawai"]);
				$data['id_laporan']  = set_value('id_laporan',$keuangan["id_laporan"]);
				$data['share_it']  = set_value('share_it',$keuangan["share_it"]);
				$data['share_peg']  = set_value('share_peg',$keuangan["share_peg"]);
				$data['share_ins']  = set_value('share_ins',$keuangan["share_ins"]);
    		$data['ambil_unit_instansi'] = $this->m_umum->ambil_data('kol_working');
				$this->load->view("member/isi",$data);
      }
      if($mode=='simpan_share_instansi'){
				$id_laporan = $this->input->post("id_laporan");
				$barcode_pegawai = $this->input->post("barcode_pegawai");
				if($barcode_pegawai == $this->session->barcode_pegawai){
					if($this->m_umum->edit_check('ol_logbook_laporan','share_ins','id_laporan',$id_laporan)){
					  $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
						redirect(base_url('member/analisis'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
							redirect(base_url('member/analisis'));
					}
				}else{
						$this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
						redirect(base_url('member/analisis'));					
				}
      }
			if($mode=='tambah'){
			  $data['page'] =  $data['page']."_tambah";
    		$data['tgl_laporan']  = set_value('tgl_laporan',date('d-m-Y'));
    		$data['tgl_awal']  = set_value('tgl_awal',date('d-m-Y'));
    		$data['tgl_akhir']  = set_value('tgl_akhir',date('d-m-Y'));
    		$data['id_working']  = set_value('id_working',$this->input->post("id_working"));    		
    		$data['header_laporan']  = set_value('header_laporan',$this->input->post("header_laporan"));    		
    		$data['sub_header_laporan']  = set_value('sub_header_laporan',$this->input->post("sub_header_laporan"));    		
    		$data['sub_sub_header_laporan']  = set_value('sub_sub_header_laporan',$this->input->post("sub_sub_header_laporan"));    		
    		$data['judul_laporan']  = set_value('judul_laporan',$this->input->post("judul_laporan"));    		
    		$data['tujuan_laporan']  = set_value('tujuan_laporan',$this->input->post("tujuan_laporan"));    		
    		$data['sumber_laporan']  = set_value('sumber_laporan',$this->input->post("sumber_laporan"));    		   		
    		$data['periode_laporan']  = set_value('periode_laporan',$this->input->post("periode_laporan"));    		
				$this->load->view("member/isi",$data);
			}
			if($mode=='simpan_tambah'){
				  if($this->m_member->simpan_analisis()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('member/analisis'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
						redirect(base_url('member/analisis'));
					}
			}
			if($mode=='edit'){
			  $data['page'] =  $data['page']."_edit";
				$keuangan = $this->m_umum->ambil_data('ol_logbook_laporan','id_laporan',$data['id']);		
				$data['tgl_laporan']  = set_value('tgl_laporan',date('d-m-Y', strtotime($keuangan["tgl_laporan"])));
				$data['tgl_awal']  = set_value('tgl_awal',date('d-m-Y', strtotime($keuangan["tgl_awal"])));
				$data['tgl_akhir']  = set_value('tgl_akhir',date('d-m-Y', strtotime($keuangan["tgl_akhir"])));
				$data['id_working']  = set_value('id_working',$keuangan["id_unit"]);
				$data['barcode_pegawai']  = set_value('barcode_pegawai',$keuangan["barcode_pegawai"]);
				$data['header_laporan']  = set_value('header_laporan',$keuangan["header_laporan"]);
				$data['sub_header_laporan']  = set_value('sub_header_laporan',$keuangan["sub_header_laporan"]);
				$data['sub_sub_header_laporan']  = set_value('sub_sub_header_laporan',$keuangan["sub_sub_header_laporan"]);
				$data['judul_laporan']  = set_value('judul_laporan',$keuangan["judul_laporan"]);
				$data['tujuan_laporan']  = set_value('tujuan_laporan',$keuangan["tujuan_laporan"]);
				$data['sumber_laporan']  = set_value('sumber_laporan',$keuangan["sumber_laporan"]);
				$data['periode_laporan']  = set_value('periode_laporan',$keuangan["periode_laporan"]);
				$this->load->view("member/isi",$data);
			}
			if($mode=='simpan_edit'){
				$barcode_pegawai = $this->input->post("barcode_pegawai");
				if($barcode_pegawai == $this->session->barcode_pegawai){
				  if($this->m_member->rubah_analisis()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('member/analisis'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
						redirect(base_url('member/analisis'));
					}
				}else{
						$this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
						redirect(base_url('member/analisis'));					
				}
			}
		  if($mode=='share'){
				if($data['id2'] == $this->session->barcode_pegawai){
		  		$this->m_member->share_un_laporan($data['id'],'1');
		  		$this->session->set_flashdata('sukses', 'Data Berhasil Di Share');
		  		redirect(base_url('member/analisis'));
				}else{
						$this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
						redirect(base_url('member/analisis'));					
				}	
		  }
		  if($mode=='unshare'){
				if($data['id2'] == $this->session->barcode_pegawai){
		  		$this->m_member->share_un_laporan($data['id'],'0');
		  		$this->session->set_flashdata('sukses', 'Data Berhasil Di UnShare');
		  		redirect(base_url('member/analisis'));
				}else{
						$this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
						redirect(base_url('member/analisis'));					
				}	
		  }
		}
	}
	function tabel($mode='view'){
		$data['page']="tabel"; 
		$data['header'] = "DATA TABEL / GRAFIK ANALISIS";
		$data['title'] = "DATA TABEL / GRAFIK ANALISIS";
				$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
/*		$data['multi_level'] = $this->m_ol_rancak->ambil_data_link_pengurus($this->session->id_pegawai);
		$data['multi_struktur'] = $this->m_ol_rancak->ambil_data_link_struktur($this->session->id_pegawai);*/
		$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
		$data['ambil_data_a_enabled'] = $this->m_ol_rancak->ambil_data_a_enabled();
//		$data['ol_akses'] = $this->m_ol_rancak->ol_akses($this->session->id_pegawai);
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
		$data['photo'] = $pegawai["foto"];	
		//======================= IMPORTANT =========================================
		$data['hal'] = $this->uri->segment(3, 0);
		$data['id'] = $this->uri->segment(4, 0);
		$data['idl'] = $this->uri->segment(5, 0);
		$data['idp'] = $this->uri->segment(6, 0);
		$data['cmd_ya_tidak'] = $this->m_rancak->cmd_ya_tidak();
		if($mode=='view'){
				$lap = $this->m_umum->ambil_data('ol_logbook_laporan','id_laporan',$data['id']);
				$data['judul_laporan'] = $lap['judul_laporan'];
				$this->tampil($data);				
		}
		else if($mode=='data'){
			echo json_encode($this->m_member->logbook_laporan_tabel_all($data['id']));
		}
		else if($mode=='data_sesuaikan'){
			echo json_encode($this->m_member->logbook_laporan_tabel_sesuaikan_all($data['id']));
		}
		else if($mode=='data_pasien'){
			echo json_encode($this->m_member->logbook_pasien_instansi($data['id']));
		}
    else if($mode=='pie'){
    		$lp = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($data['id']);
        if($lp['lhu'] == 1){ // 1kompetensi-2bakhp-3reject-4lhu
        	echo json_encode($this->m_member->grafik_pie_opsi_logbook($data['id']));
        }
        if($lp['lhu'] == 2){
        	echo json_encode($this->m_member->grafik_pie_pakai_opsi_pasien($data['id'],'id_bahan','jml_bahan','nama_bahan','id_bahan'));
        }
        if($lp['lhu'] == 3){
        	echo json_encode($this->m_member->grafik_pie_reject_opsi_pasien($data['id'],'id_reject','jml_reject','nama_reject','id_reject'));
        }
        if($lp['lhu'] == 4){
      	    echo json_encode($this->m_member->grafik_pie_opsi_lhu($data['id'],'id_lhu'));
        }
        if($lp['lhu'] == 5){
      	    echo json_encode($this->m_member->grafik_pie_tindakan_daftar($data['id'],'t.id_tindakan'));
        }
        if($lp['lhu'] == 6){
      	    echo json_encode($this->m_member->grafik_pie_tr($data['id']));
        }
        if($lp['lhu'] == 7){
      	    echo json_encode($this->m_member->grafik_pie_berkas($data['id']));
        }
		}
		else{
			if($mode=='tambah_tabel'){
			  $data['page'] =  $data['page']."_tambah_tabel";
			  $kondisi_cek = array('id_laporan'=>$data['id'],'barcode_pegawai'=>$this->session->barcode_pegawai);
				$data['cek'] = $this->m_umum->jumlah_record_filter('ol_logbook_laporan',$kondisi_cek);		
    		$data['judul_laporan_tabel']  = set_value('judul_laporan_tabel',$this->input->post("judul_laporan_tabel"));    		
    		$data['analisa_laporan_tabel']  = set_value('analisa_laporan_tabel',$this->input->post("analisa_laporan_tabel"));    		
    		$data['rekomendasi_laporan_tabel']  = set_value('rekomendasi_laporan_tabel',$this->input->post("rekomendasi_laporan_tabel")); 
				$this->load->view("member/isi",$data);
			}
			if($mode=='simpan_tambah_tabel'){
				$id_laporan = $this->input->post("id_laporan");
			  if($this->m_member->tambah_tabel()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('member/tabel/view/'.$id_laporan));
				}else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
					redirect(base_url('member/tabel/view/'.$id_laporan));
				}
			}
			if($mode=='rubah_tabel'){
			  $data['page'] =  $data['page']."_rubah_tabel";
			  $kondisi_tabel = array('id_tabel <'=>10);
			  $kondisi_cek = array('id_laporan_tabel'=>$data['id'],'barcode_pegawai'=>$this->session->barcode_pegawai);
				$data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan');	
			//	$data['ambil_tabel'] = $this->m_umum->ambil_data_kondisi_result('sn_tabel',$kondisi_tabel);	
		//		$data['ambil_tabel'] = $this->m_ol_rancak->ambil_tabel_personil();	
	//			$kondisi_tbl = array('status_tabel'=>1);
				$data['ambil_tabel'] = $this->m_rancak->ambil_sn_tabel();	
				$kondisi_row = array('id_laporan_tabel'=>$data['id']);
				$lp = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_logbook_laporan_tabel',$kondisi_row,'ol_logbook_laporan','id_laporan');	
    		$data['tabel']  = set_value('tabel',$lp["tabel"]);
    		$data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
    		$data['barcode_pegawai']  = set_value('barcode_pegawai',$lp["barcode_pegawai"]);
				$this->load->view("member/isi",$data);
			}
			if($mode=='simpan_rubah_tabel'){
				$id_laporan = $this->input->post("id_laporan");
				$barcode_pegawai = $this->input->post("barcode_pegawai");
				if($barcode_pegawai == $this->session->barcode_pegawai){
				  if($this->m_member->rubah_tabel()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('member/tabel/view/'.$id_laporan));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
						redirect(base_url('member/tabel/view/'.$id_laporan));
					}
				}else{
						$this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
						redirect(base_url('member/tabel/view/'.$id_laporan));					
				}
			}
			if($mode=='rubah_urutan'){
			  $data['page'] =  $data['page']."_rubah_urutan";
			  $kondisi_cek = array('id_laporan_tabel'=>$data['id'],'barcode_pegawai'=>$this->session->barcode_pegawai);
				$data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan');	
				$kondisi_row = array('id_laporan_tabel'=>$data['id']);
				$lp = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_logbook_laporan_tabel',$kondisi_row,'ol_logbook_laporan','id_laporan');	
    		$data['barcode_pegawai']  = set_value('barcode_pegawai',$lp["barcode_pegawai"]);
    		$data['urutan_laporan_tabel']  = set_value('urutan_laporan_tabel',$lp["urutan_laporan_tabel"]);
    		$data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
				$this->load->view("member/isi",$data);
			}
			if($mode=='simpan_rubah_urutan'){
				$id_laporan = $this->input->post("id_laporan");
				$barcode_pegawai = $this->input->post("barcode_pegawai");
				if($barcode_pegawai == $this->session->barcode_pegawai){
				  if($this->m_member->rubah_urutan()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('member/tabel/view/'.$id_laporan));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
						redirect(base_url('member/tabel/view/'.$id_laporan));
					}
				}else{
						$this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
						redirect(base_url('member/tabel/view/'.$id_laporan));					
				}
			}
			if($mode=='seting_print'){
			  $data['page'] =  $data['page']."_seting_print";
			  $kondisi_cek = array('id_laporan_tabel'=>$data['id'],'barcode_pegawai'=>$this->session->barcode_pegawai);
				$data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan');	
				$kondisi_row = array('id_laporan_tabel'=>$data['id']);
				$lp = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_logbook_laporan_tabel',$kondisi_row,'ol_logbook_laporan','id_laporan');	
    		$data['barcode_pegawai']  = set_value('barcode_pegawai',$lp["barcode_pegawai"]);
    		$data['urutan_laporan_tabel']  = set_value('urutan_laporan_tabel',$lp["urutan_laporan_tabel"]);
    		$data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
    		$data['show_pdf']  = set_value('show_pdf',$lp["show_pdf"]);
				$this->load->view("member/isi",$data);
			}
			if($mode=='simpan_seting_print'){
				$id_laporan = $this->input->post("id_laporan");
				$barcode_pegawai = $this->input->post("barcode_pegawai");
				if($barcode_pegawai == $this->session->barcode_pegawai){
				  if($this->m_member->rubah_show_pdf()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('member/tabel/view/'.$id_laporan));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
						redirect(base_url('member/tabel/view/'.$id_laporan));
					}
				}else{
						$this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
						redirect(base_url('member/tabel/view/'.$id_laporan));					
				}
			}
			if($mode=='rubah_lhu'){
			  $data['page'] =  $data['page']."_rubah_lhu";
			  $data['cmd_lhu_personal'] = $this->m_rancak->cmd_lhu_personal();
			  $kondisi_cek = array('id_laporan_tabel'=>$data['id'],'barcode_pegawai'=>$this->session->barcode_pegawai);
				$data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan');	
				$kondisi_row = array('id_laporan_tabel'=>$data['id']);
				$lp = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_logbook_laporan_tabel',$kondisi_row,'ol_logbook_laporan','id_laporan');	
    		$data['barcode_pegawai']  = set_value('barcode_pegawai',$lp["barcode_pegawai"]);
    		$data['lhu']  = set_value('lhu',$lp["lhu"]);
    		$data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
				$this->load->view("member/isi",$data);
			}
			if($mode=='simpan_rubah_lhu'){
				$id_laporan = $this->input->post("id_laporan");
				$id_laporan_tabel = $this->input->post("id_laporan_tabel");
				$barcode_pegawai = $this->input->post("barcode_pegawai");
				if($barcode_pegawai == $this->session->barcode_pegawai){
				  if($this->m_member->rubah_lhu()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
							redirect(base_url('member/tabel/view/'.$id_laporan));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
							redirect(base_url('member/tabel/view/'.$id_laporan));
					}
				}else{
						$this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
						redirect(base_url('member/tabel/view/'.$id_laporan));					
				}
			}
      if($mode=='tambah_berkas'){
        $data['page'] =  $data['page']."_tambah_berkas";
        $data['kompetensi']=$this->m_ol_rancak->ambil_berkas_laporan();
				$keuangan = $this->m_umum->ambil_data('ol_logbook_laporan_tabel','id_laporan_tabel',$data['id']);
				$data['id_laporan']  = set_value('id_laporan',$keuangan["id_laporan"]);
				$data['id_laporan_tabel']  = set_value('id_laporan_tabel',$keuangan["id_laporan_tabel"]);
				$data['berkase']  = set_value('berkase',$keuangan["berkas"]);
				$this->load->view("member/isi",$data);
      }
      if($mode=='simpan_tambah_berkas'){
				$id_laporan = $this->input->post('id_laporan');
				$this->m_member->simpan_laporan_berkas();
				$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
				redirect(base_url('member/tabel/view/'.$id_laporan));				
      }
      if($mode=='seting_kompetensi'){
        $data['page'] =  $data['page']."_seting_kompetensi";
			  $kondisi_cek = array('id_laporan_tabel'=>$data['id'],'barcode_pegawai'=>$this->session->barcode_pegawai);
				$data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan');	
				$kondisi_row = array('id_laporan_tabel'=>$data['id']);
				$lp = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_logbook_laporan_tabel',$kondisi_row,'ol_logbook_laporan','id_laporan');	
    		$data['barcode_pegawai']  = set_value('barcode_pegawai',$lp["barcode_pegawai"]);
    		$worke = $this->m_umum->ambil_data('ol_unit','id_unit',$lp['id_unit']);
				$data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
				$data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lp["id_laporan_tabel"]);
				$data['kompetensi']  = set_value('kompetensi',$lp["kompetensi"]);
				$data['lhu']  = set_value('lhu',$lp["lhu"]);
        $data['ambil_kompetensi_range'] = $this->m_ol_rancak->ambil_kompetensi_range($lp['tgl_awal'],$lp['tgl_akhir'],$worke['id_instansi']);
				$this->load->view("member/isi",$data);
      }
      if($mode=='simpan_seting_kompetensi'){
				$id_laporan = $this->input->post("id_laporan");
				$id_laporan_tabel = $this->input->post("id_laporan_tabel");
				$barcode_pegawai = $this->input->post("barcode_pegawai");
				if($barcode_pegawai == $this->session->barcode_pegawai){
					if($this->m_member->seting_kompetensi('kompetensi')){
					  $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
						redirect(base_url('member/tabel/view/'.$id_laporan));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
							redirect(base_url('member/tabel/view/'.$id_laporan));
					}
				}else{
						$this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
						redirect(base_url('member/tabel/view/'.$id_laporan));					
				}
      }
      if($mode=='seting_berkas'){
        $data['page'] =  $data['page']."_seting_berkas";
			  $kondisi_cek = array('id_laporan_tabel'=>$data['id'],'barcode_pegawai'=>$this->session->barcode_pegawai);
				$data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan');	
				$kondisi_row = array('id_laporan_tabel'=>$data['id']);
				$lp = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_logbook_laporan_tabel',$kondisi_row,'ol_logbook_laporan','id_laporan');	
    		$data['barcode_pegawai']  = set_value('barcode_pegawai',$lp["barcode_pegawai"]);	
				$data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
				$data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lp["id_laporan_tabel"]);
				$data['i_mutu']  = set_value('i_mutu',$lp["i_mutu"]);
				$data['lhu']  = set_value('lhu',$lp["lhu"]);
				$data['berkas ']  = set_value('berkas ',$lp["berkas "]);
				$select = ('*');
        $data['ambil_imutu_range'] = $this->m_member->ambil_berkas_laporan($data['id'],$select);
				$this->load->view("member/isi",$data);
      }
      if($mode=='simpan_seting_berkas'){
				$id_laporan = $this->input->post("id_laporan");
				$id_laporan_tabel = $this->input->post("id_laporan_tabel");
				$barcode_pegawai = $this->input->post("barcode_pegawai");
				if($barcode_pegawai == $this->session->barcode_pegawai){
					if($this->m_member->seting_kompetensi('i_mutu')){
					  $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
						redirect(base_url('member/tabel/view/'.$id_laporan));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
							redirect(base_url('member/tabel/view/'.$id_laporan));
					}
				}else{
						$this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
						redirect(base_url('member/tabel/view/'.$id_laporan));					
				}
      }
      if($mode=='seting_bahan'){
        $data['page'] =  $data['page']."_seting_bahan";
			  $kondisi_cek = array('id_laporan_tabel'=>$data['id'],'barcode_pegawai'=>$this->session->barcode_pegawai);
				$data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan');	
				$kondisi_row = array('id_laporan_tabel'=>$data['id']);
				$lp = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_logbook_laporan_tabel',$kondisi_row,'ol_logbook_laporan','id_laporan');	
    		$data['barcode_pegawai']  = set_value('barcode_pegawai',$lp["barcode_pegawai"]);
    		$worke = $this->m_umum->ambil_data('ol_unit','id_unit',$lp['id_unit']);
				$data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
				$data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lp["id_laporan_tabel"]);
				$data['bahan']  = set_value('bahan',$lp["bahan"]);
				$data['reject']  = set_value('reject',$lp["reject"]);
				$select = "olp.id_bahan,nama_bahan";
        $data['ambil_kompetensi_range'] = $this->m_ol_rancak->ambil_bare_range($lp['tgl_awal'],$lp['tgl_akhir'],$worke['id_instansi'],$select,'jml_bahan','id_bahan');
				$this->load->view("member/isi",$data);
      }
      if($mode=='simpan_seting_bahan'){
				$id_laporan = $this->input->post("id_laporan");
				$id_laporan_tabel = $this->input->post("id_laporan_tabel");
				$barcode_pegawai = $this->input->post("barcode_pegawai");
				if($barcode_pegawai == $this->session->barcode_pegawai){
					if($this->m_member->seting_kompetensi('bahan')){
					  $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
						redirect(base_url('member/tabel/view/'.$id_laporan));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
							redirect(base_url('member/tabel/view/'.$id_laporan));
					}
				}else{
						$this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
						redirect(base_url('member/tabel/view/'.$id_laporan));					
				}
      }
      if($mode=='seting_range'){
        $data['page'] =  $data['page']."_seting_range";
			  $kondisi_cek = array('id_laporan_tabel'=>$data['id'],'barcode_pegawai'=>$this->session->barcode_pegawai);
				$data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan');	
				$kondisi_row = array('id_laporan_tabel'=>$data['id']);
				$lp = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_logbook_laporan_tabel',$kondisi_row,'ol_logbook_laporan','id_laporan');	
    		$data['barcode_pegawai']  = set_value('barcode_pegawai',$lp["barcode_pegawai"]);
				$data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
				$data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lp["id_laporan_tabel"]);
				$data['min_laporan_tabel']  = set_value('min_laporan_tabel',$lp["min_laporan_tabel"]);
				$data['max_laporan_tabel']  = set_value('max_laporan_tabel',$lp["max_laporan_tabel"]);
				$this->load->view("member/isi",$data);
      }
      if($mode=='simpan_seting_range'){
				$id_laporan = $this->input->post("id_laporan");
				$id_laporan_tabel = $this->input->post("id_laporan_tabel");
				$barcode_pegawai = $this->input->post("barcode_pegawai");
				if($barcode_pegawai == $this->session->barcode_pegawai){
					if($this->m_member->seting_range()){
					  $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
						redirect(base_url('member/tabel/view/'.$id_laporan));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
							redirect(base_url('member/tabel/view/'.$id_laporan));
					}
				}else{
						$this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
						redirect(base_url('member/tabel/view/'.$id_laporan));					
				}
      }
      if($mode=='seting_reject'){
        $data['page'] =  $data['page']."_seting_reject";
			  $kondisi_cek = array('id_laporan_tabel'=>$data['id'],'barcode_pegawai'=>$this->session->barcode_pegawai);
				$data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan');	
				$kondisi_row = array('id_laporan_tabel'=>$data['id']);
				$lp = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_logbook_laporan_tabel',$kondisi_row,'ol_logbook_laporan','id_laporan');	
    		$data['barcode_pegawai']  = set_value('barcode_pegawai',$lp["barcode_pegawai"]);
    		$worke = $this->m_umum->ambil_data('ol_unit','id_unit',$lp['id_unit']);	
				$data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
				$data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lp["id_laporan_tabel"]);
				$data['bahan']  = set_value('bahan',$lp["bahan"]);
				$data['reject']  = set_value('reject',$lp["reject"]);
				$select = "olp.id_reject,nama_reject";
        $data['ambil_kompetensi_range'] = $this->m_ol_rancak->ambil_bare_range($lp['tgl_awal'],$lp['tgl_akhir'],$worke['id_instansi'],$select,'jml_reject','id_reject');
				$this->load->view("member/isi",$data);
      }
      if($mode=='simpan_seting_reject'){
				$id_laporan = $this->input->post("id_laporan");
				$id_laporan_tabel = $this->input->post("id_laporan_tabel");
				$barcode_pegawai = $this->input->post("barcode_pegawai");
				if($barcode_pegawai == $this->session->barcode_pegawai){
					if($this->m_member->seting_kompetensi('reject')){
					  $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
						redirect(base_url('member/tabel/view/'.$id_laporan));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
							redirect(base_url('member/tabel/view/'.$id_laporan));
					}
				}else{
						$this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
						redirect(base_url('member/tabel/view/'.$id_laporan));					
				}
      }
      if($mode=='seting_i_mutu'){
        $data['page'] =  $data['page']."_seting_i_mutu";
			  $kondisi_cek = array('id_laporan_tabel'=>$data['id'],'barcode_pegawai'=>$this->session->barcode_pegawai);
				$data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan');	
				$kondisi_row = array('id_laporan_tabel'=>$data['id']);
				$lp = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_logbook_laporan_tabel',$kondisi_row,'ol_logbook_laporan','id_laporan');	
    		$data['barcode_pegawai']  = set_value('barcode_pegawai',$lp["barcode_pegawai"]);	
				$data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
				$data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lp["id_laporan_tabel"]);
				$data['i_mutu']  = set_value('i_mutu',$lp["i_mutu"]);
				$data['lhu']  = set_value('lhu',$lp["lhu"]);
				$select = ('*');
        $data['ambil_imutu_range'] = $this->m_member->ambil_all_universal_lhu($data['id'],$select);
				$this->load->view("member/isi",$data);
      }
      if($mode=='simpan_seting_i_mutu'){
				$id_laporan = $this->input->post("id_laporan");
				$id_laporan_tabel = $this->input->post("id_laporan_tabel");
				$barcode_pegawai = $this->input->post("barcode_pegawai");
				if($barcode_pegawai == $this->session->barcode_pegawai){
					if($this->m_member->seting_kompetensi('i_mutu')){
					  $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
						redirect(base_url('member/tabel/view/'.$id_laporan));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
							redirect(base_url('member/tabel/view/'.$id_laporan));
					}
				}else{
						$this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
						redirect(base_url('member/tabel/view/'.$id_laporan));					
				}
      }
      if($mode=='seting_item'){
        $data['page'] =  $data['page']."_seting_item";
			  $kondisi_cek = array('id_laporan_tabel'=>$data['id'],'barcode_pegawai'=>$this->session->barcode_pegawai);
				$data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan');
				$select = ('*');
				$data['ambil_item_lhu'] = $this->m_member->ambil_all_universal_lhu($data['id'],$select,'olp.id_item_lhu');	
				$kondisi_row = array('id_laporan_tabel'=>$data['id']);
				$lp = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_logbook_laporan_tabel',$kondisi_row,'ol_logbook_laporan','id_laporan');	
    		$data['barcode_pegawai']  = set_value('barcode_pegawai',$lp["barcode_pegawai"]);
				$data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
				$data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lp["id_laporan_tabel"]);
				$data['item_lhu']  = set_value('item_lhu',$lp["item_lhu"]);
				$this->load->view("member/isi",$data);
      }
      if($mode=='simpan_seting_item'){
				$id_laporan = $this->input->post("id_laporan");
				$id_laporan_tabel = $this->input->post("id_laporan_tabel");
				$barcode_pegawai = $this->input->post("barcode_pegawai");
				if($barcode_pegawai == $this->session->barcode_pegawai){
					if($this->m_member->seting_kompetensi('item_lhu')){
					  $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
						redirect(base_url('member/tabel/view/'.$id_laporan));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
							redirect(base_url('member/tabel/view/'.$id_laporan));
					}
				}else{
						$this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
						redirect(base_url('member/tabel/view/'.$id_laporan));					
				}
      }
      if($mode=='seting_kewenangan'){
        $data['page'] =  $data['page']."_seting_kewenangan";
			  $kondisi_cek = array('id_laporan_tabel'=>$data['id'],'barcode_pegawai'=>$this->session->barcode_pegawai);
				$data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan');
				$data['cmd_komporke'] = $this->m_rancak->cmd_komporke();	
				$kondisi_row = array('id_laporan_tabel'=>$data['id']);
				$lp = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_logbook_laporan_tabel',$kondisi_row,'ol_logbook_laporan','id_laporan');	
    		$data['barcode_pegawai']  = set_value('barcode_pegawai',$lp["barcode_pegawai"]);
				$data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
				$data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lp["id_laporan_tabel"]);
				$data['kewenangan']  = set_value('kewenangan',$lp["kewenangan"]);
				$this->load->view("member/isi",$data);
      }
      if($mode=='simpan_seting_kewenangan'){
				$id_laporan = $this->input->post("id_laporan");
				$id_laporan_tabel = $this->input->post("id_laporan_tabel");
				$barcode_pegawai = $this->input->post("barcode_pegawai");
				if($barcode_pegawai == $this->session->barcode_pegawai){
					if($this->m_member->seting_kewenangan()){
					  $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
						redirect(base_url('member/tabel/view/'.$id_laporan));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
							redirect(base_url('member/tabel/view/'.$id_laporan));
					}
				}else{
						$this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
						redirect(base_url('member/tabel/view/'.$id_laporan));					
				}
      }
      if($mode=='seting_isi_kompetensi'){
        $data['page'] =  $data['page']."_seting_isi_kompetensi";
			  $kondisi_cek = array('id_laporan_tabel'=>$data['id'],'barcode_pegawai'=>$this->session->barcode_pegawai);
				$data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan');
				$data['ambil_isi_kompetensi'] = $this->m_member->ambil_isi_kompetensi($data['id']);	
				$kondisi_row = array('id_laporan_tabel'=>$data['id']);
				$lp = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_logbook_laporan_tabel',$kondisi_row,'ol_logbook_laporan','id_laporan');	
    		$data['barcode_pegawai']  = set_value('barcode_pegawai',$lp["barcode_pegawai"]);
				$data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
				$data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lp["id_laporan_tabel"]);
				$data['isi_kompetensi']  = set_value('isi_kompetensi',$lp["isi_kompetensi"]);
				$this->load->view("member/isi",$data);
      }
      if($mode=='simpan_seting_isi_kompetensi'){
				$id_laporan = $this->input->post("id_laporan");
				$id_laporan_tabel = $this->input->post("id_laporan_tabel");
				$barcode_pegawai = $this->input->post("barcode_pegawai");
				if($barcode_pegawai == $this->session->barcode_pegawai){
					if($this->m_member->seting_kompetensi('isi_kompetensi')){
					  $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
						redirect(base_url('member/tabel/view/'.$id_laporan));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
							redirect(base_url('member/tabel/view/'.$id_laporan));
					}
				}else{
						$this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
						redirect(base_url('member/tabel/view/'.$id_laporan));					
				}
      }
      if($mode=='pasien'){
        $data['page'] =  $data['page']."_pasien";
        $lp = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($data['id']);
				$data['link_awal'] = base_url('member/tabel/view/'.$lp['id_laporan']);
			  $kondisi_cek = array('id_laporan_tabel'=>$data['id'],'barcode_pegawai'=>$this->session->barcode_pegawai);
				$data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan');	
				$select_pasien = array("*");
				$data['ambil_pasien_range'] = $this->m_ol_rancak->ambil_pasien_range($data['idl'],$select_pasien,'jml_logbook');
				$data['lhu']  = set_value('lhu',$lp["lhu"]);
				$this->tampil($data);
      }
			if($mode=='clone'){
			  $data['page'] =  $data['page']."_clone";
			  $data['cmd_judul_laporan'] = $this->m_rancak->cmd_ol_logbook_judul_laporan();
			  $kondisi_cek = array('id_laporan_tabel'=>$data['id'],'barcode_pegawai'=>$this->session->barcode_pegawai);
				$data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan');	
				$kondisi_row = array('id_laporan_tabel'=>$data['id']);
				$lp = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_logbook_laporan_tabel',$kondisi_row,'ol_logbook_laporan','id_laporan');	
    		$data['barcode_pegawai']  = set_value('barcode_pegawai',$lp["barcode_pegawai"]);
    		$data['lhu']  = set_value('lhu',$lp["lhu"]);
    		$data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lp["id_laporan_tabel"]);
    		$data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
				$this->load->view("member/isi",$data);
			}
			if($mode=='simpan_clone'){
				$id_laporan = $this->input->post("id_laporan");
				$id_laporan_tabel = $this->input->post("id_laporan_tabel");
				$barcode_pegawai = $this->input->post("barcode_pegawai");
				if($barcode_pegawai == $this->session->barcode_pegawai){
				  if($this->m_member->tambah_tabel_clone($id_laporan_tabel)){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
							redirect(base_url('member/tabel/view/'.$id_laporan));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
							redirect(base_url('member/tabel/view/'.$id_laporan));
					}
				}else{
						$this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
						redirect(base_url('member/tabel/view/'.$id_laporan));					
				}
			}
			if($mode=='disabel'){
			  $data['page'] =  $data['page']."_disabel";
			  $kondisi_cek = array('id_laporan_tabel'=>$data['id'],'barcode_pegawai'=>$this->session->barcode_pegawai);
				$data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan');	
				$kondisi_row = array('id_laporan_tabel'=>$data['id']);
				$lp = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_logbook_laporan_tabel',$kondisi_row,'ol_logbook_laporan','id_laporan');	
    		$data['barcode_pegawai']  = set_value('barcode_pegawai',$lp["barcode_pegawai"]);
    		$data['lhu']  = set_value('lhu',$lp["lhu"]);
    		$data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lp["id_laporan_tabel"]);
    		$data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
    		$data['status_urutan_tabel']  = set_value('status_urutan_tabel',$lp["status_urutan_tabel"]);
				$this->load->view("member/isi",$data);
			}
			if($mode=='simpan_disabel'){
				$id_laporan = $this->input->post("id_laporan");
				$id_laporan_tabel = $this->input->post("id_laporan_tabel");
				$barcode_pegawai = $this->input->post("barcode_pegawai");
				if($barcode_pegawai == $this->session->barcode_pegawai){
				  if($this->m_member->edit_tabel_status()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
							redirect(base_url('member/tabel/view/'.$id_laporan));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
							redirect(base_url('member/tabel/view/'.$id_laporan));
					}
				}else{
						$this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
						redirect(base_url('member/tabel/view/'.$id_laporan));					
				}
			}
     if($mode=='sesuaikan'){
        $data['page'] =  $data['page']."_sesuaikan";
				$lp = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($data['id']); // id_laporan_tabel
				$worke = $this->m_umum->ambil_data('ol_unit','id_unit',$lp['id_unit']);
				$data['link_awal'] = base_url('member/tabel/view/'.$lp['id_laporan']);
			  $kondisi_cek = array('id_laporan_tabel'=>$data['id'],'barcode_pegawai'=>$this->session->barcode_pegawai);
				$data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan');	
				$data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
				$data['urutan_laporan_tabel']  = set_value('urutan_laporan_tabel',$lp["urutan_laporan_tabel"]);
				$data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lp["id_laporan_tabel"]);
				$data['id_instansi']  = set_value('id_instansi',$lp["id_instansi"]);
				$data['id_pegawai']  = set_value('id_pegawai',$lp["id_pegawai"]);
				$data['judul_laporan_tabel']  = set_value('judul_laporan_tabel',$lp["judul_laporan_tabel"]);
/*				$data['min_laporan_tabel']  = set_value('min_laporan_tabel',$lp["min_laporan_tabel"]);
				$data['max_laporan_tabel']  = set_value('max_laporan_tabel',$lp["max_laporan_tabel"]);*/
				$data['analisa_laporan_tabel']  = set_value('analisa_laporan_tabel',$lp["analisa_laporan_tabel"]);
				$data['rekomendasi_laporan_tabel']  = set_value('rekomendasi_laporan_tabel',$lp["rekomendasi_laporan_tabel"]);
				$data['barcode_pegawai']  = set_value('barcode_pegawai',$lp["barcode_pegawai"]);
				$data['idpeg']  = set_value('idpeg',$lp["id_pegawai"]);
				$data['share_it']  = set_value('share_it',$lp["share_it"]);
				$data['tgl_awal']  = set_value('tgl_awal',date('d-m-Y', strtotime($lp["tgl_awal"])));
				$data['tgl_akhir']  = set_value('tgl_akhir',date('d-m-Y', strtotime($lp["tgl_akhir"])));
				$data['tabel']  = set_value('tabel',$lp["tabel"]);
				$data['lhu']  = set_value('lhu',$lp["lhu"]);
				$data['isi_kompetensi']  = set_value('isi_kompetensi',$lp["isi_kompetensi"]);
				$data['kompetensi']  = set_value('kompetensi',$lp["kompetensi"]);
				$data['kewenangan']  = set_value('kewenangan',$lp["kewenangan"]);
      	if(empty($lp["min_laporan_tabel"])){
      		$data['min_laporan_tabel'] = '0';
      	}else{
      		$data['min_laporan_tabel'] = $lp["min_laporan_tabel"];
      	}
      	if(empty($lp["max_laporan_tabel"])){
      		$data['max_laporan_tabel'] = '0';
      	}else{
      		$data['max_laporan_tabel'] = $lp["max_laporan_tabel"];
      	}
//=========================================================================== LHU 1
      	//'1'=>'Kompetensi','2'=>'BAKHP','3'=>'Reject','4'=>'QC / IM','5'=>'Pendaftaran Pasien','6'=>'Time Respon','7'=>'Berkas'
        if($data['lhu'] == 1){ // 1kompetensi-2bakhp-3reject-4lhu
        	$data['ambil_lhu'] = $this->m_member->ambil_lhu_logbook($data['id']);
        	$data['ambil_bulan'] = $this->m_member->ambil_bulan_laporan_logbook($data['id']);
        	$data['garis_trend'] = $this->m_member->garis_trend($data['id']);
        	$data['grafik_garis_opsi'] = $this->m_member->grafik_garis_opsi_logbook($data['id']);
if($data['kewenangan'] == 1){
$data['select2'] = ("ol_logbook.id_kewenangan  as id_lhu,sum(jml_logbook) as hasil_lhu_detil,tgl_logbook as tgl_lhu,nama_kewenangan as nama_lhu");
$data['grup2'] = "ol_logbook.id_kewenangan";
}else{
$data['select2'] = ("nkr_kewenangan.id_kompetensi  as id_lhu,sum(jml_logbook) as hasil_lhu_detil,tgl_logbook as tgl_lhu,nama_kompetensi as nama_lhu"); 
$data['grup2'] = "nkr_kewenangan.id_kompetensi";
}
$data['tabel1'] = 'ol_logbook';
$data['group1'] = 'MONTH(tgl_logbook)';
$data['grtgl'] = 'tgl_logbook';
$data['jumlah'] = 'jml_logbook >';
$data['konbln'] = array('id_logbooker'=>$data['id_pegawai'],$data['jumlah']=>0,'id_instansi'=>$data['id_instansi']);  
$grup2 = 'MONTH(tgl_logbook)';
$kondisi2 = array('tgl_logbook >='=>$lp["tgl_awal"],'tgl_logbook <='=>$lp["tgl_akhir"],'jml_logbook >'=>0,'id_logbooker'=>$data['id_pegawai'],'id_instansi'=>$data['id_instansi']);
$data['ambil_bulan_grafik'] = $this->m_member->grafik_garis_opsi('ol_logbook',$data['select2'],$kondisi2,$data['id'],$data['lhu'],$grup2);
$data['ambil_limbah_grafik'] = $this->m_member->grafik_garis_opsi('ol_logbook',$data['select2'],$kondisi2,$data['id'],$data['lhu'],$data['grup2']);
        }
//=========================================================================== LHU 2
        if($data['lhu'] == 2){
$data['tabel1'] = 'ol_logbook_pakai';
$data['group1'] = 'MONTH(tgl_logbook)';
$data['jumlah'] = 'jml_bahan >';
$data['konbln'] = array('id_logbooker'=>$data['id_pegawai'],$data['jumlah']=>0,'id_instansi'=>$data['id_instansi']);  
$data['select2'] = ("ol_bahan.in_bahan  as id_lhu,sum(jml_bahan) as hasil_lhu_detil,tgl_logbook as tgl_lhu,nama_bahan as nama_lhu"); 
$data['grup2'] = "ol_logbook_pakai.id_bahan";
        	$data['ambil_lhu'] = $this->m_member->ambil_data_bakhp($data['id'],'olpk.id_bahan','jml_bahan');
        	$data['ambil_bulan'] = $this->m_member->ambil_data_bulan_bakhp($data['id'],'olpk.id_bahan','jml_bahan');
        	$data['grafik_garis_opsi'] = $this->m_member->grafik_garis_opsi_pakai($data['id'],'olpk.id_bahan','jml_bahan','nama_bahan');
        	$data['ambil_limbah_grafik'] = $this->m_member->grafik_garis_opsi_pakai($data['id'],'olpk.id_bahan','jml_bahan','nama_bahan','olpk.id_bahan');
        }
        if($data['lhu'] == 3){
$data['tabel1'] = 'ol_logbook_reject';
$data['group1'] = 'MONTH(tgl_logbook)';
$data['grtgl'] = 'tgl_logbook';
$data['grtgl'] = 'tgl_logbook';
$data['jumlah'] = 'jml_reject >';
$data['konbln'] = array('id_logbooker'=>$data['id_pegawai'],$data['jumlah']=>0,'id_instansi'=>$data['id_instansi']);  
$data['select2'] = ("ol_logbook_reject.id_reject  as id_lhu,sum(jml_reject) as hasil_lhu_detil,tgl_logbook as tgl_lhu,nama_reject as nama_lhu"); 
$data['grup2'] = "ol_logbook_reject.id_reject";
        	$data['ambil_lhu'] = $this->m_member->ambil_data_reject($data['id'],'olpk.id_reject','jml_reject');
        	$data['ambil_bulan'] = $this->m_member->ambil_data_bulan_reject($data['id'],'olpk.id_reject','jml_reject');
        	$data['grafik_garis_opsi'] = $this->m_member->grafik_garis_opsi_reject($data['id'],'olpk.id_reject','jml_reject','nama_reject');
        	$data['ambil_limbah_grafik'] = $this->m_member->grafik_garis_opsi_reject($data['id'],'olpk.id_reject','jml_reject','nama_reject','olpk.id_reject');
        }
        if($data['lhu'] == 4){
$data['tabel1'] = 'ol_logbook_lhu_detil';
$data['group1'] = 'MONTH(tgl_lhu)';
$data['grtgl'] = 'tgl_lhu';
$data['jumlah'] = 'hasil_lhu_detil >';
$data['konbln'] = array($data['jumlah']=>0);
$data['select2'] = ("ol_logbook_item_lhu.in_item_lhu  as id_lhu,sum(hasil_lhu_detil) as hasil_lhu_detil,tgl_lhu,concat(nama_item_lhu,' - ',nama_equipment) as nama_lhu"); 
$data['grup2'] = "ol_logbook_lhu_detil.id_item_lhu";
$data['select_lhu'] = ("*,hasil_lhu_detil as jml_logbook,olp.id_item_lhu as id_lhu,concat(nama_item_lhu,' - ',nama_equipment) as nama_lhu");
$data['selectk'] = ("*,SUM(hasil_lhu_detil) as jumlaha,olp.id_item_lhu as id_kompetensi,concat(nama_item_lhu,' - ',nama_equipment) as nama_kompetensi");
        		$data['select_jscode'] = ("olp.id_item_lhu as id_lhu,hasil_lhu_detil");
        		$select_opsi = ("olp.id_item_lhu as id_lhu,
        			concat(nama_item_lhu,' - ',nama_equipment) as nama_lhu,
							DATE_FORMAT(tgl_lhu,'%d-%m-%Y') as tgl_lhu,hasil_lhu_detil,
							DATE_FORMAT(tgl_lhu,'%Y') as thn,
							DATE_FORMAT(tgl_lhu,'%m') as bln,
							DATE_FORMAT(tgl_lhu,'%d') as hr");
      	    $data['ambil_lhu'] = $this->m_member->ambil_universal_lhu($data['id'],$data['select_lhu']);
      	    $data['ambil_bulan'] = $this->m_member->ambil_universal_bulan_lhu($data['id'],$data['select_lhu']);
      	    $data['grafik_garis_opsi'] = $this->m_member->grafik_garis_opsi_lhu($data['id'],$select_opsi);
      	    $data['ambil_limbah_grafik'] = $this->m_member->grafik_garis_opsi_lhu($data['id'],$select_opsi,'olp.id_item_lhu');
        }
        if($data['lhu'] == 5){
$data['tabel1'] = 'tindakan_daftar';
$data['group1'] = 'MONTH(tgl_daftar)';
$data['grtgl'] = 'tgl_daftar';
$data['konbln'] = array('id_instansi'=>$data['id_instansi']);
$data['select2'] = ("tindakan.in_tindakan  as id_lhu,count(id_daftar) as hasil_lhu_detil,tgl_daftar as tgl_lhu,concat(nama_tindakan,' - ',nama_golongan_pemeriksaan) as nama_lhu");
$data['grup2'] = "tindakan_daftar.id_tindakan";
$data['select_lhu'] = ("*,count(id_daftar) as jml_logbook,td.id_tindakan as id_lhu,concat(nama_tindakan,' - ',nama_golongan_pemeriksaan) as nama_lhu");
$data['selectk'] = ("*,count(id_daftar) as jumlaha,td.id_tindakan as id_kompetensi,concat(nama_tindakan,' - ',nama_golongan_pemeriksaan) as nama_kompetensi");
        		$data['select_jscode'] = ("td.id_tindakan as id_lhu,count(id_daftar) as hasil_lhu_detil");
        		$select_opsi = ("td.id_tindakan as id_lhu,
        			concat(nama_tindakan,' - ',nama_golongan_pemeriksaan) as nama_lhu,
							DATE_FORMAT(tgl_daftar,'%d-%m-%Y') as tgl_daftar,count(id_daftar) as hasil_lhu_detil,
							DATE_FORMAT(tgl_daftar,'%Y') as thn,
							DATE_FORMAT(tgl_daftar,'%m') as bln,
							DATE_FORMAT(tgl_daftar,'%d') as hr");
      	    $data['ambil_lhu'] = $this->m_member->ambil_daftar_tindakan_lhu($data['id'],$data['select_lhu']);
      	    $data['ambil_bulan'] = $this->m_member->ambil_tindakan_daftar_bulan_lhu($data['id'],$data['select_lhu']);
      	    $data['grafik_garis_opsi'] = $this->m_member->grafik_garis_tindakan_daftar_lhu($data['id'],$select_opsi);
      	    $data['ambil_limbah_grafik'] = $this->m_member->grafik_garis_tindakan_daftar_lhu($data['id'],$select_opsi,'td.id_tindakan');
        }
        if($data['lhu'] == 6){
$data['slct_range'] = ("*,
	waktu_tunggu as jml_logbook,id_tr as id_lhu,nama_time_respon as nama_lhu,
  if (max_laporan_tabel IS NULL or max_laporan_tabel = 0 ,SUM(case when waktu_tunggu > ".$lp["min_laporan_tabel"]." then 1 else 0 end),
  		 if(min_laporan_tabel IS NULL or min_laporan_tabel = 0,SUM(case when waktu_tunggu < ".$lp["max_laporan_tabel"]." then 1 else 0 end),
  		 SUM(CASE WHEN waktu_tunggu BETWEEN ".$lp["min_laporan_tabel"]." and ".$lp["max_laporan_tabel"]." THEN 1 ELSE 0 END)) as total
	");
$data['slct_tr'] = ("*,waktu_tunggu as hasil_lhu_detil,id_tr as id_lhu,nama_time_respon as nama_lhu,tgl_tr as tgl_lhu");
$data['kon_tr'] = array('status_tr'=>1);
    	    $data['ambil_range'] = $this->m_member->ambil_time_laporan($data['id'],$data['slct_tr'],$data['kon_tr']);
    	    $data['ambil_lhu'] = $this->m_member->ambil_time_laporan($data['id'],$data['slct_tr'],$data['kon_tr']);
    	    $data['ambil_bulan'] = $this->m_member->ambil_time_laporan($data['id'],$data['slct_tr'],$data['kon_tr'],'MONTH(tgl_tr)');
        }
        if($data['lhu'] == 7){
$data['slct_range'] = ("*,
id_berkas as id_lhu,count(id_berkas) as hasil_lhu_detil,
				if (nama_kategori_pelatihan IS NULL or nama_kategori_pelatihan = '' ,SUM(case when nama_kategori_pelatihan IS NULL or nama_kategori_pelatihan = '' then 1 else 0 end),SUM(case when nama_kategori_pelatihan IS NOT NULL or nama_kategori_pelatihan <> '' then 1 else 0 end)) as total,
				if(nama_kategori_pelatihan IS NULL or nama_kategori_pelatihan = '','Bukan Kategori Pelatihan',nama_kategori_pelatihan) as nama_lhu,
				DATE_FORMAT(tgl_b_berkas,'%d-%m-%Y') as tgl_lhu,
				DATE_FORMAT(tgl_b_berkas,'%Y') as thn,
				DATE_FORMAT(tgl_b_berkas,'%m') as bln,
				DATE_FORMAT(tgl_b_berkas,'%d') as hr
	");
$data['slct_tr'] = ("*,id_berkas as id_lhu,count(id_berkas) as hasil_lhu_detil,if(nama_kategori_pelatihan IS NULL or nama_kategori_pelatihan = '','Bukan Kategori Pelatihan',nama_kategori_pelatihan) as nama_lhu,DATE_FORMAT(tgl_b_berkas,'%d-%m-%Y') as tgl_lhu
	");
$data['kon_tr'] = array('status_berkas'=>1);
    	    $data['ambil_range'] = $this->m_member->ambil_berkas_laporan($data['id'],$data['slct_tr'],$data['kon_tr']);
    	    $data['ambil_lhu'] = $this->m_member->ambil_berkas_laporan($data['id'],$data['slct_tr'],$data['kon_tr']);
    	    $data['ambil_bulan'] = $this->m_member->ambil_berkas_laporan($data['id'],$data['slct_tr'],$data['kon_tr']);

        	$data['kondisi_berkas'] = array('id_kategori_berkas >'=>13,'link_berkas !='=>'','status_berkas'=>1);
        	$data['kondisi_imut'] = array('id_kategori_berkas'=>12,'link_berkas !='=>'','status_berkas'=>1);
        	$data['kondisi_ijasah'] = array('id_kategori_berkas'=>7,'link_berkas !='=>'','status_berkas'=>1);
        	$data['kondisi_pelatihan'] = array('kunci'=>1,'link_berkas !='=>'','status_berkas'=>1);
        	$data['kondisi_str'] = array('kunci'=>0,'link_berkas !='=>'','status_berkas'=>1);
        	$data['ambil_berkas'] = $this->m_member->ambil_logbook_berkas($data['id'],$data['kondisi_berkas'],'id_kategori_berkas','asc');
        	$data['jml_berkas'] = $this->m_member->jumlah_record_filter_berkas($data['id'],$data['kondisi_berkas']);
        	$data['ambil_imut'] = $this->m_member->ambil_logbook_berkas($data['id'],$data['kondisi_imut'],'id_kategori_berkas','asc');
        	$data['jml_imut'] = $this->m_member->jumlah_record_filter_berkas($data['id'],$data['kondisi_imut']);
        	$data['ambil_ijasah'] = $this->m_member->ambil_logbook_berkas($data['id'],$data['kondisi_ijasah'],'id_kategori_berkas','asc');
        	$data['jml_ijasah'] = $this->m_member->jumlah_record_filter_berkas($data['id'],$data['kondisi_ijasah']);
        	$data['ambil_pelatihan'] = $this->m_member->ambil_logbook_berkas($data['id'],$data['kondisi_pelatihan'],'id_kategori_berkas','asc');
        	$data['jml_pelatihan'] = $this->m_member->jumlah_record_filter_berkas($data['id'],$data['kondisi_pelatihan']);
        	$data['ambil_str'] = $this->m_member->ambil_logbook_berkas($data['id'],$data['kondisi_str'],'id_kategori_berkas','asc');
        	$data['jml_str'] = $this->m_member->jumlah_record_filter_berkas($data['id'],$data['kondisi_str']);
        }
        if($data['lhu'] == 8){

        }
//=========================================================================== END LHU
				$this->form_validation->set_rules('id_laporan_tabel','id_laporan_tabel','required');
        if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
        }else{
					$id_laporan = $this->input->post("id_laporan");
					$id_laporan_tabel = $this->input->post("id_laporan_tabel");
					if($this->m_member->edit_logbook_laporan_tabel()){
					  $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
						redirect(base_url('member/tabel/view/'.$id_laporan));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
						redirect(base_url('member/tabel/view/'.$id_laporan));
					}
        }
      }
		}
	}
  function lt($mode='view')
  {
    $data['page']  = "lt";
		$data['header'] = "GRAFIK TAHUNAN";
		$data['title'] = "GRAFIK TAHUNAN";
				$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
/*		$data['multi_level'] = $this->m_ol_rancak->ambil_data_link_pengurus($this->session->id_pegawai);
		$data['multi_struktur'] = $this->m_ol_rancak->ambil_data_link_struktur($this->session->id_pegawai);
		$data['ol_akses'] = $this->m_ol_rancak->ol_akses($this->session->id_pegawai);*/
		$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
		$data['ambil_data_a_enabled'] = $this->m_ol_rancak->ambil_data_a_enabled();
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
				if(!empty($data['asesor'])){
			$data['level_name'] = $asesor["nama_komite"];
		}else{
			$data['level_name'] = $pegawai["nama_level"];			
  	}
		$data['photo'] = $pegawai["foto"];	
		$data['bcp_id_pegawai'] = $pegawai["id_pegawai"];
	$data['bln']   = $this->uri->segment(4, 0);
	$data['thn']   = $this->uri->segment(5, 0);
	if(empty($data['bln'])){
		$data['bln'] = date('m');
	}
	if(empty($data['thn'])){
		$data['thn'] = date('Y');
	}
	$data['array_month'] = $this->m_rancak->cmd_bulan();
	$data['array_page'] = array('lt'=>'Tahunan','lb'=>'Bulanan','lh'=>'Harian');
	$data['year_logbook']=$this->m_ol_rancak->cmd_tahun_logbook();
	$data['ambil_kol_golongan_pemeriksaan_graph'] = $this->m_member->ambil_kol_golongan_pemeriksaan_graph($data['page'],$data['bln'],$data['thn'],$data['bcp_id_pegawai']);
	$data['json'] = $this->m_member->lt($this->session->id_pegawai);
	if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$page = $this->input->post("page");
			$bln = $this->input->post("bln");
			$thn = $this->input->post("thn");
			redirect(base_url('member/'.$page.'/view/'.$bln.'/'.$thn));
		}
	}
  }
  function lb($mode='view')
  {
    $data['page']  = "lb";
		$data['header'] = "GRAFIK BULANAN";
		$data['title'] = "GRAFIK BULANAN";
				$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
/*		$data['multi_level'] = $this->m_ol_rancak->ambil_data_link_pengurus($this->session->id_pegawai);
		$data['multi_struktur'] = $this->m_ol_rancak->ambil_data_link_struktur($this->session->id_pegawai);
		$data['ol_akses'] = $this->m_ol_rancak->ol_akses($this->session->id_pegawai);*/
		$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
		$data['ambil_data_a_enabled'] = $this->m_ol_rancak->ambil_data_a_enabled();
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
				if(!empty($data['asesor'])){
			$data['level_name'] = $asesor["nama_komite"];
		}else{
			$data['level_name'] = $pegawai["nama_level"];			
  	}
		$data['photo'] = $pegawai["foto"];	
		$data['bcp_id_pegawai'] = $pegawai["id_pegawai"];
	$data['bln']   = $this->uri->segment(4, 0);
	$data['thn']   = $this->uri->segment(5, 0);
	if(empty($data['bln'])){
		$data['bln'] = date('m');
	}
	if(empty($data['thn'])){
		$data['thn'] = date('Y');
	}
	$data['array_month'] = $this->m_rancak->cmd_bulan();
	$data['array_page'] = array('lt'=>'Tahunan','lb'=>'Bulanan','lh'=>'Harian');
	$data['year_logbook']=$this->m_ol_rancak->cmd_tahun_logbook();
	$data['ambil_kol_golongan_pemeriksaan_graph'] = $this->m_member->ambil_kol_golongan_pemeriksaan_graph($data['page'],$data['bln'],$data['thn'],$data['bcp_id_pegawai']);
	$data['json'] = $this->m_member->lb($data['thn'],$this->session->id_pegawai);
	if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$page = $this->input->post("page");
			$bln = $this->input->post("bln");
			$thn = $this->input->post("thn");
			redirect(base_url('member/'.$page.'/view/'.$bln.'/'.$thn));
		}
	}
  }
  function lh($mode='view')
  {
    $data['page']  = "lh";
		$data['header'] = "GRAFIK HARIAN";
		$data['title'] = "GRAFIK HARIAN";
				$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
/*		$data['multi_level'] = $this->m_ol_rancak->ambil_data_link_pengurus($this->session->id_pegawai);
		$data['multi_struktur'] = $this->m_ol_rancak->ambil_data_link_struktur($this->session->id_pegawai);
		$data['ol_akses'] = $this->m_ol_rancak->ol_akses($this->session->id_pegawai);*/
		$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
		$data['ambil_data_a_enabled'] = $this->m_ol_rancak->ambil_data_a_enabled();
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
				if(!empty($data['asesor'])){
			$data['level_name'] = $asesor["nama_komite"];
		}else{
			$data['level_name'] = $pegawai["nama_level"];			
  	}
		$data['photo'] = $pegawai["foto"];	
		$data['bcp_id_pegawai'] = $pegawai["id_pegawai"];
	$data['bln']   = $this->uri->segment(4, 0);
	$data['thn']   = $this->uri->segment(5, 0);
	if(empty($data['bln'])){
		$data['bln'] = date('m');
	}
	if(empty($data['thn'])){
		$data['thn'] = date('Y');
	}
	$data['array_month'] = $this->m_rancak->cmd_bulan();
	$data['array_page'] = array('lt'=>'Tahunan','lb'=>'Bulanan','lh'=>'Harian');
	$data['year_logbook']=$this->m_ol_rancak->cmd_tahun_logbook();
	$data['ambil_kol_golongan_pemeriksaan_graph'] = $this->m_member->ambil_kol_golongan_pemeriksaan_graph($data['page'],$data['bln'],$data['thn'],$data['bcp_id_pegawai']);
	$data['json'] = $this->m_member->lh($data['bln'],$data['thn'],$this->session->id_pegawai);
	if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$page = $this->input->post("page");
			$bln = $this->input->post("bln");
			$thn = $this->input->post("thn");
			redirect(base_url('member/'.$page.'/view/'.$bln.'/'.$thn));
		}
	}
  }
	function i_mutu($mode='view'){
		$data['page']="i_mutu"; 
		$data['header'] = "DATA ANALISIS INDIKATOR MUTU PERSONAL";
		$data['title'] = "DATA ANALISIS INDIKATOR MUTU PERSONAL";
		$this->m_auth->hak_member();
				$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
/*		$data['multi_level'] = $this->m_ol_rancak->ambil_data_link_pengurus($this->session->id_pegawai);
		$data['multi_struktur'] = $this->m_ol_rancak->ambil_data_link_struktur($this->session->id_pegawai);*/
		$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
		$data['ambil_data_a_enabled'] = $this->m_ol_rancak->ambil_data_a_enabled();
//		$data['ol_akses'] = $this->m_ol_rancak->ol_akses($this->session->id_pegawai);
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
		$data['photo'] = $pegawai["foto"];	
		//======================= IMPORTANT =========================================
		$data['id'] = $this->uri->segment(4, 0);
		$data['id2'] = $this->uri->segment(5, 0);
		$data['cmd_ya_tidak'] = $this->m_rancak->cmd_ya_tidak();
		if($mode=='view'){
			if(empty($data['id'])){
				if($this->session->has_userdata('id_i_mutu')){
					$data['id'] = $this->session->id_i_mutu;
				}else{
					$data['id'] = '01-'.date('m-Y');
				}
			}
			if(empty($data['id2'])){
				if($this->session->has_userdata('id2_i_mutu')){
					$data['id2'] = $this->session->id2_i_mutu;
				}else{
					$data['id2'] = date('d-m-Y');
				}
			}
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$first_date = $this->input->post("id");
				$last_date = $this->input->post("id2");
				$data_user_level = array(
					'id_i_mutu'     => $first_date,
					'id2_i_mutu'     => $last_date
				);
				$this->session->set_userdata($data_user_level);	
				redirect(base_url('member/i_mutu/view/'.$first_date.'/'.$last_date));
			}
		}
		else if($mode=='data'){
			echo json_encode($this->m_member->logbook_lhu_all($data['id'],$data['id2']));
		}
  else if($mode=='hapus'){
  		$kondisi=array('barcode_pegawai'=>$this->session->barcode_pegawai,'id_lhu'=>$data['id']);
  		$jml = $this->m_umum->jumlah_record_filter('ol_logbook_lhu',$kondisi);
  		if($jml == 0){
    			$this->session->set_flashdata('danger', 'Bukan Kepemilikan');
    			redirect(base_url('member/i_mutu'));
  		 }else{
  		  if($this->m_umum->hapus_data('ol_logbook_lhu_detil','id_lhu',$data['id'])){
  		  	$this->m_umum->hapus_data('ol_logbook_lhu','id_lhu',$data['id']);
    			$this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
    			redirect(base_url('member/i_mutu'));
  		  }else{
    			$this->session->set_flashdata('danger', 'Masalah Hapus Data');
    			redirect(base_url('member/i_mutu'));
  		  }
  		 }
  }
		else{
			if($mode=='tambah'){
			  $data['page'] =  $data['page']."_tambah";
    		$data['tgl_lhu']  = set_value('tgl_lhu',date('d-m-Y'));
    		$data['nama_lhu']  = set_value('nama_lhu',$this->input->post("nama_lhu"));    		   		
				$this->load->view("member/isi",$data);
			}
			if($mode=='simpan_tambah'){
				  if($this->m_member->simpan_indikator_mutu()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('member/i_mutu'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
						redirect(base_url('member/i_mutu'));
					}
			}
			if($mode=='edit'){
			  $data['page'] =  $data['page']."_edit";
				$keuangan = $this->m_umum->ambil_data('ol_logbook_lhu','id_lhu',$data['id']);		
				$data['tgl_lhu']  = set_value('tgl_lhu',date('d-m-Y', strtotime($keuangan["tgl_lhu"])));
				$data['id_lhu']  = set_value('id_lhu',$keuangan["id_lhu"]);
				$data['nama_lhu']  = set_value('nama_lhu',$keuangan["nama_lhu"]);
				$this->load->view("member/isi",$data);
			}
			if($mode=='simpan_edit'){
			  if($this->m_member->rubah_indikator_mutu()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('member/i_mutu'));
				}else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
					redirect(base_url('member/i_mutu'));
				}
			}
			if($mode=='copy_qc2'){
				$owner = $this->m_umum->ambil_data('ol_logbook_lhu','id_lhu',$data['id']);
				if($owner['barcode_pegawai'] == $this->session->barcode_pegawai){
					$Q = $this->m_member->clone_indikator_mutu($owner['id_lhu'],$owner['tgl_lhu'],$owner['nama_lhu'],$owner['share_lhu']);
						$this->m_member->clone_indikator_mutu_detil($data['id'],$Q);
						$this->session->set_flashdata('sukses', 'Data Berhasil Di CLonning');
						redirect(base_url('member/i_mutu'));
				}elseif($owner['share_lhu'] == 1){
					$Q = $this->m_member->clone_indikator_mutu($owner['id_lhu'],$owner['tgl_lhu'],$owner['nama_lhu'],$owner['share_lhu']);
						$this->m_member->clone_indikator_mutu_detil($data['id'],$Q);
						$this->session->set_flashdata('sukses', 'Data Berhasil Di CLonning');
						redirect(base_url('member/i_mutu'));
				}else{
					$this->session->set_flashdata('danger', 'Tidak diijinkan Clone Data');
					redirect(base_url('member/i_mutu'));			
				}
			}
      if($mode=='copy_qc'){
        $data['page'] =  $data['page']."_copy_qc";
        $owner = $this->m_umum->ambil_data('ol_logbook_lhu','id_lhu',$data['id']);
        $kondisi = array('id_lhu'=>$data['id']);
  $data['ambil_lhu_detil']  = $this->m_member->ambil_lhu_detil($data['id']);
    		$data['id_lhu']  = set_value('id_lhu',$owner['id_lhu']);
    		$data['tgl_lhu']  = set_value('tgl_lhu',date('d-m-Y',strtotime($owner['tgl_lhu'])));
    		$data['nama_lhu']  = set_value('nama_lhu',$owner['nama_lhu']);
    		$data['barcode_pegawai']  = set_value('barcode_pegawai',$owner['barcode_pegawai']);
    		$data['share_lhu']  = set_value('share_lhu',$owner['share_lhu']);
    		$this->form_validation->set_rules('id_lhu','id_lhu','required');
        if ($this->form_validation->run() === FALSE){
			       $this->tampil($data);
        }else{
        		$barcode_pegawai = $this->input->post('barcode_pegawai');
        		$share_lhu = $this->input->post('share_lhu');
        		$id_lhu = $this->input->post('id_lhu');
        		$nama_lhu = $this->input->post('nama_lhu');
						$tgl_lhu = $this->input->post('tgl_lhu');
						$tgl_lhu = date('Y-m-d', strtotime($tgl_lhu));
						if($barcode_pegawai == $this->session->barcode_pegawai){
							$Q = $this->m_member->clone_indikator_mutu($id_lhu,$tgl_lhu,$nama_lhu,$share_lhu);
								$this->m_member->clone_indikator_mutu_detil_each($Q);
								$this->session->set_flashdata('sukses', 'Data Berhasil Di CLonning');
								redirect(base_url('member/i_mutu'));
						}elseif($share_lhu == 1){
							$Q = $this->m_member->clone_indikator_mutu($id_lhu,$tgl_lhu,$nama_lhu,$share_lhu);
								$this->m_member->clone_indikator_mutu_detil_each($Q);
								$this->session->set_flashdata('sukses', 'Data Berhasil Di CLonning');
								redirect(base_url('member/i_mutu'));
						}else{
							$this->session->set_flashdata('danger', 'Tidak diijinkan Clone Data');
							redirect(base_url('member/i_mutu'));			
						}
		    }	
	    }
      if($mode=='seting_share_lhu'){
        $data['page'] =  $data['page']."_seting_share_lhu";
			  $kondisi_cek = array('id_lhu'=>$data['id'],'barcode_pegawai'=>$this->session->barcode_pegawai);
				$data['cek'] = $this->m_umum->jumlah_record_filter('ol_logbook_lhu',$kondisi_cek);	
			  $lp = $this->m_umum->ambil_data('ol_logbook_lhu','id_lhu',$data['id']);
			  $data['id_lhu']  = set_value('id_lhu',$lp["id_lhu"]);
			  $data['share_lhu']  = set_value('share_lhu',$lp["share_lhu"]);
				$this->load->view("member/isi",$data);
      }
      if($mode=='simpan_seting_share_lhu'){
					if($this->m_member->seting_share_lhu()){
					  $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
						redirect(base_url('member/i_mutu'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
						redirect(base_url('member/i_mutu'));
					}
      }
      if($mode=='share_unit'){
        $data['page'] =  $data['page']."_share_unit";
			  $kondisi_cek = array('id_lhu'=>$data['id'],'barcode_pegawai'=>$this->session->barcode_pegawai);
				$data['cek'] = $this->m_umum->jumlah_record_filter('ol_logbook_lhu',$kondisi_cek);				
				$keuangan = $this->m_umum->ambil_data('ol_logbook_lhu','id_lhu',$data['id']);		
				$data['barcode_pegawai']  = set_value('barcode_pegawai',$keuangan["barcode_pegawai"]);
				$data['id_lhu']  = set_value('id_lhu',$keuangan["id_lhu"]);
				$data['share_lhu']  = set_value('share_lhu',$keuangan["share_lhu"]);
				$data['share_ins_lhu']  = set_value('share_ins_lhu',$keuangan["share_ins_lhu"]);
				$data['share_peg_lhu']  = set_value('share_peg_lhu',$keuangan["share_peg_lhu"]);
    		$data['ambil_unit_instansi'] = $this->m_rancak->ambil_unit_instansi();
				$this->load->view("member/isi",$data);
      }
      if($mode=='simpan_share_unit'){
				$id_lhu = $this->input->post("id_lhu");
				$barcode_pegawai = $this->input->post("barcode_pegawai");
				if($barcode_pegawai == $this->session->barcode_pegawai){
					if($this->m_umum->edit_check('ol_logbook_lhu','share_lhu','id_lhu',$id_lhu)){
					  $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
						redirect(base_url('member/i_mutu'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
							redirect(base_url('member/i_mutu'));
					}
				}else{
						$this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
						redirect(base_url('member/i_mutu'));					
				}
      }
      if($mode=='share_user'){
        $data['page'] =  $data['page']."_share_user";
			  $kondisi_cek = array('id_lhu'=>$data['id'],'barcode_pegawai'=>$this->session->barcode_pegawai);
				$data['cek'] = $this->m_umum->jumlah_record_filter('ol_logbook_lhu',$kondisi_cek);				
				$keuangan = $this->m_umum->ambil_data('ol_logbook_lhu','id_lhu',$data['id']);		
				$data['barcode_pegawai']  = set_value('barcode_pegawai',$keuangan["barcode_pegawai"]);
				$data['id_lhu']  = set_value('id_lhu',$keuangan["id_lhu"]);
				$data['share_lhu']  = set_value('share_lhu',$keuangan["share_lhu"]);
				$data['share_ins_lhu']  = set_value('share_ins_lhu',$keuangan["share_ins_lhu"]);
				$data['share_peg_lhu']  = set_value('share_peg_lhu',$keuangan["share_peg_lhu"]);
    		$data['ambil_unit_instansi'] = $this->m_rancak->ambil_pegawai_unit_instansi();
				$this->load->view("member/isi",$data);
      }
      if($mode=='simpan_share_user'){
				$id_lhu = $this->input->post("id_lhu");
				$barcode_pegawai = $this->input->post("barcode_pegawai");
				if($barcode_pegawai == $this->session->barcode_pegawai){
					if($this->m_umum->edit_check('ol_logbook_lhu','share_peg_lhu','id_lhu',$id_lhu)){
					  $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
						redirect(base_url('member/i_mutu'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
							redirect(base_url('member/i_mutu'));
					}
				}else{
						$this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
						redirect(base_url('member/i_mutu'));					
				}
      }
      if($mode=='share_instansi'){
        $data['page'] =  $data['page']."_share_instansi";
			  $kondisi_cek = array('id_lhu'=>$data['id'],'barcode_pegawai'=>$this->session->barcode_pegawai);
				$data['cek'] = $this->m_umum->jumlah_record_filter('ol_logbook_lhu',$kondisi_cek);				
				$keuangan = $this->m_umum->ambil_data('ol_logbook_lhu','id_lhu',$data['id']);		
				$data['barcode_pegawai']  = set_value('barcode_pegawai',$keuangan["barcode_pegawai"]);
				$data['id_lhu']  = set_value('id_lhu',$keuangan["id_lhu"]);
				$data['share_lhu']  = set_value('share_lhu',$keuangan["share_lhu"]);
				$data['share_ins_lhu']  = set_value('share_ins_lhu',$keuangan["share_ins_lhu"]);
				$data['share_peg_lhu']  = set_value('share_peg_lhu',$keuangan["share_peg_lhu"]);
    		$data['ambil_unit_instansi'] = $this->m_umum->ambil_data('kol_working');
				$this->load->view("member/isi",$data);
      }
      if($mode=='simpan_share_instansi'){
				$id_lhu = $this->input->post("id_lhu");
				$barcode_pegawai = $this->input->post("barcode_pegawai");
				if($barcode_pegawai == $this->session->barcode_pegawai){
					if($this->m_umum->edit_check('ol_logbook_lhu','share_ins_lhu','id_lhu',$id_lhu)){
					  $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
						redirect(base_url('member/i_mutu'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
							redirect(base_url('member/i_mutu'));
					}
				}else{
						$this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
						redirect(base_url('member/i_mutu'));					
				}
      }
		}
	}
	function clone_i_mutu($mode='view'){
		$data['page']="clone_i_mutu"; 
		$data['header'] = "CLONNING DATA ANALISIS INDIKATOR MUTU PERSONAL";
		$data['title'] = "CLONNING DATA ANALISIS INDIKATOR MUTU PERSONAL";
		$this->m_auth->hak_member();
				$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
/*		$data['multi_level'] = $this->m_ol_rancak->ambil_data_link_pengurus($this->session->id_pegawai);
		$data['multi_struktur'] = $this->m_ol_rancak->ambil_data_link_struktur($this->session->id_pegawai);*/
		$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
		$data['ambil_data_a_enabled'] = $this->m_ol_rancak->ambil_data_a_enabled();
//		$data['ol_akses'] = $this->m_ol_rancak->ol_akses($this->session->id_pegawai);
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
		$data['photo'] = $pegawai["foto"];	
		//======================= IMPORTANT =========================================
		$data['id'] = $this->uri->segment(4, 0);
		$data['id2'] = $this->uri->segment(5, 0);
		$data['cmd_ya_tidak'] = $this->m_rancak->cmd_ya_tidak();
		if($mode=='view'){
			if(empty($data['id'])){
				if($this->session->has_userdata('id_i_mutu')){
					$data['id'] = $this->session->id_i_mutu;
				}else{
					$data['id'] = '01-'.date('m-Y');
				}
			}
			if(empty($data['id2'])){
				if($this->session->has_userdata('id2_i_mutu')){
					$data['id2'] = $this->session->id2_i_mutu;
				}else{
					$data['id2'] = date('d-m-Y');
				}
			}
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$first_date = $this->input->post("id");
				$last_date = $this->input->post("id2");
				$data_user_level = array(
					'id_i_mutu'     => $first_date,
					'id2_i_mutu'     => $last_date
				);
				$this->session->set_userdata($data_user_level);	
				redirect(base_url('member/clone_i_mutu/view/'.$first_date.'/'.$last_date));
			}
		}
		else if($mode=='data'){
			echo json_encode($this->m_member->logbook_lhu_user_lain($data['id'],$data['id2']));
		}
		else{
			if($mode=='lihat'){
			  $data['page'] =  $data['page']."_lihat";
        $owner = $this->m_umum->ambil_data('ol_logbook_lhu','id_lhu',$data['id']);
        $kondisi = array('id_lhu'=>$data['id']);
  			$data['ambil_lhu_detil']  = $this->m_member->ambil_lhu_detil($data['id']);
    		$data['id_lhu']  = set_value('id_lhu',$owner['id_lhu']);
    		$data['tgl_lhu']  = set_value('tgl_lhu',date('d-m-Y',strtotime($owner['tgl_lhu'])));
    		$data['nama_lhu']  = set_value('nama_lhu',$owner['nama_lhu']);
    		$data['barcode_pegawai']  = set_value('barcode_pegawai',$owner['barcode_pegawai']);
    		$data['share_lhu']  = set_value('share_lhu',$owner['share_lhu']); 		   		
				$this->load->view("member/isi",$data);
			}
      if($mode=='copy_user'){
        $data['page'] =  $data['page']."_copy_user";
        $owner = $this->m_umum->ambil_data('ol_logbook_lhu','id_lhu',$data['id']);
        $kondisi = array('id_lhu'=>$data['id']);
  			$data['ambil_lhu_detil']  = $this->m_member->ambil_lhu_detil($data['id']);
    		$data['id_lhu']  = set_value('id_lhu',$owner['id_lhu']);
    		$data['tgl_lhu']  = set_value('tgl_lhu',date('d-m-Y',strtotime($owner['tgl_lhu'])));
    		$data['nama_lhu']  = set_value('nama_lhu',$owner['nama_lhu']);
    		$data['barcode_pegawai']  = set_value('barcode_pegawai',$owner['barcode_pegawai']);
    		$data['share_lhu']  = set_value('share_lhu',$owner['share_lhu']);
    		$this->form_validation->set_rules('id_lhu','id_lhu','required');
        if ($this->form_validation->run() === FALSE){
			       $this->tampil($data);
        }else{
        		$barcode_pegawai = $this->input->post('barcode_pegawai');
        		$share_lhu = $this->input->post('share_lhu');
        		$id_lhu = $this->input->post('id_lhu');
        		$nama_lhu = $this->input->post('nama_lhu');
						$tgl_lhu = $this->input->post('tgl_lhu');
						$tgl_lhu = date('Y-m-d', strtotime($tgl_lhu));
						$Q = $this->m_member->clone_indikator_mutu($id_lhu,$tgl_lhu,$nama_lhu,$share_lhu);
							$this->m_member->clone_indikator_mutu_detil_each($Q);
							$this->session->set_flashdata('sukses', 'Data Berhasil Di CLonning');
							redirect(base_url('member/i_mutu'));
		    }	
	    }
		}
	}
	function mutu_detil($mode='view'){
		$data['page']="mutu_detil"; 
		$data['header'] = "DATA INDIKATOR MUTU DETIL";
		$data['title'] = "DATA INDIKATOR MUTU DETIL";
				$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
				$this->m_auth->hak_member();
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
/*		$data['multi_level'] = $this->m_ol_rancak->ambil_data_link_pengurus($this->session->id_pegawai);
		$data['multi_struktur'] = $this->m_ol_rancak->ambil_data_link_struktur($this->session->id_pegawai);*/
		$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
		$data['ambil_data_a_enabled'] = $this->m_ol_rancak->ambil_data_a_enabled();
//		$data['ol_akses'] = $this->m_ol_rancak->ol_akses($this->session->id_pegawai);
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
		$data['photo'] = $pegawai["foto"];	
		//======================= IMPORTANT =========================================
		$data['id'] = $this->uri->segment(4, 0);
		if($mode=='view'){
			$this->tampil($data);
		}
		else if($mode=='data'){
			echo json_encode($this->m_member->logbook_lhu_detil_all($data['id']));
		}
  else if($mode=='hapus'){
  	$ambil_id = $this->m_umum->ambil_data('ol_logbook_lhu_detil','id_lhu_detil',$data['id']);
  		  if($this->m_umum->hapus_data('ol_logbook_lhu_detil','id_lhu_detil',$data['id'])){
    			$this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
    			redirect(base_url('member/mutu_detil/view/'.$ambil_id['id_lhu']));
  		  }else{
    			$this->session->set_flashdata('danger', 'Masalah Hapus Data');
    			redirect(base_url('member/mutu_detil/view/'.$ambil_id['id_lhu']));
  		  }
  }
		else{
			$data['cmd_item_lhu'] = $this->m_ol_rancak->cmd_item_lhu();
			if($mode=='tambah'){
			  $data['page'] =  $data['page']."_tambah";
    		$data['id_item_lhu']  = set_value('id_item_lhu',$this->input->post("id_item_lhu"));    		   		
    		$data['hasil_lhu_detil']  = set_value('hasil_lhu_detil',$this->input->post("hasil_lhu_detil"));    		   		
    		$data['ket_lhu_detil']  = set_value('ket_lhu_detil',$this->input->post("ket_lhu_detil"));    		   		
				$this->load->view("member/isi",$data);
			}
			if($mode=='simpan_tambah'){
				$id_lhu = $this->input->post('id_lhu');
				$id_item_lhu = $this->input->post('id_item_lhu');
				if($id_item_lhu){
					  if($this->m_member->simpan_indikator_mutu_detil()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
							redirect(base_url('member/mutu_detil/view/'.$id_lhu));
						}else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
							redirect(base_url('member/mutu_detil/view/'.$id_lhu));
						}
					}
			}
			if($mode=='edit'){
			  $data['page'] =  $data['page']."_edit";
				$keuangan = $this->m_umum->ambil_data('ol_logbook_lhu_detil','id_lhu_detil',$data['id']);		
				$data['id_lhu_detil']  = set_value('id_lhu_detil',$keuangan["id_lhu_detil"]);
				$data['id_lhu']  = set_value('id_lhu',$keuangan["id_lhu"]);
				$data['id_item_lhu']  = set_value('id_item_lhu',$keuangan["id_item_lhu"]);
				$data['hasil_lhu_detil']  = set_value('hasil_lhu_detil',$keuangan["hasil_lhu_detil"]);
				$data['ket_lhu_detil']  = set_value('ket_lhu_detil',$keuangan["ket_lhu_detil"]);
				$this->load->view("member/isi",$data);
			}
			if($mode=='simpan_edit'){
				$id_lhu = $this->input->post('id_lhu');
			  if($this->m_member->rubah_indikator_mutu_detil()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('member/mutu_detil/view/'.$id_lhu));
				}else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
					redirect(base_url('member/mutu_detil/view/'.$id_lhu));
				}
			}
		}
	}
	function time_respon($mode='view'){
		$data['page']="time_respon"; 
		$data['header'] = "DATA TIME RESPON";
		$data['title'] = "DATA TIME RESPON";
		$this->m_auth->hak_member();
				$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
/*		$data['multi_level'] = $this->m_ol_rancak->ambil_data_link_pengurus($this->session->id_pegawai);
		$data['multi_struktur'] = $this->m_ol_rancak->ambil_data_link_struktur($this->session->id_pegawai);*/
		$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
		$data['ambil_data_a_enabled'] = $this->m_ol_rancak->ambil_data_a_enabled();
//		$data['ol_akses'] = $this->m_ol_rancak->ol_akses($this->session->id_pegawai);
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
		$data['photo'] = $pegawai["foto"];	
		//======================= IMPORTANT =========================================
		$data['id'] = $this->uri->segment(4, 0);
		$data['id2'] = $this->uri->segment(5, 0);
		$data['cmd_ya_tidak'] = $this->m_rancak->cmd_ya_tidak();
		if($mode=='view'){
			if(empty($data['id'])){
				if($this->session->has_userdata('id_tr')){
					$data['id'] = $this->session->id_tr;
				}else{
					$data['id'] = '01-'.date('m-Y');
				}
			}
			if(empty($data['id2'])){
				if($this->session->has_userdata('id2_tr')){
					$data['id2'] = $this->session->id2_tr;
				}else{
					$data['id2'] = date('d-m-Y');
				}
			}
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$first_date = $this->input->post("id");
				$last_date = $this->input->post("id2");
				$data_user_level = array(
					'id_tr'     => $first_date,
					'id2_tr'     => $last_date
				);
				$this->session->set_userdata($data_user_level);	
				redirect(base_url('member/time_respon/view/'.$first_date.'/'.$last_date));
			}
		}
		else if($mode=='data'){
			echo json_encode($this->m_member->logbook_time_respon_all($data['id'],$data['id2']));
		}
  else if($mode=='hapus'){
  		$kondisi=array('barcode_pegawai'=>$this->session->barcode_pegawai,'id_tr'=>$data['id']);
  		$jml = $this->m_umum->jumlah_record_filter('time_respon',$kondisi);
  		if($jml == 0){
    			$this->session->set_flashdata('danger', 'Bukan Kepemilikan');
    			redirect(base_url('member/time_respon'));
  		 }else{
  		  if($this->m_umum->hapus_data('time_respon','id_tr',$data['id'])){
    			$this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
    			redirect(base_url('member/time_respon'));
  		  }else{
    			$this->session->set_flashdata('danger', 'Masalah Hapus Data');
    			redirect(base_url('member/time_respon'));
  		  }
  		 }
  }
		else{
			$data['cmd_kewenangan']=$this->m_ol_rancak->kewenangan_all_no_null();
			if($mode=='tambah'){
			  $data['page'] =  $data['page']."_tambah";
    		$data['tgl_tr']  = set_value('tgl_tr',date('d-m-Y'));
    		$data['waktu_tunggu']  = set_value('waktu_tunggu',date('H:i:s'));
    		$data['id_kewenangan']  = set_value('id_kewenangan',$this->input->post("id_kewenangan"));    		   		
    		$data['nama_time_respon']  = set_value('nama_time_respon',$this->input->post("nama_time_respon"));    		   		
				$this->load->view("member/isi",$data);
			}
			if($mode=='simpan_tambah'){
				  if($this->m_member->simpan_time_respon()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('member/time_respon'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
						redirect(base_url('member/time_respon'));
					}
			}
			if($mode=='edit'){
			  $data['page'] =  $data['page']."_edit";
				$keuangan = $this->m_umum->ambil_data('time_respon','id_tr',$data['id']);		
				$data['tgl_tr']  = set_value('tgl_tr',date('d-m-Y', strtotime($keuangan["tgl_tr"])));
				$data['waktu_tunggu']  = set_value('waktu_tunggu',date('H:i:s', strtotime($keuangan["waktu_tunggu"])));
				$data['id_tr']  = set_value('id_tr',$keuangan["id_tr"]);
				$data['id_kewenangan']  = set_value('id_kewenangan',$keuangan["id_kewenangan"]);
				$data['nama_time_respon']  = set_value('nama_time_respon',$keuangan["nama_time_respon"]);
				$this->load->view("member/isi",$data);
			}
			if($mode=='simpan_edit'){
			  if($this->m_member->rubah_time_respon()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('member/time_respon'));
				}else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
					redirect(base_url('member/time_respon'));
				}
			}
			if($mode=='copy_qc'){
			  $data['page'] =  $data['page']."_copy_qc";
				$keuangan = $this->m_umum->ambil_data('time_respon','id_tr',$data['id']);		
				$data['tgl_tr']  = set_value('tgl_tr',date('d-m-Y', strtotime($keuangan["tgl_tr"])));
				$data['waktu_tunggu']  = set_value('waktu_tunggu',date('H:i:s', strtotime($keuangan["waktu_tunggu"])));
				$data['id_tr']  = set_value('id_tr',$keuangan["id_tr"]);
				$data['id_kewenangan']  = set_value('id_kewenangan',$keuangan["id_kewenangan"]);
				$data['nama_time_respon']  = set_value('nama_time_respon',$keuangan["nama_time_respon"]);
				$this->load->view("member/isi",$data);
			}
			if($mode=='simpan_copy_qc'){
			  if($this->m_member->simpan_time_respon()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('member/time_respon'));
				}else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
					redirect(base_url('member/time_respon'));
				}
			}
      if($mode=='seting_share_lhu'){
        $data['page'] =  $data['page']."_seting_share_lhu";
			  $kondisi_cek = array('id_lhu'=>$data['id'],'barcode_pegawai'=>$this->session->barcode_pegawai);
				$data['cek'] = $this->m_umum->jumlah_record_filter('ol_logbook_lhu',$kondisi_cek);	
			  $lp = $this->m_umum->ambil_data('ol_logbook_lhu','id_lhu',$data['id']);
			  $data['id_lhu']  = set_value('id_lhu',$lp["id_lhu"]);
			  $data['share_lhu']  = set_value('share_lhu',$lp["share_lhu"]);
				$this->load->view("member/isi",$data);
      }
      if($mode=='simpan_seting_share_lhu'){
					if($this->m_member->seting_share_lhu()){
					  $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
						redirect(base_url('member/i_mutu'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
						redirect(base_url('member/i_mutu'));
					}
      }
      if($mode=='share_unit'){
        $data['page'] =  $data['page']."_share_unit";
			  $kondisi_cek = array('id_lhu'=>$data['id'],'barcode_pegawai'=>$this->session->barcode_pegawai);
				$data['cek'] = $this->m_umum->jumlah_record_filter('ol_logbook_lhu',$kondisi_cek);				
				$keuangan = $this->m_umum->ambil_data('ol_logbook_lhu','id_lhu',$data['id']);		
				$data['barcode_pegawai']  = set_value('barcode_pegawai',$keuangan["barcode_pegawai"]);
				$data['id_lhu']  = set_value('id_lhu',$keuangan["id_lhu"]);
				$data['share_lhu']  = set_value('share_lhu',$keuangan["share_lhu"]);
				$data['share_ins_lhu']  = set_value('share_ins_lhu',$keuangan["share_ins_lhu"]);
				$data['share_peg_lhu']  = set_value('share_peg_lhu',$keuangan["share_peg_lhu"]);
    		$data['ambil_unit_instansi'] = $this->m_rancak->ambil_unit_instansi();
				$this->load->view("member/isi",$data);
      }
      if($mode=='simpan_share_unit'){
				$id_lhu = $this->input->post("id_lhu");
				$barcode_pegawai = $this->input->post("barcode_pegawai");
				if($barcode_pegawai == $this->session->barcode_pegawai){
					if($this->m_umum->edit_check('ol_logbook_lhu','share_lhu','id_lhu',$id_lhu)){
					  $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
						redirect(base_url('member/i_mutu'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
							redirect(base_url('member/i_mutu'));
					}
				}else{
						$this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
						redirect(base_url('member/i_mutu'));					
				}
      }
      if($mode=='share_user'){
        $data['page'] =  $data['page']."_share_user";
			  $kondisi_cek = array('id_lhu'=>$data['id'],'barcode_pegawai'=>$this->session->barcode_pegawai);
				$data['cek'] = $this->m_umum->jumlah_record_filter('ol_logbook_lhu',$kondisi_cek);				
				$keuangan = $this->m_umum->ambil_data('ol_logbook_lhu','id_lhu',$data['id']);		
				$data['barcode_pegawai']  = set_value('barcode_pegawai',$keuangan["barcode_pegawai"]);
				$data['id_lhu']  = set_value('id_lhu',$keuangan["id_lhu"]);
				$data['share_lhu']  = set_value('share_lhu',$keuangan["share_lhu"]);
				$data['share_ins_lhu']  = set_value('share_ins_lhu',$keuangan["share_ins_lhu"]);
				$data['share_peg_lhu']  = set_value('share_peg_lhu',$keuangan["share_peg_lhu"]);
    		$data['ambil_unit_instansi'] = $this->m_rancak->ambil_pegawai_unit_instansi();
				$this->load->view("member/isi",$data);
      }
      if($mode=='simpan_share_user'){
				$id_lhu = $this->input->post("id_lhu");
				$barcode_pegawai = $this->input->post("barcode_pegawai");
				if($barcode_pegawai == $this->session->barcode_pegawai){
					if($this->m_umum->edit_check('ol_logbook_lhu','share_peg_lhu','id_lhu',$id_lhu)){
					  $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
						redirect(base_url('member/i_mutu'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
							redirect(base_url('member/i_mutu'));
					}
				}else{
						$this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
						redirect(base_url('member/i_mutu'));					
				}
      }
      if($mode=='share_instansi'){
        $data['page'] =  $data['page']."_share_instansi";
			  $kondisi_cek = array('id_lhu'=>$data['id'],'barcode_pegawai'=>$this->session->barcode_pegawai);
				$data['cek'] = $this->m_umum->jumlah_record_filter('ol_logbook_lhu',$kondisi_cek);				
				$keuangan = $this->m_umum->ambil_data('ol_logbook_lhu','id_lhu',$data['id']);		
				$data['barcode_pegawai']  = set_value('barcode_pegawai',$keuangan["barcode_pegawai"]);
				$data['id_lhu']  = set_value('id_lhu',$keuangan["id_lhu"]);
				$data['share_lhu']  = set_value('share_lhu',$keuangan["share_lhu"]);
				$data['share_ins_lhu']  = set_value('share_ins_lhu',$keuangan["share_ins_lhu"]);
				$data['share_peg_lhu']  = set_value('share_peg_lhu',$keuangan["share_peg_lhu"]);
    		$data['ambil_unit_instansi'] = $this->m_umum->ambil_data('kol_working');
				$this->load->view("member/isi",$data);
      }
      if($mode=='simpan_share_instansi'){
				$id_lhu = $this->input->post("id_lhu");
				$barcode_pegawai = $this->input->post("barcode_pegawai");
				if($barcode_pegawai == $this->session->barcode_pegawai){
					if($this->m_umum->edit_check('ol_logbook_lhu','share_ins_lhu','id_lhu',$id_lhu)){
					  $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
						redirect(base_url('member/i_mutu'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
							redirect(base_url('member/i_mutu'));
					}
				}else{
						$this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
						redirect(base_url('member/i_mutu'));					
				}
      }
		}
	}
/*	function item_mutu($mode='view'){
		$data['page']="item_mutu"; 
		$data['header'] = "DATA ITEM INDIKATOR MUTU DETIL";
		$data['title'] = "DATA ITEM INDIKATOR MUTU DETIL";
		$this->m_auth->hak_member();
				$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
		$data['ambil_data_a_enabled'] = $this->m_ol_rancak->ambil_data_a_enabled();
//		$data['ol_akses'] = $this->m_ol_rancak->ol_akses($this->session->id_pegawai);
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
		$data['photo'] = $pegawai["foto"];	
		//======================= IMPORTANT =========================================
		$data['id'] = $this->uri->segment(4, 0);
		if($mode=='view'){
			$this->tampil($data);
		}
		else if($mode=='data'){
			echo json_encode($this->m_member->logbook_lhu_item_lhu_all());
		}
  else if($mode=='hapus'){
  		$kondisi_detil=array('id_item_lhu'=>$data['id']);
  		$kondisi=array('pembuat_item_lhu'=>$this->session->barcode_pegawai,'id_item_lhu'=>$data['id']);
  		$jml_detil = $this->m_umum->jumlah_record_filter('ol_logbook_lhu_detil',$kondisi_detil);
  		$jml = $this->m_umum->jumlah_record_filter('ol_logbook_item_lhu',$kondisi);
  		if($jml_detil == 0){
	  		if($jml == 0){
	    			$this->session->set_flashdata('danger', 'Bukan Kepemilikan');
	    			redirect(base_url('member/item_mutu'));
	  		 }else{
	  		  if($this->m_umum->hapus_data('ol_logbook_item_lhu','id_item_lhu',$data['id'])){
	    			$this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
	    			redirect(base_url('member/item_mutu'));
	  		  }else{
	    			$this->session->set_flashdata('danger', 'Masalah Hapus Data');
	    			redirect(base_url('member/item_mutu'));
	  		  }
	  		 }
  		 }else{
    			$this->session->set_flashdata('danger', 'Masih Ada Hasil, Hapus Hasil Dahulu');
    			redirect(base_url('member/item_mutu'));
  		 }
  }
		else{
			$data['cmd_status'] = $this->m_rancak->cmd_status();
			$data['cmd_equipment'] = $this->m_ol_rancak->ambil_equipment();
			if($mode=='tambah'){
			  $data['page'] =  $data['page']."_tambah";
    		$data['nama_item_lhu']  = set_value('nama_item_lhu',$this->input->post("nama_item_lhu"));    		   		
    		$data['id_equipment']  = set_value('id_equipment',$this->input->post("id_equipment"));    		   		    		   		
    		$data['status_item_lhu']  = set_value('status_item_lhu',$this->input->post("status_item_lhu"));    		   		    		   		
				$this->load->view("member/isi",$data);
			}
			if($mode=='simpan_tambah'){
				$id_lhu = $this->input->post('id_lhu');
				  if($this->m_member->simpan_indikator_item_mutu()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('member/item_mutu'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
						redirect(base_url('member/item_mutu'));
					}
			}
			if($mode=='edit'){
			  $data['page'] =  $data['page']."_edit";
				$keuangan = $this->m_umum->ambil_data('ol_logbook_item_lhu','id_item_lhu',$data['id']);		
				$data['id_item_lhu']  = set_value('id_item_lhu',$keuangan["id_item_lhu"]);
				$data['nama_item_lhu']  = set_value('nama_item_lhu',$keuangan["nama_item_lhu"]);
				$data['id_equipment']  = set_value('id_equipment',$keuangan["id_equipment"]);
				$data['status_item_lhu']  = set_value('status_item_lhu',$keuangan["status_item_lhu"]);
				$this->load->view("member/isi",$data);
			}
			if($mode=='simpan_edit'){
				$id_lhu = $this->input->post('id_lhu');
			  if($this->m_member->rubah_indikator_item_mutu()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('member/item_mutu'));
				}else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
					redirect(base_url('member/item_mutu'));
				}
			}
		}
	}*/
//===================================================== IM
  function indikator($mode='view'){
    $data['page']="indikator";
    $data['title'] = "INDIKATOR MUTU";
    $data['header'] = "INDIKATOR MUTU";
		$this->m_auth->hak_member();
				$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
		$data['ambil_data_a_enabled'] = $this->m_ol_rancak->ambil_data_a_enabled();
//		$data['ol_akses'] = $this->m_ol_rancak->ol_akses($this->session->id_pegawai);
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
		$data['photo'] = $pegawai["foto"];	
    //======================= IMPORTANT =========================================
    $data['id'] = $this->uri->segment(4, 0);
    if($mode=='view'){
      $this->tampil($data);
    }
    else if($mode=='data'){
      echo json_encode($this->m_member->ol_per_imqc_all(1));
    }
    else{
      $data['cmd_status'] = $this->m_rancak->cmd_status();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
        $data['nama_per_imqc']  = set_value('nama_per_imqc',$this->input->post('nama_per_imqc'));
        $data['status_per_imqc']  = set_value('status_per_imqc',$this->input->post('status_per_imqc'));
        $this->load->view("member/isi",$data);
      }
      if($mode=='simpan_tambah'){
        if($this->m_member->simpan_per_imqc(1)){
          $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
          redirect(base_url('member/indikator'));
        }else{
          $this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
          redirect(base_url('member/indikator'));
        }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
        $keuangan    = $this->m_umum->ambil_data('ol_per_imqc','id_per_imqc',$data['id']);
        $data['id_per_imqc']  = set_value('id_per_imqc',$keuangan["id_per_imqc"]);
        $data['nama_per_imqc']  = set_value('nama_per_imqc',$keuangan["nama_per_imqc"]);
        $data['status_per_imqc']  = set_value('status_per_imqc',$keuangan["status_per_imqc"]);
        $data['pembuat_per_imqc']  = set_value('pembuat_per_imqc',$keuangan["pembuat_per_imqc"]);
        $this->load->view("member/isi",$data);
      }
      if($mode=='simpan_edit'){
      $id_per_imqc = $this->input->post('id_per_imqc');
      $kondisi=array('pembuat_per_imqc'=>$this->session->barcode_pegawai,'id_per_imqc'=>$id_per_imqc);
      $jml = $this->m_umum->jumlah_record_filter('ol_per_imqc',$kondisi);
      if($jml == 0){
          $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
          redirect(base_url('member/indikator'));
      }else{
          if($this->m_member->edit_per_imqc()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
            redirect(base_url('member/indikator'));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
            redirect(base_url('member/indikator'));
          }
        }

      }
    }
  }
  function mutu($mode='view'){
    $data['page']="mutu";
    $data['title'] = "INPUT MUTU";
    $data['header'] = "INDIKATOR MUTU";
		$this->m_auth->hak_member();
				$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
		$data['ambil_data_a_enabled'] = $this->m_ol_rancak->ambil_data_a_enabled();
//		$data['ol_akses'] = $this->m_ol_rancak->ol_akses($this->session->id_pegawai);
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
		$data['photo'] = $pegawai["foto"];	  
    //======================= IMPORTANT =========================================
    $data['id'] = $this->uri->segment(4, 0);
    if($mode=='view'){
      $this->tampil($data);
    }
    else if($mode=='data'){
      echo json_encode($this->m_member->ol_per_imqc_detil_all(1));
    }
    else{
        $data['cmd_status'] = $this->m_rancak->cmd_status();
        $kon = array('status_per_imqc'=>1,'id_unit'=>$this->session->unit,'pembuat_per_imqc'=>$this->session->barcode_pegawai,'jenis_per_imqc'=>1);
        $data['ambil_per_imqc'] = $this->m_ol_rancak->ambil_per_imqc($kon);
        if($mode=='tambah'){
          $data['page'] =  $data['page']."_tambah";
          $data['id_per_imqc']  = set_value('id_per_imqc',$this->input->post('id_per_imqc'));
          $data['nama_per_imqc_detil']  = set_value('nama_per_imqc_detil',$this->input->post('nama_per_imqc_detil'));
          $data['status_per_imqc_detil']  = set_value('status_per_imqc_detil',$this->input->post('status_per_imqc_detil'));
          $this->load->view("member/isi",$data);
        }
        if($mode=='simpan_tambah'){
        $id_per_imqc = $this->input->post('id_per_imqc');
        if($id_per_imqc){
            if($this->m_member->simpan_per_imqc_detil()){
              $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
              redirect(base_url('member/mutu'));
            }else{
              $this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
              redirect(base_url('member/mutu'));
            }
          }else{
               $this->session->set_flashdata('danger', 'Belum Ada Data');
              redirect(base_url('member/mutu'));           
          }
        }
        if($mode=='edit'){
          $data['page'] =  $data['page']."_edit";
          $keuangan    = $this->m_umum->ambil_data('ol_per_imqc_detil','id_per_imqc_detil',$data['id']);
          $data['id_per_imqc_detil']  = set_value('id_per_imqc_detil',$keuangan["id_per_imqc_detil"]);
          $data['id_per_imqc']  = set_value('id_per_imqc',$keuangan["id_per_imqc"]);
          $data['nama_per_imqc_detil']  = set_value('nama_per_imqc_detil',$keuangan["nama_per_imqc_detil"]);
          $data['status_per_imqc_detil']  = set_value('status_per_imqc_detil',$keuangan["status_per_imqc_detil"]);
          $this->load->view("member/isi",$data);
        }
        if($mode=='simpan_edit'){
        $id_per_imqc_detil = $this->input->post('id_per_imqc_detil');
        $kondisi=array('pembuat_per_imqc_detil'=>$this->session->barcode_pegawai,'id_per_imqc_detil'=>$id_per_imqc_detil);
        $jml = $this->m_umum->jumlah_record_filter('ol_per_imqc_detil',$kondisi);
        if($jml == 0){
            $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
            redirect(base_url('member/mutu'));
        }else{
          if($this->m_member->edit_per_imqc_detil()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
            redirect(base_url('member/mutu'));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
            redirect(base_url('member/mutu'));
          }
        }
      }
    }
  }
  function i_mutup($mode='view'){
    $data['page']="i_mutup";
    $data['title'] = "INPUT MUTU";
    $data['header'] = "INDIKATOR MUTU";
		$this->m_auth->hak_member();
				$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
		$data['ambil_data_a_enabled'] = $this->m_ol_rancak->ambil_data_a_enabled();
//		$data['ol_akses'] = $this->m_ol_rancak->ol_akses($this->session->id_pegawai);
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
		$data['photo'] = $pegawai["foto"];
		//======================================
    $data['id'] = $this->uri->segment(4, 0);
    $data['id2'] = $this->uri->segment(5, 0);
    $data['id3'] = $this->uri->segment(6, 0);
    $data['id4'] = $this->uri->segment(7, 0);
    $kon = array('status_per_imqc'=>1,'id_unit'=>$this->session->unit,'jenis_per_imqc'=>1,'pembuat_per_imqc'=>$this->session->barcode_pegawai);
    $data['opsi'] = $this->m_ol_rancak->ambil_per_imqc_null($kon);
    $data['all_kah'] = array('0'=>'Range Tanggal','1'=>'Semua');
    if($mode=='view'){
      if(empty($data['id'])){
        if($this->session->has_userdata('tgl_imut_per1')){
          $data['id'] = $this->session->tgl_imut_per1;
        }else{
          $data['id'] = '01-'.date('m-Y');
        }
      }
      if(empty($data['id2'])){
        if($this->session->has_userdata('tgl_imut_per2')){
          $data['id2'] = $this->session->tgl_imut_per2;
        }else{
          $data['id2'] = date('d-m-Y');
        }
      }
      if(empty($data['id3'])){
        if($this->session->has_userdata('opsi_per_imut')){
          $data['id3'] = $this->session->opsi_per_imut;
        }else{
          $data['id3'] = 0;
        }
      }
      if(empty($data['id4'])){
        if($this->session->has_userdata('range_per_imut')){
          $data['id4'] = $this->session->range_per_imut;
        }else{
          $data['id4'] = 1;
        }
      }
      $this->tampil($data);
      $action = $this->input->post('action');
      if($action == 'BtnProses') {
        $first_date = $this->input->post("id");
        $last_date = $this->input->post("id2");
        $opsi_per_imut = $this->input->post("id3");
        $range_per_imut = $this->input->post("id4");
        $data_user_level = array(
          'tgl_imut_per1'     => $first_date,
          'tgl_imut_per2'     => $last_date,
          'opsi_per_imut'     => $opsi_per_imut,
          'range_per_imut'     => $range_per_imut
        );
        $this->session->set_userdata($data_user_level); 
        redirect(base_url('member/'.$data['page'].'/view/'.$first_date.'/'.$last_date.'/'.$opsi_per_imut.'/'.$range_per_imut));
      }
    }
    else if($mode=='data'){
      echo json_encode($this->m_member->ol_per_imqc_hasil_all($data['id'],$data['id2'],$data['id3'],$data['id4'],1));
    }
    else if($mode=='hapus'){
      $kondisi=array('barcode_pegawai'=>$this->session->barcode_pegawai,'id_per_imqc_hasil'=>$data['id']);
      $jml = $this->m_umum->jumlah_record_filter('ol_per_imqc_hasil',$kondisi);
      if($jml == 0){
          $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
          redirect(base_url('member/i_mutup'));
      }else{
        if($this->m_umum->hapus_data('ol_per_imqc_hasil','id_per_imqc_hasil',$data['id'])){
          $this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
          redirect(base_url('member/i_mutup'));
        }else{
          $this->session->set_flashdata('danger', 'Masalah Hapus Data');
          redirect(base_url('member/i_mutup'));
        }
      }
    }
    else{
      $data['cmd_status'] = $this->m_rancak->cmd_status();
      $data['cmd_ya_tidak'] = $this->m_rancak->cmd_ya_tidak();
      $kone = array('status_per_imqc_detil'=>1,'status_per_imqc'=>1,'id_unit'=>$this->session->unit,'pembuat_per_imqc_detil'=>$this->session->barcode_pegawai,'jenis_per_imqc'=>1);
      $data['per_imqc'] = $this->m_ol_rancak->ambil_per_imqc_detil($kone);
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
        $data['tgl_per_imqc_hasil']  = set_value('tgl_per_imqc_hasil',date('d-m-Y'));     
        $data['id_per_imqc_detil']  = set_value('id_per_imqc_detil',$this->input->post("id_per_imqc_detil"));        
        $data['yn_per_imqc_hasil']  = set_value('yn_per_imqc_hasil',0);        
        $data['ket_per_imqc_hasil']  = set_value('ket_per_imqc_hasil',$this->input->post("ket_per_imqc_hasil"));        
        $data['hasil_per_imqc_hasil']  = set_value('hasil_per_imqc_hasil',0);        
        $data['status_per_imqc_hasil']  = set_value('status_per_imqc_hasil',$this->input->post("status_per_imqc_hasil"));             
        $this->load->view("member/isi",$data);
      }
      if($mode=='simpan_tambah'){
        $id_per_imqc_detil = $this->input->post('id_per_imqc_detil');
        if($id_per_imqc_detil){
          if($this->m_member->simpan_per_imqc_hasil()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
            redirect(base_url('member/i_mutup'));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Simpan Data');
            redirect(base_url('member/i_mutup'));
          }
        }else{
            $this->session->set_flashdata('danger', 'Belum Ada Data');
            redirect(base_url('member/i_mutup'));          
        }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
        $keuangan    = $this->m_umum->ambil_data('ol_per_imqc_hasil','id_per_imqc_hasil',$data['id']);
        $data['tgl_per_imqc_hasil']  = set_value('tgl_per_imqc_hasil',date('d-m-Y', strtotime($keuangan["tgl_per_imqc_hasil"])));
        $data['id_per_imqc_hasil']  = set_value('id_per_imqc_hasil',$keuangan["id_per_imqc_hasil"]);
        $data['id_per_imqc_detil']  = set_value('id_per_imqc_detil',$keuangan["id_per_imqc_detil"]);
        $data['yn_per_imqc_hasil']  = set_value('yn_per_imqc_hasil',$keuangan["yn_per_imqc_hasil"]);
        $data['ket_per_imqc_hasil']  = set_value('ket_per_imqc_hasil',$keuangan["ket_per_imqc_hasil"]);
        $data['hasil_per_imqc_hasil']  = set_value('hasil_per_imqc_hasil',$keuangan["hasil_per_imqc_hasil"]);
        $data['status_per_imqc_hasil']  = set_value('status_per_imqc_hasil',$keuangan["status_per_imqc_hasil"]);
        $this->load->view("member/isi",$data);
      }
      if($mode=='simpan_edit'){
      $id_per_imqc_hasil = $this->input->post('id_per_imqc_hasil');
      $kondisi=array('barcode_pegawai'=>$this->session->barcode_pegawai,'id_per_imqc_hasil'=>$id_per_imqc_hasil);
      $jml = $this->m_umum->jumlah_record_filter('ol_per_imqc_hasil',$kondisi);
      if($jml == 0){
          $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
          redirect(base_url('member/i_mutup'));
      }else{
          if($this->m_member->rubah_per_imqc_hasil()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
            redirect(base_url('member/i_mutup'));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
            redirect(base_url('member/i_mutup'));
          }
        }
      }
      if($mode=='clone'){
        $data['page'] =  $data['page']."_clone";
        $keuangan    = $this->m_umum->ambil_data('ol_per_imqc_hasil','id_per_imqc_hasil',$data['id']);
        $data['tgl_per_imqc_hasil']  = set_value('tgl_per_imqc_hasil',date('d-m-Y', strtotime($keuangan["tgl_per_imqc_hasil"])));
        $data['id_per_imqc_hasil']  = set_value('id_per_imqc_hasil',$keuangan["id_per_imqc_hasil"]);
        $data['id_per_imqc_detil']  = set_value('id_per_imqc_detil',$keuangan["id_per_imqc_detil"]);
        $data['yn_per_imqc_hasil']  = set_value('yn_per_imqc_hasil',$keuangan["yn_per_imqc_hasil"]);
        $data['ket_per_imqc_hasil']  = set_value('ket_per_imqc_hasil',$keuangan["ket_per_imqc_hasil"]);
        $data['hasil_per_imqc_hasil']  = set_value('hasil_per_imqc_hasil',$keuangan["hasil_per_imqc_hasil"]);
        $data['status_per_imqc_hasil']  = set_value('status_per_imqc_hasil',$keuangan["status_per_imqc_hasil"]);
        $this->load->view("member/isi",$data);
      }
      if($mode=='simpan_clone'){
        if($this->m_member->simpan_per_imqc_hasil()){
          $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
          redirect(base_url('member/i_mutup'));
        }else{
          $this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
          redirect(base_url('member/i_mutup'));
        }
      }
    }
  }
//===================================================== !IM
//===================================================== QC
  function quality($mode='view'){
    $data['page']="quality";
    $data['title'] = "QUALITY CONTROL";
    $data['header'] = "QUALITY CONTROL";
		$this->m_auth->hak_member();
				$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
		$data['ambil_data_a_enabled'] = $this->m_ol_rancak->ambil_data_a_enabled();
//		$data['ol_akses'] = $this->m_ol_rancak->ol_akses($this->session->id_pegawai);
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
		$data['photo'] = $pegawai["foto"];	
    //======================= IMPORTANT =========================================
    $data['id'] = $this->uri->segment(4, 0);
    if($mode=='view'){
      $this->tampil($data);
    }
    else if($mode=='data'){
      echo json_encode($this->m_member->ol_per_imqc_all(2));
    }
    else{
      $data['cmd_status'] = $this->m_rancak->cmd_status();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
        $data['nama_per_imqc']  = set_value('nama_per_imqc',$this->input->post('nama_per_imqc'));
        $data['status_per_imqc']  = set_value('status_per_imqc',$this->input->post('status_per_imqc'));
        $this->load->view("member/isi",$data);
      }
      if($mode=='simpan_tambah'){
        if($this->m_member->simpan_per_imqc(2)){
          $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
          redirect(base_url('member/quality'));
        }else{
          $this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
          redirect(base_url('member/quality'));
        }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
        $keuangan    = $this->m_umum->ambil_data('ol_per_imqc','id_per_imqc',$data['id']);
        $data['id_per_imqc']  = set_value('id_per_imqc',$keuangan["id_per_imqc"]);
        $data['nama_per_imqc']  = set_value('nama_per_imqc',$keuangan["nama_per_imqc"]);
        $data['status_per_imqc']  = set_value('status_per_imqc',$keuangan["status_per_imqc"]);
        $data['pembuat_per_imqc']  = set_value('pembuat_per_imqc',$keuangan["pembuat_per_imqc"]);
        $this->load->view("member/isi",$data);
      }
      if($mode=='simpan_edit'){
      $id_per_imqc = $this->input->post('id_per_imqc');
      $kondisi=array('pembuat_per_imqc'=>$this->session->barcode_pegawai,'id_per_imqc'=>$id_per_imqc);
      $jml = $this->m_umum->jumlah_record_filter('ol_per_imqc',$kondisi);
      if($jml == 0){
          $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
          redirect(base_url('member/quality'));
      }else{
          if($this->m_member->edit_per_imqc()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
            redirect(base_url('member/quality'));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
            redirect(base_url('member/quality'));
          }
        }

      }
    }
  }
  function control($mode='view'){
    $data['page']="control";
    $data['title'] = "INPUT MUTU";
    $data['header'] = "QUALITY CONTROL";
		$this->m_auth->hak_member();
				$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
		$data['ambil_data_a_enabled'] = $this->m_ol_rancak->ambil_data_a_enabled();
//		$data['ol_akses'] = $this->m_ol_rancak->ol_akses($this->session->id_pegawai);
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
		$data['photo'] = $pegawai["foto"];	  
    //======================= IMPORTANT =========================================
    $data['id'] = $this->uri->segment(4, 0);
    if($mode=='view'){
      $this->tampil($data);
    }
    else if($mode=='data'){
      echo json_encode($this->m_member->ol_per_imqc_detil_all(2));
    }
    else{
        $data['cmd_status'] = $this->m_rancak->cmd_status();
        $kon = array('status_per_imqc'=>1,'pembuat_per_imqc'=>$this->session->barcode_pegawai,'id_unit'=>$this->session->unit,'jenis_per_imqc'=>2);
        $data['ambil_per_imqc'] = $this->m_ol_rancak->ambil_per_imqc($kon);
        if($mode=='tambah'){
          $data['page'] =  $data['page']."_tambah";
          $data['id_per_imqc']  = set_value('id_per_imqc',$this->input->post('id_per_imqc'));
          $data['nama_per_imqc_detil']  = set_value('nama_per_imqc_detil',$this->input->post('nama_per_imqc_detil'));
          $data['status_per_imqc_detil']  = set_value('status_per_imqc_detil',$this->input->post('status_per_imqc_detil'));
          $this->load->view("member/isi",$data);
        }
        if($mode=='simpan_tambah'){
        $id_per_imqc = $this->input->post('id_per_imqc');
        if($id_per_imqc){
            if($this->m_member->simpan_per_imqc_detil()){
              $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
              redirect(base_url('member/control'));
            }else{
              $this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
              redirect(base_url('member/control'));
            }
          }else{
               $this->session->set_flashdata('danger', 'Belum Ada Data');
              redirect(base_url('member/control'));           
          }
        }
        if($mode=='edit'){
          $data['page'] =  $data['page']."_edit";
          $keuangan    = $this->m_umum->ambil_data('ol_per_imqc_detil','id_per_imqc_detil',$data['id']);
          $data['id_per_imqc_detil']  = set_value('id_per_imqc_detil',$keuangan["id_per_imqc_detil"]);
          $data['id_per_imqc']  = set_value('id_per_imqc',$keuangan["id_per_imqc"]);
          $data['nama_per_imqc_detil']  = set_value('nama_per_imqc_detil',$keuangan["nama_per_imqc_detil"]);
          $data['status_per_imqc_detil']  = set_value('status_per_imqc_detil',$keuangan["status_per_imqc_detil"]);
          $this->load->view("member/isi",$data);
        }
        if($mode=='simpan_edit'){
        $id_per_imqc_detil = $this->input->post('id_per_imqc_detil');
        $kondisi=array('pembuat_per_imqc_detil'=>$this->session->barcode_pegawai,'id_per_imqc_detil'=>$id_per_imqc_detil);
        $jml = $this->m_umum->jumlah_record_filter('ol_per_imqc_detil',$kondisi);
        if($jml == 0){
            $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
            redirect(base_url('member/control'));
        }else{
          if($this->m_member->edit_per_imqc_detil()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
            redirect(base_url('member/control'));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
            redirect(base_url('member/control'));
          }
        }
      }
    }
  }
  function q_control($mode='view'){
    $data['page']="q_control";
    $data['title'] = "INPUT MUTU";
    $data['header'] = "INDIKATOR MUTU";
		$this->m_auth->hak_member();
				$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
		$data['ambil_data_a_enabled'] = $this->m_ol_rancak->ambil_data_a_enabled();
//		$data['ol_akses'] = $this->m_ol_rancak->ol_akses($this->session->id_pegawai);
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
		$data['photo'] = $pegawai["foto"];
		//======================================
    $data['id'] = $this->uri->segment(4, 0);
    $data['id2'] = $this->uri->segment(5, 0);
    $data['id3'] = $this->uri->segment(6, 0);
    $data['id4'] = $this->uri->segment(7, 0);
    $kon = array('status_per_imqc'=>1,'id_unit'=>$this->session->unit,'jenis_per_imqc'=>2,'pembuat_per_imqc'=>$this->session->barcode_pegawai);
    $data['opsi'] = $this->m_ol_rancak->ambil_per_imqc_null($kon);
    $data['all_kah'] = array('0'=>'Range Tanggal','1'=>'Semua');
    if($mode=='view'){
      if(empty($data['id'])){
        if($this->session->has_userdata('tgl_qc_per1')){
          $data['id'] = $this->session->tgl_qc_per1;
        }else{
          $data['id'] = '01-'.date('m-Y');
        }
      }
      if(empty($data['id2'])){
        if($this->session->has_userdata('tgl_qc_per2')){
          $data['id2'] = $this->session->tgl_qc_per2;
        }else{
          $data['id2'] = date('d-m-Y');
        }
      }
      if(empty($data['id3'])){
        if($this->session->has_userdata('opsi_per_qc')){
          $data['id3'] = $this->session->opsi_per_qc;
        }else{
          $data['id3'] = 0;
        }
      }
      if(empty($data['id4'])){
        if($this->session->has_userdata('range_per_qc')){
          $data['id4'] = $this->session->range_per_qc;
        }else{
          $data['id4'] = 1;
        }
      }
      $this->tampil($data);
      $action = $this->input->post('action');
      if($action == 'BtnProses') {
        $first_date = $this->input->post("id");
        $last_date = $this->input->post("id2");
        $opsi_per_qc = $this->input->post("id3");
        $range_per_qc = $this->input->post("id4");
        $data_user_level = array(
          'tgl_qc_per1'     => $first_date,
          'tgl_qc_per2'     => $last_date,
          'opsi_per_qc'     => $opsi_per_qc,
          'range_per_qc'     => $range_per_qc
        );
        $this->session->set_userdata($data_user_level); 
        redirect(base_url('member/'.$data['page'].'/view/'.$first_date.'/'.$last_date.'/'.$opsi_per_qc.'/'.$range_per_qc));
      }
    }
    else if($mode=='data'){
      echo json_encode($this->m_member->ol_per_imqc_hasil_all($data['id'],$data['id2'],$data['id3'],$data['id4'],2));
    }
    else if($mode=='hapus'){
      $kondisi=array('barcode_pegawai'=>$this->session->barcode_pegawai,'id_per_imqc_hasil'=>$data['id']);
      $jml = $this->m_umum->jumlah_record_filter('ol_per_imqc_hasil',$kondisi);
      if($jml == 0){
          $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
          redirect(base_url('member/q_control'));
      }else{
        if($this->m_umum->hapus_data('ol_per_imqc_hasil','id_per_imqc_hasil',$data['id'])){
          $this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
          redirect(base_url('member/q_control'));
        }else{
          $this->session->set_flashdata('danger', 'Masalah Hapus Data');
          redirect(base_url('member/q_control'));
        }
      }
    }
    else{
      $data['cmd_status'] = $this->m_rancak->cmd_status();
      $data['cmd_ya_tidak'] = $this->m_rancak->cmd_ya_tidak();
      $kone = array('status_per_imqc_detil'=>1,'status_per_imqc'=>1,'id_unit'=>$this->session->unit,'pembuat_per_imqc_detil'=>$this->session->barcode_pegawai,'jenis_per_imqc'=>2);
      $data['per_imqc'] = $this->m_ol_rancak->ambil_per_imqc_detil($kone);
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
        $data['tgl_per_imqc_hasil']  = set_value('tgl_per_imqc_hasil',date('d-m-Y'));     
        $data['id_per_imqc_detil']  = set_value('id_per_imqc_detil',$this->input->post("id_per_imqc_detil"));        
        $data['yn_per_imqc_hasil']  = set_value('yn_per_imqc_hasil',0);        
        $data['ket_per_imqc_hasil']  = set_value('ket_per_imqc_hasil',$this->input->post("ket_per_imqc_hasil"));        
        $data['hasil_per_imqc_hasil']  = set_value('hasil_per_imqc_hasil',0);        
        $data['status_per_imqc_hasil']  = set_value('status_per_imqc_hasil',$this->input->post("status_per_imqc_hasil"));             
        $this->load->view("member/isi",$data);
      }
      if($mode=='simpan_tambah'){
        $id_per_imqc_detil = $this->input->post('id_per_imqc_detil');
        if($id_per_imqc_detil){
          if($this->m_member->simpan_per_imqc_hasil()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
            redirect(base_url('member/q_control'));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Simpan Data');
            redirect(base_url('member/q_control'));
          }
        }else{
            $this->session->set_flashdata('danger', 'Belum Ada Data');
            redirect(base_url('member/q_control'));          
        }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
        $keuangan    = $this->m_umum->ambil_data('ol_per_imqc_hasil','id_per_imqc_hasil',$data['id']);
        $data['tgl_per_imqc_hasil']  = set_value('tgl_per_imqc_hasil',date('d-m-Y', strtotime($keuangan["tgl_per_imqc_hasil"])));
        $data['id_per_imqc_hasil']  = set_value('id_per_imqc_hasil',$keuangan["id_per_imqc_hasil"]);
        $data['id_per_imqc_detil']  = set_value('id_per_imqc_detil',$keuangan["id_per_imqc_detil"]);
        $data['yn_per_imqc_hasil']  = set_value('yn_per_imqc_hasil',$keuangan["yn_per_imqc_hasil"]);
        $data['ket_per_imqc_hasil']  = set_value('ket_per_imqc_hasil',$keuangan["ket_per_imqc_hasil"]);
        $data['hasil_per_imqc_hasil']  = set_value('hasil_per_imqc_hasil',$keuangan["hasil_per_imqc_hasil"]);
        $data['status_per_imqc_hasil']  = set_value('status_per_imqc_hasil',$keuangan["status_per_imqc_hasil"]);
        $this->load->view("member/isi",$data);
      }
      if($mode=='simpan_edit'){
      $id_per_imqc_hasil = $this->input->post('id_per_imqc_hasil');
      $kondisi=array('barcode_pegawai'=>$this->session->barcode_pegawai,'id_per_imqc_hasil'=>$id_per_imqc_hasil);
      $jml = $this->m_umum->jumlah_record_filter('ol_per_imqc_hasil',$kondisi);
      if($jml == 0){
          $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
          redirect(base_url('member/q_control'));
      }else{
          if($this->m_member->rubah_per_imqc_hasil()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
            redirect(base_url('member/q_control'));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
            redirect(base_url('member/q_control'));
          }
        }
      }
      if($mode=='clone'){
        $data['page'] =  $data['page']."_clone";
        $keuangan    = $this->m_umum->ambil_data('ol_per_imqc_hasil','id_per_imqc_hasil',$data['id']);
        $data['tgl_per_imqc_hasil']  = set_value('tgl_per_imqc_hasil',date('d-m-Y', strtotime($keuangan["tgl_per_imqc_hasil"])));
        $data['id_per_imqc_hasil']  = set_value('id_per_imqc_hasil',$keuangan["id_per_imqc_hasil"]);
        $data['id_per_imqc_detil']  = set_value('id_per_imqc_detil',$keuangan["id_per_imqc_detil"]);
        $data['yn_per_imqc_hasil']  = set_value('yn_per_imqc_hasil',$keuangan["yn_per_imqc_hasil"]);
        $data['ket_per_imqc_hasil']  = set_value('ket_per_imqc_hasil',$keuangan["ket_per_imqc_hasil"]);
        $data['hasil_per_imqc_hasil']  = set_value('hasil_per_imqc_hasil',$keuangan["hasil_per_imqc_hasil"]);
        $data['status_per_imqc_hasil']  = set_value('status_per_imqc_hasil',$keuangan["status_per_imqc_hasil"]);
        $this->load->view("member/isi",$data);
      }
      if($mode=='simpan_clone'){
        if($this->m_member->simpan_per_imqc_hasil()){
          $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
          redirect(base_url('member/q_control'));
        }else{
          $this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
          redirect(base_url('member/q_control'));
        }
      }
    }
  }
//===================================================== !QC
	function even($mode='view'){
		$data['page']="even"; 
		$data['header'] = "DATA EVEN / ACARA";
		$data['title'] = "DATA EVEN / ACARA";
		$this->m_auth->hak_member();
				$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
/*		$data['multi_level'] = $this->m_ol_rancak->ambil_data_link_pengurus($this->session->id_pegawai);
		$data['multi_struktur'] = $this->m_ol_rancak->ambil_data_link_struktur($this->session->id_pegawai);*/
		$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
		$data['ambil_data_a_enabled'] = $this->m_ol_rancak->ambil_data_a_enabled();
//		$data['ol_akses'] = $this->m_ol_rancak->ol_akses($this->session->id_pegawai);
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
		$data['photo'] = $pegawai["foto"];	
		//======================= IMPORTANT =========================================
		$data['id'] = $this->uri->segment(4, 0);
		if($mode=='view'){
			$this->tampil($data);
		}
		else if($mode=='data'){
			echo json_encode($this->m_member->abs_even_all());
		}
		else{
      if($mode=='detil'){
					$data_acara = array(
						'even_acara'     => $data['id']
					);
					$this->session->set_userdata($data_acara);	
	        redirect(base_url('member/acara'));
      }
		}
	}
  function acara($mode='view')
  {
		$data['page']  = "acara";
		$data['header'] = "ABSENSI EVEN /KEGIATAN";
		$data['title'] = "ABSENSI EVEN /KEGIATAN";
		$this->m_auth->hak_member();
				$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
/*		$data['multi_level'] = $this->m_ol_rancak->ambil_data_link_pengurus($this->session->id_pegawai);
		$data['multi_struktur'] = $this->m_ol_rancak->ambil_data_link_struktur($this->session->id_pegawai);*/
		$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
		$data['ambil_data_a_enabled'] = $this->m_ol_rancak->ambil_data_a_enabled();
//		$data['ol_akses'] = $this->m_ol_rancak->ol_akses($this->session->id_pegawai);
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
		$data['photo'] = $pegawai["foto"];	
		$data['id'] = $this->uri->segment(4, 0);
	//======================= IMPORTANT ======================================
		if(empty($this->session->has_userdata('even_acara'))){
			redirect(base_url('admin_even/even'));
		}
		$keuangan    = $this->m_umum->ambil_data('abs_even','id_even',$this->session->even_acara);
		$data['tgl_even']  = set_value('tgl_even',date('d-m-Y',strtotime($keuangan["tgl_even"])));
		$data['time_even']  = set_value('time_even',date('H:i',strtotime($keuangan["time_even"])));
		$data['id_even']  = set_value('id_even',$keuangan["id_even"]);
		$data['nama_even']  = set_value('nama_even',$keuangan["nama_even"]);
		$data['peserta_even']  = set_value('peserta_even',$keuangan["peserta_even"]);
		$data['location_even']  = set_value('location_even',$keuangan["location_even"]);
		$data['include_radius']  = set_value('include_radius',$keuangan["include_radius"]);
		$data['status_even']  = set_value('status_even',$keuangan["status_even"]);
		$data['seen_even']  = set_value('seen_even',$keuangan["seen_even"]);
		$data['zoom']  = set_value('zoom',18);
    if($mode=='view'){
			$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_member->abs_even_detil_all());
	}
	else{
      if($mode=='absen'){
        $data['page'] =  $data['page']."_absen";
        $att = $this->m_umum->ambil_data('abs_even_detil','id_even_detil',$data['id']);
        $data['id_even']  = set_value('id_even',$att["id_even"]);
        $data['id_even_detil']  = set_value('id_even_detil',$att["id_even_detil"]);
				$kondisi_abs = array('id_even_peserta'=>$this->session->barcode_pegawai,'id_even_detil'=>$att["id_even_detil"]);
				$jml = $this->m_umum->jumlah_record_filter('abs_even_attendance',$kondisi_abs);
				if($jml == 0){
	        if($keuangan["status_even"] == 2){
	        	$data['tombole'] = '<button type="submit" class="btn btn-primary btn-block"><i class="fa fa-clock-o"></i>&nbsp; ABSENSI</button>';
	        }else{
	        	$data['tombole'] = '<span class="btn btn-danger btn-block">BELUM DAPAT ABSENSI</span>';
	        }
	      }else{
	      	$data['tombole'] = '<span class="btn btn-danger btn-block">SUDAH MELAKUKAN ABSENSI</span>';
	      }
				$this->load->view("member/isi",$data);
      }
      if($mode=='simpan_absen'){
      	$status_even = $this->input->post('status_even');
      	$id_even_detil = $this->input->post('id_even_detil');
				$kondisi_abs = array('id_even_peserta'=>$this->session->barcode_pegawai,'id_even_detil'=>$id_even_detil);
				$jml = $this->m_umum->jumlah_record_filter('abs_even_attendance',$kondisi_abs);
				if($status_even == 2){
	      	if($jml == 0){
						$include_radius = $this->input->post('include_radius');
						$location = $this->input->post('location');
						$location_even = $this->input->post('location_even');
						$id_kategori_absen = $this->input->post('id_kategori_absen');
						if(empty($location)){
							$this->session->set_flashdata('danger', 'Data Belum Lengkap Tidak Aktif');
						}else{
							if($include_radius == 0){
								$this->m_member->simpan_absensi_even();
								$this->session->set_flashdata('sukses', 'success');
							}else{
								$location_user_exp   = explode(',', $location);
								$latitude_user       = $location_user_exp[0];
								$longitude_user      = trim($location_user_exp[1]);

								$location_office_exp = explode(',', $location_even);
								$latitude_office     = $location_office_exp[0];
								$longitude_office    = trim($location_office_exp[1]);
								$radius_office       = $include_radius;

								$distance = $this->m_ol_rancak->distance($latitude_office, $longitude_office, $latitude_user, $longitude_user);
								$distance = round($distance['meters']);
								if($distance < $radius_office){
								  if($this->m_member->simpan_absensi_even()){
										$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
										redirect(base_url('member/acara'));
								  }else{
										$this->session->set_flashdata('danger', 'Ada Kesalahan Simpan Data');
										redirect(base_url('member/acara'));
					  			}
								}else{
									$this->session->set_flashdata('danger', 'Your distance exceeds the maximum office radius');
								}
							}
						}
	      	}else{
							$this->session->set_flashdata('danger', 'Sudah Melakukan Absensi');
							redirect(base_url('member/acara'));      		
	      	}
	      }else{
							$this->session->set_flashdata('danger', 'Acara belum di mulai');
							redirect(base_url('member/acara')); 	      	
	      }
      }
		}
  }
	function pendaftaran($mode='view'){
		$data['page']="pendaftaran"; 
		$data['header'] = "DATA PENDAFTARAN";
		$data['title'] = "DATA PENDAFTARAN";
			$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
/*		$data['multi_level'] = $this->m_ol_rancak->ambil_data_link_pengurus($this->session->id_pegawai);
		$data['multi_struktur'] = $this->m_ol_rancak->ambil_data_link_struktur($this->session->id_pegawai);*/
	$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
	$data['ambil_data_a_enabled'] = $this->m_ol_rancak->ambil_data_a_enabled();
//	$data['ol_akses'] = $this->m_ol_rancak->ol_akses($this->session->id_pegawai);
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
		if(!empty($data['asesor'])){
			$data['level_name'] = $asesor["nama_komite"];
		}else{
			$data['level_name'] = $pegawai["nama_level"];			
  	}
	$data['photo'] = $pegawai["foto"];	
		//======================= IMPORTANT =========================================
		$data['id'] = $this->uri->segment(4, 0);
		if($mode=='view'){
			$this->tampil($data);
		}
		else if($mode=='data'){
			echo json_encode($this->m_member->pendaftaran_all());
		}
		else{
      if($mode=='tambah_kewenangan'){
        $data['page'] =  $data['page']."_tambah_kewenangan";
        $data['title'] = "TAMBAH LOGBOOK PEMERIKSAAN";
        $d = $this->m_member->ambil_data_transaksi_pendaftaran($data['id']);
        $data['sifat']=$this->m_ol_rancak->cmd_sifat_kewenangan();
        $data['id_operator']  = set_value('id_operator',$d['id_operator']);
        $data['rm']  = set_value('rm',$d['rm']);
        $data['status_transaksi']  = set_value('status_transaksi',$d['status_transaksi']);
        $data['id_pasien']  = set_value('id_pasien',$d['id_pasien']);
        $data['tgl_transaksi']  = set_value('tgl_transaksi',$d['tgl_transaksi']);
        $data['id_kewenangan']  = set_value('id_kewenangan',$this->input->post("id_kewenangan"));
        $data['id_sifat_kewenangan']  = set_value('id_sifat_kewenangan',$this->input->post("id_sifat_kewenangan"));
        $data['jml_logbook']  = set_value('jml_logbook',1);
        $data['kewenangan'] = $this->m_member->kewenangan_all_no_null($this->session->id_jabatan);
        $this->load->view("member/isi",$data);
      }
      if($mode=='simpan_tambah_kewenangan'){
        $status_transaksi = $this->input->post('status_transaksi');
        if($status_transaksi == 0){
          if($Q = $this->m_member->simpan_logboook()){
            $this->m_member->simpan_tindakan_kewenangan($Q);
            $this->m_member->simpen_ol_logbook_pasien($Q);
            $this->session->set_flashdata('sukses', 'Data Sudah Di Tambah');
          }else{
            $this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
          }
        }else{
          $this->session->set_flashdata('danger', 'Pendaftaran Sudah Close');
        }
          redirect(base_url('member/pendaftaran'));
      }
      if($mode=='edit_kewenangan'){
        $data['page'] =  $data['page']."_edit_kewenangan";
        $data['title'] = "EDIT LOGBOOK PEMERIKSAAN";
        $kondisi = array('id_tindakan_kewenangan'=>$data['id']);
        $d = $this->m_umum->ambil_data_kondisi_2tabel_row('tindakan_kewenangan',$kondisi,'ol_logbook','id_logbook');
        $brg = $this->m_ol_rancak->ambil_data_operator_kw($d['id_operator']);
        $data['sifat']=$this->m_ol_rancak->cmd_sifat_kewenangan();
        $data['id_logbook']  = set_value('id_logbook',$d['id_logbook']);
        $data['id_kewenangan']  = set_value('id_kewenangan',$d['id_kewenangan']);
        $data['id_sifat_kewenangan']  = set_value('id_sifat_kewenangan',$d['id_sifat_kewenangan']);
        $data['jml_logbook']  = set_value('jml_logbook',$d['jml_logbook']);
        $data['kewenangan'] = $this->m_member->kewenangan_all_no_null($this->session->id_jabatan);
        $this->load->view("member/isi",$data);
      }
      if($mode=='simpan_edit_kewenangan'){
        if($this->m_member->rubah_kewenangan()){
          $this->session->set_flashdata('sukses', 'Data Sudah Di Rubah');
        }else{
          $this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
        }
        redirect(base_url('member/pendaftaran'));
      }
      if($mode=='hapuskw'){
          $brg = $this->m_umum->ambil_data('tindakan_kewenangan','id_tindakan_kewenangan',$data['id']);
          if($this->m_umum->hapus_data('tindakan_kewenangan','id_tindakan_kewenangan',$data['id'])){
            $this->m_umum->hapus_data('ol_logbook','id_logbook',$brg['id_logbook']);
            $this->m_umum->hapus_data('ol_logbook_pasien','id_logbook',$brg['id_logbook']);
            $this->session->set_flashdata('sukses', 'Data Sudah Dihapus');
          }else{
            $this->session->set_flashdata('danger', 'Ada Masalah Hapus Data. Hubungi Admin');
          }
          redirect(base_url('member/pendaftaran'));
      }
		}
	}
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("member/header",$data);
	$this->load->view("member/isi");
	$this->load->view("footer");
	$this->load->view("member/jsload");
	$this->load->view("member/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_topol",$data);
	$this->load->view("member/isi");
	$this->load->view("footer");
	$this->load->view("member/jsload");
	$this->load->view("member/jscode");
}
function tampil_ra($data)
{
	$this->load->view("header_ra",$data);
	$this->load->view("member/isi");
	$this->load->view("footer_ra");
	$this->load->view("jsload_ra");
	$this->load->view("member/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
