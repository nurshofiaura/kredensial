<?php
class M_umum extends CI_model{
	function set_timezone()	//Login.php
	{
        if ($this->session->userdata('id_pegawai')) {
            $this->db->select('timezone');
            $this->db->from($this->db->dbprefix . 'ol_pegawai');
            $this->db->where('id_pegawai', $this->session->userdata('id_pegawai'));
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
            	if(empty($query->row()->timezone)){
            		date_default_timezone_set('Asia/Kolkata');
            	}else{
               		date_default_timezone_set($query->row()->timezone);
            	}
            } else {
                date_default_timezone_set('Asia/Kolkata');
            }
        }
	}
	function cek_login()	//Login.php
	{
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		$password=hash("sha512", md5($password));
		$this->db->join('user_level', 'user_level.id_level=user.id_level','left');
		$this->db->join('pegawai', 'pegawai.id_pegawai=user.id_pegawai','left');
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=pegawai.id_jabatan_fungsional','left');
		$query=$this->db->get_where('user', array('username'=>$username, 'password'=>$password));
		return $query->row_array();
	}
	function auth_pcare($id = FALSE)
	{
		if($id === FALSE)
		{
			$query=$this->db->get_where('a_pcare', array('status_pcare'=>1,'id_instansi'=>0));
		}else{
			$query=$this->db->get_where('a_pcare', array('status_pcare'=>1,'id_instansi'=>$id));
		}
		return $query->row_array();
	}
	function sendEmail($tujuan,$judul,$pesan,$subyek,$pengirim){
		$this->load->library('email');
		$wemail = $this->db->get_where('a_email',array('id_email' => '1'))->row_array();
		$server = $wemail['server'];
		$port = $wemail['port'];
		$user = $wemail['user'];
		$pass = $wemail['pass'];
		$config['protocol'] = "smtp";
		$config['smtp_host'] = $server;
		$config['smtp_port'] = $port;
		$config['smtp_user'] = $user;
		$config['smtp_pass'] = $pass;
		$config['smtp_crypto'] = "ssl";
		$config['charset'] = "utf-8";
		$config['mailtype'] = "html";
		$config['newline'] = "\r\n";
		$this->email->initialize($config);

		$this->email->from($pengirim, $judul);
		$this->email->to($tujuan);
		$this->email->cc($pengirim);
	//	$pesan = $this->load->view("main/email_template",array("content"=>$pesan),true);
		$this->email->subject($subyek);
		$this->email->message($pesan);

		if($this->email->send()){
			return true;
		}else{
		//show_error($this->email->print_debugger());
			return false;
		}
	}
	function kirim_email($email,$judul,$message,$instance_name,$logo){
		$email_penerima = $email;
		$subjek = $judul;
		$pesan = $message;
		$attachment = '';
		$content = $this->load->view('email/email', array('pesan'=>$pesan,'instance_name'=>$instance_name,'logo'=>$logo), true); // Ambil isi file content.php dan masukan ke variabel $content
		$sendmail = array(
			'email_penerima'=>$email_penerima,
			'subjek'=>$subjek,
			'content'=>$content,
			'attachment'=>$attachment
		);

		if(empty($attachment['name'])){ // Jika tanpa attachment
			$send = $this->mailer->send($sendmail); // Panggil fungsi send yang ada di librari Mailer
		}else{ // Jika dengan attachment
			$send = $this->mailer->send_with_attachment($sendmail); // Panggil fungsi send_with_attachment yang ada di librari Mailer
		}
	}
	function kirim_wageblast($pesan,$receiver)	//sa.php
	{
		$ptn = "/^0/";  // Regex
		$str = $receiver; //Your input, perhaps $_POST['textbox'] or whatever
		$rpltxt = "+62";  // Replacement string
		$receiver = preg_replace($ptn, $rpltxt, $str);
		$wa = $this->db->get_where('a_wageblast',array('id_wageblast' => '1'))->row_array();
		$url_api = $wa['url_api'];
		$api = $wa['api'];
		$user_api = $wa['user_api'];
		$sender = $wa['sender'];
		$data = [
			'username' => $user_api,
			'sender'  => $sender,
			'number'  => $receiver,
			'pesan' => $pesan

		];
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url_api . $api,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => json_encode($data),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
	}
	function rubah_telepon($receiver)	//sa.php
	{
		$ptn = "/^0/";  // Regex
		$str = $receiver; //Your input, perhaps $_POST['textbox'] or whatever
		$rpltxt = "+62";  // Replacement string
		$receiver = preg_replace($ptn, $rpltxt, $str);
		return $receiver;
	}
	function kirim_fonte_pdf($token,$target,$text,$logo,$filename,$header,$texturl,$url)	//sa.php
	{
		$ptn = "/^0/";  // Regex
		$str = $target; //Your input, perhaps $_POST['textbox'] or whatever
		$rpltxt = "+62";  // Replacement string
		$target = preg_replace($ptn, $rpltxt, $str);
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://api.fonnte.com/send',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => array(
		  'url' => $logo,
		  'filename' => $filename,
		  'templateJSON' => '{"message":"'.$header.'","buttons":[{"message":"'.$texturl.'","url":"'.$url.'"}]}',
		  'target' => $target,
		  'message' => $text,
		  'delay' => '2-5',
		),
		  CURLOPT_HTTPHEADER => array(
		    "Authorization: $token"
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		echo $response;
	}
	function kirim_fonte_kop($token,$target,$text,$logo)	//sa.php
	{
		$ptn = "/^0/";  // Regex
		$str = $target; //Your input, perhaps $_POST['textbox'] or whatever
		$rpltxt = "+62";  // Replacement string
		$target = preg_replace($ptn, $rpltxt, $str);
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://api.fonnte.com/send',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => array(
		  'url' => $logo,
		  'target' => $target,
		  'message' => $text,
		  'delay' => '2-5',
		),
		  CURLOPT_HTTPHEADER => array(
		    "Authorization: $token"
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		echo $response;
	}
	function kirim_fonte_text($token,$target,$text)	//terget multi use comma 62812345678,62814323456
	{
		$ptn = "/^0/";  // Regex
		$str = $target; //Your input, perhaps $_POST['textbox'] or whatever
		$rpltxt = "+62";  // Replacement string
		$target = preg_replace($ptn, $rpltxt, $str);
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://api.fonnte.com/send',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => array(
		  'target' => $target,
		  'message' => $text,
		  'delay' => '2-5',
		),
		  CURLOPT_HTTPHEADER => array(
		    "Authorization: $token"
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		echo $response;
	}
	function get_min($tabel,$field,$kondisi){
		$query = $this->db->select("MIN(".$field.") as num")->get_where($tabel,$kondisi);
	    $result = $query->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
	}
	function get_max($tabel,$field,$kondisi){
		$query = $this->db->select("MAX(".$field.") as num")->get_where($tabel,$kondisi);
	    $result = $query->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
	}
	function jumlah_record_tabel($tabel)	//sa.php
	{
		$query = $this->db->select("COUNT(*) as num")->get($tabel);
	    $result = $query->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
	}
    //Jumlah total record dari sebuah tabel dengan if tertentu
    function jumlah_record_filter($tabel,$kondisi,$grup=FALSE)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
        $this->db->where($kondisi);
        if($grup){
          $this->db->group_by($grup);
        }
        $query = $this->db->select("COUNT(*) as num")->get_where($tabel);
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
    function jumlah_record_filter_select($select,$tabel,$kondisi,$table2,$field,$grup=FALSE)
    {
        $this->db->join($table2, $table2.".".$field."=".$tabel.".".$field, 'left');
        $this->db->where($kondisi);
        if($grup){
          $this->db->group_by($grup);
        }
        $query = $this->db->select($select)->get_where($tabel);
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
    function jumlah_record_filter_array($tabel,$kondisi,$source,$comma)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
    	$ids = explode(',', $comma);
    	$this->db->where($kondisi);
        $this->db->where_in($source,$ids);
        $query = $this->db->select("COUNT(*) as num")->get_where($tabel);
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
    function jumlah_record_filter_explode($tabel,$source,$comma)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
    	$ids = explode(',', $comma);
        $this->db->where_in($source,$ids);
        $query = $this->db->select("COUNT(*) as num")->get_where($tabel);
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
    function jumlah_range_tabel_kondisi($table,$fielddate,$first_date_dmy,$last_date_dmy,$kondisi)
    {
        $this->db->where($kondisi);
		$this->db->where(''.$fielddate.' BETWEEN "'. date('Y-m-d', strtotime($first_date_dmy)). '" and "'. date('Y-m-d', strtotime($last_date_dmy)).'"');
        $query = $this->db->select("COUNT(*) as num")->get_where($tabel);
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
	function jumlah_record_tabel_pengajuan($tabel,$kondisi,$table2,$field,$grup=FALSE)	//sa.php
	{
		$this->db->select('COUNT(*) as num');
		$this->db->join($table2, $table2.".".$field."=".$tabel.".".$field, 'left');
		$this->db->where($kondisi);
    if($grup){
      $this->db->group_by($grup);
    }
		$query = $this->db->get_where($tabel);
    // echo $this->db->last_query();
	    $result = $query->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
	}
  function jumlah_record_tabel_pengajuan_select($count,$tabel,$kondisi,$table2,$field,$grup=FALSE)  //sa.php
  {
    $this->db->select('COUNT('.$count.') as num');
    $this->db->join($table2, $table2.".".$field."=".$tabel.".".$field, 'left');
    $this->db->where($kondisi);
    if($grup){
      $this->db->group_by($grup);
    }
    $query = $this->db->get_where($tabel);
    // echo $this->db->last_query();
      $result = $query->num_rows();
      if(isset($result))
        return $result->num;
      return 0;
  }
	function total_range_tabel_kondisi($table,$fieldsum,$fielddate,$first_date_dmy,$last_date_dmy,$kondisi)	//sa.php
	{
		$this->db->select_sum($fieldsum);
		$this->db->from($table);
		$this->db->where($kondisi);
		$this->db->where(''.$fielddate.' BETWEEN "'. date('Y-m-d', strtotime($first_date_dmy)). '" and "'. date('Y-m-d', strtotime($last_date_dmy)).'"');
		$query = $this->db->get();
		return $query->row()->$fieldsum;
	}
    //Menampilkan jumlah record terfilter untuk keperluan datatable
    function jumlah_record_tabel_filter($tabel,$columns_valid, $cari)   //dibawah
    {
        if(!empty($cari)) {
            foreach($columns_valid as $d)
                $this->db->or_like($d, $cari,'both',false);
        }
        $query = $this->db->select("COUNT(*) as num")->get_where($tabel);
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
	function ambil_data($tabel, $kolom = FALSE, $id = FALSE)		//header.php
	{
		if($id === FALSE)
		{
			$q = $this->db->get($tabel);
			return $q->result_array();
		}
		$q = $this->db->get_where($tabel,array($kolom=>$id));
		return $q->row_array();
	}
	function ambil_data_result($tabel, $kolom = FALSE, $id = FALSE)		//header.php
	{
		if($id === FALSE)
		{
			$q = $this->db->get($tabel);
			return $q->result_array();
		}
		$q = $this->db->get_where($tabel,array($kolom=>$id));
		return $q->result_array();
	}
	function ambil_data_explode($tabel, $kolom, $id)		//header.php
	{
		$eimplo = explode(',', $id);
		$this->db->where_in($kolom,$eimplo);
		$q = $this->db->get_where($tabel);
		return $q->result_array();
	}
	function ambil_data_kondisi($tabel,$kondisi,$grup=FALSE)		//header.php
	{
    if($grup){
      $this->db->group_by($grup);
    }
		$q = $this->db->get_where($tabel,$kondisi);
		return $q->row_array();
	}
  function ambil_data_order_kondisi($tabel,$kondisi,$order,$asc,$grup=FALSE)    //header.php
  {
    if($grup){
      $this->db->group_by($grup);
    }
    $this->db->order_by($order,$asc);
    $q = $this->db->get_where($tabel,$kondisi);
    return $q->row_array();
  }
	function ambil_data_kondisi_result($tabel,$kondisi,$grup=FALSE)		//header.php
	{
    if($grup){
      $this->db->group_by($grup);
    }
		$q = $this->db->get_where($tabel,$kondisi);
		return $q->result_array();
	}
  function ambil_data_order_kondisi_result($tabel,$kondisi,$order,$asc,$grup=FALSE)    //header.php
  {
    if($grup){
      $this->db->group_by($grup);
    }
    $this->db->order_by($order,$asc);
    $q = $this->db->get_where($tabel,$kondisi);
    return $q->result_array();
  }
  function ambil_order_kondisi_2tabel_result($tabel,$kondisi,$table2,$field,$order,$asc,$grup=FALSE)
  {
  	$this->db->join($table2, $table2.".".$field."=".$tabel.".".$field, 'left');
    if($grup){
      $this->db->group_by($grup);
    }
    $this->db->order_by($order,$asc);
    $q = $this->db->get_where($tabel,$kondisi);
    return $q->result_array();
  }
    function ambil_comma_join_kondisi($tabel,$kondisi,$source,$comma,$order,$asc,$table2=FALSE,$field=FALSE)
    {
    	$ids = explode(',', $comma);
    	if($table2){
    		$this->db->join($table2, $table2.".".$field."=".$tabel.".".$field, 'left');
    	}
        $this->db->where_in($source,$ids);
	    $this->db->order_by($order,$asc);
	    $q = $this->db->get_where($tabel,$kondisi);
	    //echo $this->db->last_query();die();
	    return $q->result_array();
    }
	function ambil_data_kondisi_2tabel_result($tabel,$kondisi,$table2,$field,$field2=FALSE)	//sa.php
	{
		if($field2){
			$this->db->join($table2, $table2.".".$field2."=".$tabel.".".$field, 'left');
		}else{
			$this->db->join($table2, $table2.".".$field."=".$tabel.".".$field, 'left');
		}
		$q = $this->db->get_where($tabel,$kondisi);
	//	echo $this->db->last_query();die();
		return $q->result_array();
	}
	function ambil_data_kondisi_2tabel_row($tabel,$kondisi,$table2,$field,$field2=FALSE)	//sa.php
	{	
		if($field2){
			$this->db->join($table2, $table2.".".$field2."=".$tabel.".".$field, 'left');
		}else{
			$this->db->join($table2, $table2.".".$field."=".$tabel.".".$field, 'left');
		}
		$q = $this->db->get_where($tabel,$kondisi);
		return $q->row_array();
	}
	//Ambil data untuk dropdown. tabel, primary, text.
	//jika order tidak di isi. No order. xx, ax
	//Jika ditulis tabel saja, maka field 1 adalah primary, dan field ke 2 adalah isinya.
	//Jika ditulis val, maka hrs berisi primary field, dan text adalah field yg akan ditampilkan
     function ambil_data_dropdown($tabel,$order='XX',$val=FALSE,$text=FALSE) {           //sa.php
        if(!$val){   //field tabelnya hanya 2. Tidak bisa fitur diatas
            $query = $this->db->get($tabel)->result_array();
            $fields = $this->db->list_fields($tabel);
            foreach ($fields as $field)
                $dt[] = $field;
            array_unshift($query, array($dt[0] => "0", $dt[1] => "Silahkan Pilih")); //pildef (pilihan default) = Silahkan Pilih
            $q = array_column($query, $dt[1], $dt[0]);
        }
        else{ //filed tabel lebih dari 2
        	switch($order){
        		case 'AX': $this->db->order_by($val,'ASC');break;
        		case 'DX': $this->db->order_by($val,'DESC');break;
        		case 'XA': $this->db->order_by($text,'ASC');break;
        		case 'XD': $this->db->order_by($text,'DESC');break;
        	}
            $this->db->select($val.',CONCAT("[",'.$val.',"] ",'.$text.') as txt');
            $query = $this->db->get($tabel)->result_array();
            // echo $this->db->last_query();die();
            array_unshift($query, array($val => "0", 'txt' => "Silahkan Pilih")); //pildef (pilihan default) = Silahkan Pilih
            $q = array_column($query, 'txt', $val);
        }
        return $q;
    } 
	function edit_check($tabel,$field,$id,$id_post){
		$chk = $this->input->post('chk[]');
		if (empty($chk)) {
		   $post = "";
		}else{
			$post = implode(",",$chk);
		}
		$data_edit = array(
			$field => $post
		);
		$this->db->where($id,$id_post);
		$this->db->update($tabel, $data_edit);
		//echo $this->db->last_query();
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) 
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
    function tambah_data($tabel)    //Terpakai. Insert Data Universal
	{
		$data=$this->input->post(null,TRUE);
		$this->db->insert($tabel, $data);
		return $this->db->insert_id();	// return berupa id terakhir
	}
	function edit_data($tabel)		//Update Data. Post Array. Primary harus di awal field.
	{
		$this->db->trans_start();		// untuk cek sukses update tidak
		$data=$this->input->post(null,TRUE);
		$primary=array_slice($data,0,1);
		array_shift($data);
	    $this->db->where($primary);
	    $this->db->update($tabel, $data);

	    $this->db->trans_complete();	// untuk cek sukses update tidak

		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
        {
            $this->db->error;
		    // return(FALSE);
        }
		else
		    return(TRUE);
	}
	function hapus_data($tabel,$kolom,$id)  //terpakai
	{
		$this->db->delete($tabel,array($kolom => $id));
		if (!$this->db->affected_rows())
		    return(FALSE);
		else
		    return(TRUE);
	}
	function hapus_data_kondisi($tabel,$kondisi)		// $kondisi = array($kolom => $id)
	{
		$this->db->delete($tabel,$kondisi);
		if (!$this->db->affected_rows())
		    return(FALSE);
		else
		    return(TRUE);
	}
    //------- Total Antri -------------------------------------
    //Cari unit dan tanggal yang sama, return last id, selain itu return 0.
    function total_antri($id_unit,$waktu_daftar)  //daftar.php
    {
        //Cari id terakhir dengan unit dan tanggal yang sama
        $this->db->select("id_pendaftaran_unit, no_antri");
        $this->db->where("id_unit", $id_unit);
        $this->db->where("DATE(tgl_pendaftaran_unit)", $waktu_daftar);
        // $this->db->where("DATE(waktu_daftar)", '2019-05-01');
        $this->db->order_by('id_pendaftaran_unit', 'DESC');
        $query=$this->db->get_where("pendaftaran_unit");
        $result = $query->row();
        // echo $this->db->last_query();
        // echo "No Antri = ".$result->no_antri;die();
        if(isset($result))
            return $result->no_antri;
        return 0;
    }
//	======================== MODEL UNTUK DATATABLE : VIEW ONLY ==================================
    function ambil_datatable($data) {   //sa.php
        $draw = intval($this->input->post('draw'));
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));
        $order = $this->input->post('order');
        $cari = $this->input->post('search');

        $col = $order['0']['column'];
        $dir = $order['0']['dir'];
        $orderby = $data['kolom'][$col];
        $this->db->order_by($orderby, $dir);

        if(!empty($cari)) {
            foreach($data['kolom'] as $d)
                $this->db->or_like($d, $cari['value'],'both',false);
        }
        $list = $this->db->limit($length,$start)->get($data['tabel']);

        $dt = array();
        foreach ($list->result_array() as $d) {
            $dt1 = array();
            foreach ($data['kolom'] as $d1)
                $dt1[] = $d[$d1];
            $dt[] = $dt1;
        }
        $jml = $this->jumlah_record_tabel($data['tabel']);
        $jml_filter = $this->jumlah_record_tabel_filter($data['tabel'], $data['kolom'], $cari['value']);
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $jml,
            "recordsFiltered" => $jml_filter,
            "data" => $dt
        );
        echo json_encode($output);
        exit();
    }
