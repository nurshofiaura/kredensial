<?php
class M_pcare extends CI_Model
{
    private function getKey(){
        $dtpcare = $this->m_umum->auth_pcare($this->session->refer);
        $consid = $dtpcare['cons_id'];
        $secretKey = $dtpcare['secret_key'];
        $userKey = $dtpcare['user_key'];
        $date = date("Y-m-d");
        date_default_timezone_set('UTC');
        $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));

		return $key = $consid.$secretKey.$tStamp;
	}

    // ================================================= Headers =============================================
    private function headers(){
        $dtpcare = $this->m_umum->auth_pcare($this->session->refer);
        $consid = $dtpcare['cons_id'];
        $secretKey = $dtpcare['secret_key'];
        $userKey = $dtpcare['user_key'];
        $date = date("Y-m-d");
        date_default_timezone_set('UTC');

        $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
        $signature = hash_hmac('sha256', $consid."&".$tStamp, $secretKey, true);
        $encodedSignature = base64_encode($signature);
        $urlencodedSignature = urlencode($encodedSignature);

        return $headers = array(
            'X-cons-id:'.$consid.'',
            'X-timestamp:'.$tStamp.'',
            'X-signature:'.$encodedSignature.'',
            'user_key:'.$userKey.'',
            'Content-Type:application/json'
        );
    }
    // ================================================= Headers =============================================

    // ================================================= cURL Get ============================================
    private function get_curl($endpoint) {
        $headers = $this->headers();

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$endpoint);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_TIMEOUT,3);
        curl_setopt($ch,CURLOPT_HTTPGET,1);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      
        $response = curl_exec($ch);

        curl_close($ch);

        $response = json_decode($response,true);
        if ($response['metaData']['code'] != 200){
            return $response;
        } else {
            return $response['response'];
        }
    }
    // ================================================= cURL Get ==============================================

    // ================================================= cURL Post =============================================
    private function post_curl($post,$endpoint) {
        $headers = $this->headers();

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$endpoint);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_TIMEOUT,3);
        curl_setopt($ch,CURLOPT_HTTPGET,1);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
      
        $response = curl_exec($ch);

        curl_close($ch);

        $response = json_decode($response,true);
        if ($response['metaData']['code'] != 200){
            return $response;
        } else {
            return $response['response'];
        }
    }
    // ================================================= cURL Post =============================================

    // ================================================= cURL PUT =============================================
    private function put_curl($post,$endpoint) {
        $headers = $this->headers();

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$endpoint);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_TIMEOUT,3);
        curl_setopt($ch,CURLOPT_HTTPGET,1);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
      
        $response = curl_exec($ch);

        curl_close($ch);

        $response = json_decode($response,true);
        if ($response['metaData']['code'] != 200){
            return $response;
        } else {
            return $response['response'];
        }
    }
    // ================================================= cURL PUT =============================================

    // ================================================= cURL Delete =============================================
    private function delete_curl($post,$endpoint) {
        $headers = $this->headers();

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$endpoint);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_TIMEOUT,3);
        curl_setopt($ch,CURLOPT_HTTPGET,1);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
      
        $response = curl_exec($ch);

        curl_close($ch);

        $response = json_decode($response,true);
        if ($response['metaData']['code'] != 200){
            return $response;
        } else {
            return $response['response'];
        }
    }
    // ================================================= cURL Delete =============================================

    // ================================================= Decrypt ===============================================
    private function stringDecrypt($key, $string){
        $encrypt_method = 'AES-256-CBC';
        $key_hash = hex2bin(hash('sha256', $key));
        $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);
        return $output;
    }

    private function decompress($string){
    //    return \LZCompressor\LZString::decompressFromEncodedURIComponent($string);
    }
    // ================================================= Decrypt ===============================================

    public function getData($endpoint){
        $data = $this->get_curl($endpoint);
        if (is_array($data) && array_key_exists('metaData',$data)) {
            if ($data['metaData']['code'] != 200){
                return json_encode($data);
            } 
        } else {
            $key = $this->getKey();
            $decrypt = $this->stringDecrypt($key, $data);
            $hasil_decrypt =  $this->decompress($decrypt);
            
            if ($hasil_decrypt != NULL) {
                return $hasil_decrypt;
            } else {
                $hasil = array (
                    'code' => 401,
                    'message' => 'Terjadi Kesalahan'
                );
                return json_encode($hasil);
            }
        } 
    }

    public function postData($storage, $endpoint){
        $data = $this->post_curl($storage, $endpoint);
        if (is_array($data) && array_key_exists('metaData',$data)) {
            if ($data['metaData']['code'] != 200){
                return json_encode($data);
            } 
        } else {
            $key = $this->getKey();

            $decrypt = $this->stringDecrypt($key, $data);
            $hasil_decrypt =  $this->decompress($decrypt);
            
            if ($hasil_decrypt != NULL) {
                return $hasil_decrypt;
            } else {
                $hasil = array (
                    'code' => 401,
                    'message' => 'Terjadi Kesalahan'
                );
                return json_encode($hasil);
            }
        }
    }

    public function putData($storage, $endpoint){
        $data = $this->put_curl($storage, $endpoint);
        if (is_array($data) && array_key_exists('metaData',$data)) {
            if ($data['metaData']['code'] != 200){
                return json_encode($data);
            } 
        } else {
            $key = $this->getKey();

            $decrypt = $this->stringDecrypt($key, $data);
            $hasil_decrypt =  $this->decompress($decrypt);
            
            if ($hasil_decrypt != NULL) {
                return $hasil_decrypt;
            } else {
                $hasil = array (
                    'code' => 401,
                    'message' => 'Terjadi Kesalahan'
                );
                return json_encode($hasil);
            }
        }
    }

    public function deleteData($storage, $endpoint){
        $data = $this->delete_curl($storage, $endpoint);
        if (is_array($data) && array_key_exists('metaData',$data)) {
            if ($data['metaData']['code'] != 200){
                return json_encode($data);
            } 
        } else {
            $key = $this->getKey();

            $decrypt = $this->stringDecrypt($key, $data);
            $hasil_decrypt =  $this->decompress($decrypt);
            
            if ($hasil_decrypt != NULL) {
                return $hasil_decrypt;
            } else {
                $hasil = array (
                    'code' => 401,
                    'message' => 'Terjadi Kesalahan'
                );
                return json_encode($hasil);
            }
        }
    }

    public function cek_post($storage){
        return json_encode($storage);
    }
}