/* 
foreach ($provinces as $provinsi) {
       $options_provinsi[$provinsi->id] = $provinsi->nama;
}

and in view

$extra = null;
echo form_dropdown('provinsi', $options_provinsi, 'select_one', $extra);

---------------------------------
foreach($states as $state)
{
 $options[$state['id']] = $state['state']; 
 if($state['state'] = "New Jersey"){ //check id rather than name in case if edit
       $selected = $state['id']
    }

}

Then

echo form_dropdown('state', $options, $selected);
----------------------------------------
function form_dropdown($data = '', $options = array(), $selected = array(), $extra = '', $optionsExtra = array())
{
    $defaults = array();

    if (is_array($data))
    {
        if (isset($data['selected']))
        {
            $selected = $data['selected'];
            unset($data['selected']); // select tags don't have a selected attribute
        }

        if (isset($data['options']))
        {
            $options = $data['options'];
            unset($data['options']); // select tags don't use an options attribute
        }
    }
    else
    {
        $defaults = array('name' => $data);
    }

    is_array($selected) OR $selected = array($selected);
    is_array($options) OR $options = array($options);

    // If no selected state was submitted we will attempt to set it automatically
    if (empty($selected))
    {
        if (is_array($data))
        {
            if (isset($data['name'], $_POST[$data['name']]))
            {
                $selected = array($_POST[$data['name']]);
            }
        }
        elseif (isset($_POST[$data]))
        {
            $selected = array($_POST[$data]);
        }
    }

    $extra = _attributes_to_string($extra);

    $multiple = (count($selected) > 1 && stripos($extra, 'multiple') === FALSE) ? ' multiple="multiple"' : '';

    $form = '<select '.rtrim(_parse_form_attributes($data, $defaults)).$extra.$multiple.">\n";

    foreach ($options as $key => $val)
    {
        $key = (string) $key;

        if (is_array($val))
        {
            if (empty($val))
            {
                continue;
            }

            $form .= '<optgroup label="'.$key."\">\n";

            foreach ($val as $optgroup_key => $optgroup_val)
            {
                $sel = in_array($optgroup_key, $selected) ? ' selected="selected"' : '';

                // Changed to include $optionsExtra
                $form .= '<option value="'.html_escape($optgroup_key).'"'.$sel
                    .(isset($optionsExtra[$key][$optgroup_key]) ? _parse_form_attributes($optionsExtra[$key][$optgroup_key]) : '')
                    .'>'.(string) $optgroup_val."</option>\n";
            }
            $form .= "</optgroup>\n";
        } 
        else 
        {
            // Changed to include $optionsExtra
            $form .= '<option value="'.html_escape($key).'"'
                .(in_array($key, $selected) ? ' selected="selected"' : '')
                .(isset($optionsExtra[$key]) ? _parse_form_attributes($optionsExtra[$key]) : '')
                .'>'.(string) $val."</option>\n";
        }
    }

    return $form."</select>\n";
} 
	function getage($strdate) // dipakai di baca_radiologi
	{
		$dob = explode("-",$strdate);
		if(count($dob)!=3){return 0;}
		$y = $dob[0];$m = $dob[1];$d = $dob[2];
		if(strlen($y)!=4){return 0;}
		if(strlen($m)!=2){return 0;}
		if(strlen($d)!=2){return 0;}
		$y += 0;$m += 0;$d += 0;
		if($y==0) return 0;
		$rage = date("Y") - $y;
		if(date("m")<$m)
		{
		$rage-=1;
		}else{
		if((date("m")==$m)&&(date("d")<$d))
		{$rage-=1;}
		}
		return $rage;
	} */
// BEGIN SAMPLE
//(controller)
    // READ
/*     function index(){
        $data['product'] = $this->package_model->get_products();
        $data['package'] = $this->package_model->get_packages();
        $this->load->view('package_view',$data);
    }
    //CREATE
    function create(){
        $package = $this->input->post('package',TRUE);
        $product = $this->input->post('product',TRUE);
        $this->package_model->create_package($package,$product);
        redirect('package');
    }
    // GET DATA PRODUCT BERDASARKAN PACKAGE ID
    function get_product_by_package(){
        $package_id=$this->input->post('package_id');
        $data=$this->package_model->get_product_by_package($package_id)->result();
        foreach ($data as $result) {
            $value[] = (float) $result->product_id;
        }
        echo json_encode($value);
    }
    //UPDATE
    function update(){
        $id = $this->input->post('edit_id',TRUE);
        $package = $this->input->post('package_edit',TRUE);
        $product = $this->input->post('product_edit',TRUE);
        $this->package_model->update_package($id,$package,$product);
        redirect('package');
    }
    // DELETE
    function delete(){
        $id = $this->input->post('delete_id',TRUE);
        $this->package_model->delete_package($id);
        redirect('package');
    } */
// package_model
    // GET ALL PRODUCT
/*     function get_products(){
        $query = $this->db->get('product');
        return $query;
    }
    //GET PRODUCT BY PACKAGE ID
    function get_product_by_package($package_id){
        $this->db->select('*');
        $this->db->from('product');
        $this->db->join('detail', 'detail_product_id=product_id');
        $this->db->join('package', 'package_id=detail_package_id');
        $this->db->where('package_id',$package_id);
        $query = $this->db->get();
        return $query;
    }
    //READ
    function get_packages(){
        $this->db->select('package.*,COUNT(product_id) AS item_product');
        $this->db->from('package');
        $this->db->join('detail', 'package_id=detail_package_id');
        $this->db->join('product', 'detail_product_id=product_id');
        $this->db->group_by('package_id');
        $query = $this->db->get();
        return $query;
    }
    // CREATE
    function create_package($package,$product){
        $this->db->trans_start();
            //INSERT TO PACKAGE
            date_default_timezone_set("Asia/Bangkok");
            $data  = array(
                'package_name' => $package,
                'package_created_at' => date('Y-m-d H:i:s')
            );
            $this->db->insert('package', $data);
            //GET ID PACKAGE
            $package_id = $this->db->insert_id();
            $result = array();
                foreach($product AS $key => $val){
                     $result[] = array(
                      'detail_package_id'   => $package_id,
                      'detail_product_id'   => $_POST['product'][$key]
                     );
                }
            //MULTIPLE INSERT TO DETAIL TABLE
            $this->db->insert_batch('detail', $result);
        $this->db->trans_complete();
    }
    // UPDATE
    function update_package($id,$package,$product){
        $this->db->trans_start();
            //UPDATE TO PACKAGE
            $data  = array(
                'package_name' => $package
            );
            $this->db->where('package_id',$id);
            $this->db->update('package', $data);

            //DELETE DETAIL PACKAGE
            $this->db->delete('detail', array('detail_package_id' => $id));

            $result = array();
                foreach($product AS $key => $val){
                     $result[] = array(
                      'detail_package_id'   => $id,
                      'detail_product_id'   => $_POST['product_edit'][$key]
                     );
                }
            //MULTIPLE INSERT TO DETAIL TABLE
            $this->db->insert_batch('detail', $result);
        $this->db->trans_complete();
    }
    // DELETE
    function delete_package($id){
        $this->db->trans_start();
            $this->db->delete('detail', array('detail_package_id' => $id));
            $this->db->delete('package', array('package_id' => $id));
        $this->db->trans_complete();
    } */
// END SAMPLE
}
