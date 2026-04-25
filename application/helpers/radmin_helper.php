<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//======================================= ui
function input_pdselect2($name, $options, $selected = '', $attr = FALSE)
{
    // default attribute
    if ($attr === FALSE) {
        $attr = [];
    }

    // default id = name
    if (!isset($attr['id'])) {
        $attr['id'] = $name;
    }

    // default class select2
    if (!isset($attr['class'])) {
        $attr['class'] = 'form-control select2';
    }
/*    else {
        $attr['class'] .= ' select2';
    }*/

    echo form_dropdown($name, $options, $selected, $attr);
}

/*
// AUTO PLACEHOLDER
$attr = [
    'data-placeholder' => 'Pilih Bulan'
];
input_pdselect2('bulan', $cmd_bulan, '', $attr);

// multi select
$attr = [
    'id' => 'user_multi',
    'multiple' => 'multiple'
];
input_pdselect2('user_id[]', $users, [1,3], $attr);

// ajax select2
$attr = [
    'id' => 'customer',
    'class' => 'form-control select2-ajax',
    'data-url' => site_url('ajax/customer'),
    'data-placeholder' => 'Cari customer'
];
input_pdselect2('customer_id', [], '', $attr);

// DEPENDENT DROPDOWN (PARENT)
$attr = [
    'id' => 'provinsi_id',
    'data-child' => 'kota_id',
    'data-url' => site_url('ajax/get_kota'),
    'onchange' => 'loadKota(this)'
];
input_pdselect2('provinsi', $provinsi, '', $attr);

// DEPENDENT DROPDOWN (CHILD) / ID
$attr = [
    'id' => 'kota_id'
];
input_pdselect2('kota', [], '', $attr);

// FILTER LAPORAN (AUTO SUBMIT)
$attr = [
    'id' => 'tahun',
    'onchange' => 'filterLaporan()'
];
input_pdselect2('tahun', $cmd_tahun, date('Y'), $attr);

// DISABLED / READONLY / REQUIRED
$attr = [
    'id' => 'status',
    'disabled' => 'disabled',
    'required' => 'required'
];
input_pdselect2('status', $status, '1', $attr);

// CUSTOM CLASS
$attr = [
    'class' => 'form-control select2 select-sm'
];
input_pdselect2('bank', $bank, '', $attr);

----------------------- JS GLOBAL (SATU KALI SAJA) ----------------
<script>
$('.select2').select2({
    width: '100%',
    placeholder: function(){
        return $(this).data('placeholder') || 'Pilih data';
    },
    allowClear: true
});

$('.select2-ajax').each(function(){
    let el = $(this);
    el.select2({
        ajax: {
            url: el.data('url'),
            dataType: 'json',
            delay: 250,
            data: params => ({ q: params.term }),
            processResults: data => ({ results: data })
        },
        placeholder: el.data('placeholder'),
        allowClear: true
    });
});
</script>

1️⃣ AUTO-INIT JS PAKAI DATA-ATTRIBUTE (ZERO CONFIG JS)

🎯 Tujuan
- Tidak perlu JS per dropdown
- Semua behavior dikontrol lewat HTML attribute
- 1 JS global untuk semua halaman

✅ DATA-ATTRIBUTE STANDARD
-------------------------------------------
| Attribute            | Fungsi           |
| -------------------- | ---------------- |
| `data-select2`       | aktifkan select2 |
| `data-placeholder`   | placeholder      |
| `data-ajax-url`      | AJAX endpoint    |
| `data-parent`        | parent ID        |
| `data-child`         | child ID         |
| `data-tags`          | tagging          |
| `data-minimum-input` | min search       |
| `multiple`           | multi select     |
-------------------------------------------

🔹 JS GLOBAL (SATU FILE)
<script>
$(document).ready(function(){

    $('[data-select2]').each(function(){
        let el = $(this);

        let config = {
            width: '100%',
            placeholder: el.data('placeholder') || 'Pilih data',
            allowClear: true
        };

        // AJAX Select2
        if (el.data('ajax-url')) {
            config.ajax = {
                url: el.data('ajax-url'),
                dataType: 'json',
                delay: 250,
                data: params => ({ q: params.term }),
                processResults: data => ({ results: data }),
                cache: true
            };
            config.minimumInputLength = el.data('minimum-input') || 1;
        }

        // TAGGING
        if (el.data('tags')) {
            config.tags = true;
            config.tokenSeparators = [','];
        }

        el.select2(config);
    });

    // DEPENDENT DROPDOWN
    $('[data-parent]').on('change', function(){
        let parent = $(this);
        let child  = $('#' + parent.data('child'));

        $.post(parent.data('ajax-url'), { id: parent.val() }, function(res){
            child.html(res).trigger('change');
        });
    });

});
</script>

🔹 HELPER KHUSUS SELECT2 TAGGING
   Tanpa helper baru, cukup attr

$attr = [
    'data-select2' => '1',
    'data-tags' => '1',
    'data-placeholder' => 'Tambah tag'
];
input_pdselect2('tags[]', [], [], $attr);

✔ bisa input manual
✔ bisa multi value
✔ cocok untuk kategori, keyword, label
*/
/*function selectra(
    $name,
    $options = [],
    $selected = '',
    $empty_text = '-- Pilih Data --',
    $attr = []
) 
{
    if (!is_array($options)) {
        $options = [];
    }

    // default attribute
    $attr['name']  = $name;
    $attr['id']    = $attr['id']    ?? $name;
    $attr['class'] = $attr['class'] ?? 'form-control select2';

    echo '<select';
    foreach ($attr as $k => $v) {
        echo ' '.$k.'="'.$v.'"';
    }
    echo '>';

    // option empty / 0
    if ($empty_text !== FALSE) {
        echo '<option value="0">'.$empty_text.'</option>';
    }

    // looping data
    foreach ($options as $key => $val) {
        $is_selected = ($key == $selected) ? 'selected' : '';
        echo '<option value="'.$key.'" '.$is_selected.'>'.$val.'</option>';
    }

    echo '</select>';
}*/
function selectra(
    $name,
    $options = [],
    $selected = '',
    $empty_text = '-- Pilih Data --',
    $attr = []
) 
{
    if (!is_array($options)) {
        $options = [];
    }

    // ==============================
    // AUTO DETECT FORMAT
    // ==============================
    // Jika format result_array (array of array)
    if (!empty($options) && isset($options[0]) && is_array($options[0])) {

        $newOptions = [];

        foreach ($options as $row) {

            // auto detect id field
            $value = $row['id'] 
                ?? $row['id_'.$name] 
                ?? reset($row);

            // auto detect label field
            $label = $row['nama'] 
                ?? $row['name'] 
                ?? $row['nama_'.$name] 
                ?? end($row);

            $newOptions[$value] = $label;
        }

        $options = $newOptions;
    }

    // ==============================
    // DEFAULT ATTRIBUTE
    // ==============================
    $attr['name']  = $name;
    $attr['id']    = $attr['id']    ?? $name;
    $attr['class'] = $attr['class'] ?? 'form-control select2';

    echo '<select';
    foreach ($attr as $k => $v) {
        echo ' '.$k.'="'.$v.'"';
    }
    echo '>';

    if ($empty_text !== FALSE) {
        echo '<option value="0">'.$empty_text.'</option>';
    }

    foreach ($options as $key => $val) {
        $is_selected = ($key == $selected) ? 'selected' : '';
        echo '<option value="'.$key.'" '.$is_selected.'>'.$val.'</option>';
    }

    echo '</select>';
}


function selectracanmulti(
    $name,
    $options = [],        // array data dari db
    $selected = '',       // value default selected
    $empty_text = '-- Pilih Data --',
    $attr = [],
    $value_field = 'id'   // field yang ingin dijadikan <option value="">
) {
    if (!is_array($options)) {
        $options = [];
    }

    $attr['name']  = $name;
    $attr['id']    = $attr['id'] ?? $name;
    $attr['class'] = $attr['class'] ?? 'form-control select2';

    // multiple support
    $is_multiple = isset($attr['multiple']) && ($attr['multiple'] === true || $attr['multiple'] === 'multiple');
    if ($is_multiple && substr($attr['name'],-2)!=='[]') {
        $attr['name'] .= '[]';
    }

    // set_value auto
    $ci = &get_instance();
    if ($is_multiple) {
        $selected_values = set_value($name, $selected);
        if (!is_array($selected_values)) {
            $selected_values = [$selected_values];
        }
    } else {
        $selected_values = [set_value($name, $selected)];
    }

    echo '<select';
    foreach ($attr as $k=>$v) {
        if (is_bool($v) && $v===true) echo ' '.$k;
        else echo ' '.$k.'="'.$v.'"';
    }
    echo '>';

    if ($empty_text!==FALSE && !$is_multiple) {
        echo '<option value="0">'.$empty_text.'</option>';
    }

    // looping options
    foreach ($options as $row) {
        $value = isset($row[$value_field]) ? $row[$value_field] : '';
        $label = $row['nama'] ?? $row['name'] ?? $value;

        $is_selected = in_array((string)$value,array_map('strval',$selected_values)) ? 'selected' : '';
        echo '<option value="'.$value.'" '.$is_selected.'>'.$label.'</option>';
    }

    echo '</select>';
}

/*
selectra(
    'id_status_pegawai',
    $tipe_pegawai,   // dari model
    $selected_id,    // value terpilih
    'Pilih Status Pegawai'
);
selectra(
    'id_status_pegawai',
    $tipe_pegawai,
    $selected_id,
    FALSE
);
selectra(
    'id_status_pegawai',
    $tipe_pegawai,
    $selected_id,
    'Pilih Status Pegawai',
    [
        'required' => 'required',
        'data-placeholder' => 'Pilih Status'
    ]
);
// attr selectra bisa juga buat selectracanmulti
selectracanmulti(
    'hobi',
    ['1' => 'Menyanyi', '2' => 'Menari', '3' => 'Melukis'],
    ['1','3'],        // selected
    FALSE,            // tanpa empty option
    ['multiple' => true],
    'id_pegawai'    // gunakan id_pegawai sebagai value
);

$selected = ['1','3','5'];
selectracanmulti(
    'hobi',
    $hobi,
    $selected,        // selected
    FALSE,            // tanpa empty option
    ['multiple' => true],
    'id_hobi'    // gunakan id_pegawai sebagai value
);
*/

function inputra($name, $value = '', $attr = [])
{
    if ($attr === FALSE || !is_array($attr)) {
        $attr = [];
    }

    // ambil type dulu
    $type = $attr['type'] ?? 'text';
    unset($attr['type']); // type TIDAK boleh ikut ke textarea

    // mandatory
    $attr['name'] = $name;

    // default id
    if (!isset($attr['id'])) {
        $attr['id'] = $name;
    }

    // default class
    if (!isset($attr['class'])) {
        $attr['class'] = 'form-control';
    }

    // textarea
    if ($type === 'textarea') {
        return form_textarea($attr, set_value($name, $value));
    }

    // input biasa
    $attr['type']  = $type;
    $attr['value'] = set_value($name, $value);

    echo form_input($attr);
}
/*
Paling simpel
echo inputra('nama_pegawai', $nama_pegawai);

Override class & tambah atribut lain
echo inputra('nama_pegawai', $nama_pegawai, [
    'maxlength'   => 60,
    'autofocus'   => true,
    'required'    => true,
    'placeholder' => 'Nama Pegawai'
]);
echo inputra('email', $email, [
    'type'  => 'email',
    'class' => 'form-control is-valid'
]);
*/
/*

 // WRAPPER FUNCTIONS

function input_pdhidden($name, $value = '', $attr = FALSE)
{
    $attr['type'] = 'hidden';
    input_pd($name, $value, $attr);
}

function input_pdnumber($name, $value = '', $attr = FALSE)
{
    $attr['type'] = 'number';
    input_pd($name, $value, $attr);
}

function input_pdemail($name, $value = '', $attr = FALSE)
{
    $attr['type'] = 'email';
    input_pd($name, $value, $attr);
}

function input_pdpassword($name, $value = '', $attr = FALSE)
{
    $attr['type'] = 'password';
    input_pd($name, $value, $attr);
}

function input_pdfile($name, $value = '', $attr = FALSE)
{
    $attr['type'] = 'file';
    input_pd($name, $value, $attr);
}

function input_pddate($name, $value = '', $attr = FALSE)
{
    if ($attr === FALSE) $attr = [];

    $attr['type'] = 'text';

    if (!isset($attr['class'])) {
        $attr['class'] = 'form-control basic-date';
    } else {
        $attr['class'] .= ' basic-date';
    }

    if (!isset($attr['placeholder'])) {
        $attr['placeholder'] = 'YYYY-MM-DD';
    }

    input_pd($name, $value, $attr);
}

function input_pdtime($name, $value = '', $attr = FALSE)
{
    if ($attr === FALSE) $attr = [];

    $attr['type'] = 'text';

    if (!isset($attr['class'])) {
        $attr['class'] = 'form-control date-time-picker';
    } else {
        $attr['class'] .= ' date-time-picker';
    }

    if (!isset($attr['placeholder'])) {
        $attr['placeholder'] = '12:00';
    }

    input_pd($name, $value, $attr);
}

function input_pdtextarea($name, $value = '', $attr = FALSE)
{
    $attr['type'] = 'textarea';
    input_pd($name, $value, $attr);
}

function input_pdtel($name, $value = '', $attr = FALSE)
{
    $attr['type'] = 'tel';
    input_pd($name, $value, $attr);
}

function input_pdsearch($name, $value = '', $attr = FALSE)
{
    $attr['type'] = 'search';
    input_pd($name, $value, $attr);
}

function input_pdurl($name, $value = '', $attr = FALSE)
{
    $attr['type'] = 'url';
    input_pd($name, $value, $attr);
}

function input_pdcolor($name, $value = '', $attr = FALSE)
{
    $attr['type'] = 'color';
    input_pd($name, $value, $attr);
}

// =================================== contoh
Hidden
<?php input_pdhidden('id_user', $id_user); ?>

Number
<?php input_pdnumber('umur', $umur, [
    'min' => 0,
    'max' => 100
]); ?>

Email
<?php input_pdemail('email', $email, [
    'placeholder' => 'Email'
]); ?>

Password
<?php input_pdpassword('password', '', [
    'placeholder' => 'Password'
]); ?>

Date
<?php input_pddate('tgl_lahir', $tgl_lahir); ?>

Time
<?php input_pdtime('jam_mulai', $jam_mulai); ?>

Textarea
<?php input_pdtextarea('alamat', $alamat, [
    'rows' => 5,
    'placeholder' => 'Alamat lengkap'
]); ?>

Tel (No HP)
<?php input_pdtel('no_hp', $no_hp, [
    'placeholder' => '08xxxxxxxxxx'
]); ?>

Search
<?php input_pdsearch('keyword', '', [
    'placeholder' => 'Cari data...'
]); ?>

URL
<?php input_pdurl('website', $website, [
    'placeholder' => 'https://example.com'
]); ?>

Color
<?php input_pdcolor('warna', $warna ?? '#000000'); ?>
*/
//======================================= helper
/**
 * Helper universal untuk validasi field unik
 *
 * @param string $table      Nama tabel
 * @param array  $fields     Array field => value
 * @param bool   $return_html True = echo HTML langsung, false = return JSON
 */
function check_unique_field($table, $fields = [], $return_html = true)
{
    $ci = &get_instance();

    if (empty($fields) || !is_array($fields)) {
        $res = ['status' => 'error', 'message' => 'Data tidak valid.'];
    } else {
        $ci->db->from($table);
        $ci->db->where($fields);
        $count = (int) $ci->db->count_all_results();

        if ($count === 0) {
            $res = ['status' => 'success', 'message' => 'Data tersedia.'];
        } else {
            $res = ['status' => 'taken', 'message' => 'Data sudah ada.'];
        }
    }

    if ($return_html) {
        $color = $res['status'] === 'success' ? 'green' : 'red';
        echo "<span style='color:$color'>{$res['message']}</span>";
    } else {
        echo json_encode($res);
    }
}

/*
check_unique_field('users', [
    'username' => $username
]);


*/

function check_unique_custom($table, callable $query, $exclude_field = null, $exclude_id = null)
{
    $ci = &get_instance();

    $ci->db->from($table);

    // custom query builder
    $query($ci->db);

    // exclude untuk edit
    if ($exclude_field && $exclude_id) {
        $ci->db->where("$exclude_field !=", $exclude_id);
    }

    return $ci->db->count_all_results() == 0;
}

/*
$jabatan_allowed = explode(',', $this->session->userdata('id_jabatan')); 
// hasil: [1,2,3]

$isUnique = check_unique_custom('nkr_kompetensi', function($db) use ($kode_unit, $jabatan_allowed){
    $db->where('kode_unit', $kode_unit);
    $db->where_in('id_jabatan', $jabatan_allowed);
});

$isUnique = check_unique_custom('pegawai', function($db) use ($email, $no_hp){

    $db->group_start()
            ->where('email', $email)
            ->or_where('no_hp', $no_hp)
        ->group_end();

});
===========> WHERE (email='xxx' OR no_hp='yyy')

$isUnique = check_unique_custom('pegawai', function($db) use ($id_rs, $email, $no_hp){

    $db->where('id_rs', $id_rs);

    $db->group_start()
            ->where('email', $email)
            ->or_where('no_hp', $no_hp)
        ->group_end();

});
==========> WHERE id_rs=5 AND (email='a' OR no_hp='b')

$isUnique = check_unique_custom('jabatan', function($db) use ($nama){
    $db->where('nama_jabatan', $nama);
    $db->where_not_in('id_jabatan', [1]);
});
==========> Kasus: nama jabatan unik, tapi admin id 1 ga ikut dicek

$isUnique = check_unique_custom('nkr_kompetensi', function($db) use ($kode_unit, $id_jabatan){

    $db->where('kode_unit', $kode_unit);
    $db->where('id_jabatan', $id_jabatan);
    $db->where('status_kompetensi', 1);

});

$isUnique = check_unique_custom(
    'nkr_kewenangan',
    function($db) use ($id_kompetensi, $nama_kewenangan){
        $db->where('id_kompetensi', $id_kompetensi);
        $db->where('nama_kewenangan', $nama_kewenangan);
    },
    'id_kewenangan',
    $id_kewenangan
);

$isUnique = check_unique_custom(
    'nkr_kompetensi',
    function($db) use ($kode_unit, $nama_kompetensi, $jabatan_allowed){

        $db->where_in('id_jabatan', $jabatan_allowed);

        $db->group_start()
                ->where('kode_unit', $kode_unit)
                ->or_where('nama_kompetensi', $nama_kompetensi)
            ->group_end();
    },
    'id_kompetensi',
    $id_kompetensi
);
===============> WHERE id_jabatan IN (1,2,3) AND (kode_unit='X' OR nama_kompetensi='Y') AND id_kompetensi != 10

*/
function check_unique_field_edit($table, $fields = [], $exclude_field = null, $exclude_id = null)
{
    $ci = &get_instance();

    $ci->db->from($table);
    $ci->db->where($fields);

    if ($exclude_field && $exclude_id) {
        $ci->db->where("$exclude_field !=", $exclude_id);
    }

    return $ci->db->count_all_results() == 0;
}

/*
$isUnique = check_unique_field_edit(
    'jabatan',
    ['nama_jabatan' => $nama_jabatan],
    'id_jabatan',
    $id_jabatan
);
if(!$isUnique){
    echo "Nama jabatan sudah dipakai";
}

$isUnique = check_unique_field_edit(
    'nkr_kompetensi',
    [
        'kode_unit'  => $kode_unit,
        'id_jabatan' => $id_jabatan
    ],
    'id_kompetensi',
    $id_kompetensi
);

$isUnique = check_unique_field_edit(
    'nkr_kompetensi',
    ['kode_unit' => 'KUP-001'],
    'id_kompetensi',
    10
);

WHERE kode_unit='KUP-001'
AND id_kompetensi != 10
*/

if (!function_exists('swal_flashdata')) {
    /**
     * Menampilkan SweetAlert2 dari flashdata
     */
    function swal_flashdata($session = null)
    {
        $CI = get_instance();
        if (!$session) $session = $CI->session;

        $script = '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>' . PHP_EOL;
        $script .= '<script>document.addEventListener("DOMContentLoaded", function() {' . PHP_EOL;

        $alerts = [];

        // cek flashdata swal
        $custom = $session->flashdata('swal');
        if ($custom) {
            if (is_array($custom) && isset($custom[0])) {
                // multiple alerts
                foreach ($custom as $c) {
                    $alerts[] = [
                        'toast' => $c['toast'] ?? false,
                        'position' => ($c['toast'] ?? false) ? 'top-end' : 'center',
                        'icon'  => $c['status'] ?? 'info',
                        'title' => $c['title'] ?? '',
                        'text'  => $c['message'] ?? '',
                        'timer' => $c['timer'] ?? 2000,
                        'showConfirmButton' => ($c['toast'] ?? false) ? false : true
                    ];
                }
            } else {
                // single alert
                $alerts[] = [
                    'toast' => $custom['toast'] ?? false,
                    'position' => ($custom['toast'] ?? false) ? 'top-end' : 'center',
                    'icon'  => $custom['status'] ?? 'info',
                    'title' => $custom['title'] ?? '',
                    'text'  => $custom['message'] ?? '',
                    'timer' => $custom['timer'] ?? 2000,
                    'showConfirmButton' => ($custom['toast'] ?? false) ? false : true
                ];
            }
        }

        if (!empty($alerts)) {
            $script .= "let swalQueue = ".json_encode($alerts).";" . PHP_EOL;
            $script .= "
                (async function() {
                    for (let a of swalQueue) {
                        await Swal.fire(a);
                    }
                })();
            ";
        }

        $script .= '});</script>' . PHP_EOL;
        return $script;
    }
}

if (!function_exists('swal_response')) {
    /**
     * Response Swal untuk AJAX / NON-AJAX
     */
    function swal_response($params = [])
    {
        $CI =& get_instance();

        $payload = array_merge([
            'status'   => 'info',
            'title'    => '',
            'message'  => '',
            'toast'    => false,
            'timer'    => 2000,
            'reload'   => false,
            'redirect' => null,
            'data'     => null,
        ], $params);

        if ($CI->input->is_ajax_request()) {
            $CI->output
               ->set_content_type('application/json')
               ->set_output(json_encode($payload))
               ->_display();
            exit;
        }

        // fallback NON-AJAX
        $CI->session->set_flashdata('swal', $payload);
        if ($payload['redirect']) redirect($payload['redirect']);
    }
}
/*
js
$.post(url, data, function(res){

    Swal.fire({
        icon: res.status,
        title: res.title,
        text: res.message
    }).then(() => {
        if(res.reload) location.reload();
        if(res.redirect) window.location.href = res.redirect;
    });

}, 'json');
Swal.fire({
    icon: 'warning',
    title: 'Yakin?',
    text: 'Data akan dihapus permanen',
    showCancelButton: true,
    confirmButtonText: 'Ya, hapus!',
    cancelButtonText: 'Batal'
}).then((result) => {
    if(result.isConfirmed){
        // lanjut ajax delete
    }
});

controller
swal_response([
    'status'   => 'success',
    'title'    => 'Berhasil',
    'message'  => 'Data berhasil disimpan',
    'redirect' => base_url('ol_logbook/logbook')
]);
swal_response([
    'status'  => 'success',
    'title'   => 'Berhasil',
    'message' => 'Data berhasil dihapus',
    'reload'  => true
]);
swal_response([
    'status'  => 'warning',
    'title'   => 'Yakin?',
    'message' => 'Data akan dihapus permanen'
]);
swal_response([
    'status'  => 'warning',
    'title'   => 'Perhatian',
    'message' => 'Data sudah terdaftar'
]);
$this->session->set_flashdata('swal', [
    [
        'status' => 'success',
        'title'  => 'Berhasil',
        'message'=> 'Data utama tersimpan'
    ],
    [
        'status' => 'info',
        'title'  => 'Informasi',
        'message'=> 'Silakan lengkapi detail data'
    ]
]);

redirect(base_url('master/data'));
swal_response([
    'status'  => 'success',
    'title'   => 'Berhasil',
    'message' => 'Data berhasil disimpan',
    'reload'  => true
]);
*/
if (!function_exists('json_response_null')) {

    /**
     * JSON response khusus (ANTI bentrok swal_response)
     * Jangan pakai key: status,title,message,toast,timer,reload,redirect,data
     */
    function json_response_null($params = [], $httpCode = 200)
    {
        $CI =& get_instance();

        $payload = array_merge([
            'ok'      => true,
            'msg'     => '',
            'result'  => null,
            'errors'  => null,
        ], $params);

        $CI->output
           ->set_status_header($httpCode)
           ->set_content_type('application/json')
           ->set_output(json_encode($payload))
           ->_display();
        exit;
    }
}

/**
 * ============================================================
 * RA BUTTON HELPER (CI3) - OVERRIDE RANDOM COLOR
 * ============================================================
 * Semua tombol otomatis punya class ra-btn
 * Warna tidak ditentukan di PHP, tapi ditentukan oleh JS RA_BUTTON.init()
 */

/* =========================
   MAIN BUILDER
========================= */
if(!function_exists('ra_btn')){
    function ra_btn($text, $attr = [])
    {
        $icon = isset($attr['icon']) ? '<i class="'.$attr['icon'].'"></i> ' : '';

        // default class: TANPA warna (warna di-random JS)
        $class = "btn ra-btn";

        // user custom class
        if(isset($attr['class'])){
            $class .= " ".$attr['class'];
            unset($attr['class']);
        }

        // size helper (btn-sm, btn-md, btn-xs)
        if(isset($attr['data-size'])){
            $class .= " ".$attr['data-size'];
            unset($attr['data-size']);
        }

        $htmlAttr = "";
        foreach($attr as $k => $v){
            $htmlAttr .= $k.'="'.$v.'" ';
        }

        return '<button type="button" class="'.$class.'" '.$htmlAttr.'>'.$icon.$text.'</button>';
    }
}

/* =========================
   URL BUTTON (LINK)
========================= */
if(!function_exists('ra_btn_url')){
    function ra_btn_url($text, $url, $attr = [])
    {
        $icon = isset($attr['icon']) ? '<i class="'.$attr['icon'].'"></i> ' : '';

        // default class: TANPA warna (warna di-random JS)
        $class = "btn ra-btn";

        if(isset($attr['class'])){
            $class .= " ".$attr['class'];
            unset($attr['class']);
        }

        if(isset($attr['data-size'])){
            $class .= " ".$attr['data-size'];
            unset($attr['data-size']);
        }

        $htmlAttr = "";
        foreach($attr as $k => $v){
            $htmlAttr .= $k.'="'.$v.'" ';
        }

        return '<a href="'.$url.'" class="'.$class.'" '.$htmlAttr.'>'.$icon.$text.'</a>';
    }
}

/* =========================
   MODAL BUTTON
========================= */
if(!function_exists('ra_btn_modal')){
    function ra_btn_modal($text, $targetModalId, $attr = [])
    {
        $attr['data-bs-toggle'] = 'modal';
        $attr['data-bs-target'] = '#' . ltrim($targetModalId, '#');

        return ra_btn($text, $attr);
    }
}

/* =========================
   AJAX BUTTON
========================= */
if(!function_exists('ra_btn_ajax')){
    function ra_btn_ajax($text, $url, $attr = [])
    {
        $attr['data-ajax-url'] = $url;

        if(!isset($attr['data-method'])){
            $attr['data-method'] = 'POST';
        }

        if(!isset($attr['data-loading'])){
            $attr['data-loading'] = 'right';
        }

        return ra_btn($text, $attr);
    }
}

/*
<?= ra_btn_url("Detail", base_url("pegawai/detail/5"), [
    "icon" => "fa fa-eye",
    "data-size" => "btn-sm",
    "class" => "me-2"
]) ?>
//Modal
<?= ra_btn_modal("Tambah Data", "modalTambah", [
    "icon" => "fa fa-plus",
    "data-size" => "btn-sm"
]) ?>
//Ajax
<?= ra_btn_ajax("Hapus", base_url("pegawai/delete"), [
    "icon" => "fa fa-trash",
    "data-id" => 10,
    "data-confirm" => "Yakin hapus data ini?",
    "data-method" => "POST",
    "data-size" => "btn-sm"
]) ?>
//JS Handler untuk URL / Modal / AJAX
<script>
document.addEventListener("DOMContentLoaded", function () {

    // init random style
    RA_BUTTON.init();

    // AJAX handler
    document.body.addEventListener("click", function(e){

        const btn = e.target.closest(".ra-btn");
        if(!btn) return;

        const ajaxUrl = btn.dataset.ajaxUrl;
        if(!ajaxUrl) return;

        e.preventDefault();

        // confirm
        if(btn.dataset.confirm){
            if(!confirm(btn.dataset.confirm)){
                return;
            }
        }

        // start loading
        RA_BUTTON.loading(btn, "border", "right");

        // collect data attributes
        let payload = {};
        for(const key in btn.dataset){
            if(key.startsWith("param")){
                payload[key.replace("param","").toLowerCase()] = btn.dataset[key];
            }
        }

        // contoh ambil data-id
        if(btn.dataset.id){
            payload.id = btn.dataset.id;
        }

        const method = (btn.dataset.method || "POST").toUpperCase();

        fetch(ajaxUrl, {
            method: method,
            headers: {
                "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
            },
            body: new URLSearchParams(payload).toString()
        })
        .then(res => res.json())
        .then(res => {
            RA_BUTTON.stop(btn);

            alert(res.message || "Berhasil");

            // auto reload table
            if(btn.dataset.reload){
                location.reload();
            }
        })
        .catch(err => {
            RA_BUTTON.stop(btn);
            alert("Gagal: " + err);
        });

    });

});
</script>

| Attribute            | Contoh                         | Fungsi                   |
| -------------------- | ------------------------------ | ------------------------ |
| `data-size`          | `btn-sm` / `btn-md` / `btn-xs` | ukuran tombol            |
| `data-loading`       | `right`, `grow`, `icon`, `1`   | spinner loading auto     |
| `class`              | `me-2 w-100`                   | tambahan class bootstrap |
| `icon` (helper only) | `fa fa-trash`                  | icon otomatis            |
| Attribute | Contoh             | Fungsi        |
| --------- | ------------------ | ------------- |
| `href`    | `pegawai/detail/1` | untuk link    |
| `target`  | `_blank`           | buka tab baru |
| Attribute        | Contoh         | Fungsi        |
| ---------------- | -------------- | ------------- |
| `data-bs-toggle` | `modal`        | trigger modal |
| `data-bs-target` | `#modalTambah` | id modal      |
| Attribute       | Contoh            | Fungsi                        |
| --------------- | ----------------- | ----------------------------- |
| `data-ajax-url` | `/pegawai/delete` | URL tujuan AJAX               |
| `data-method`   | `POST` / `GET`    | method request                |
| `data-confirm`  | `"Yakin hapus?"`  | confirm sebelum ajax          |
| `data-id`       | `10`              | data id yang dikirim          |
| `data-reload`   | `1`               | setelah sukses reload halaman |

<?= ra_btn_ajax("Update", base_url("pegawai/update_status"), [
    "data-paramStatus" => "aktif",
    "data-paramRole"   => "admin",
    "data-confirm"     => "Aktifkan pegawai ini?"
]) ?>

<?= ra_btn_url("Detail", base_url("pegawai/detail/5"), [
    "icon" => "fa fa-eye",
    "data-size" => "btn-sm",
    "class" => "me-2"
]) ?>

<?= ra_btn_modal("Edit", "modalEditPegawai", [
    "icon" => "fa fa-edit",
    "data-size" => "btn-sm",
    "class" => "me-2"
]) ?>

<?= ra_btn_ajax("Hapus", base_url("pegawai/delete"), [
    "icon" => "fa fa-trash",
    "data-id" => 5,
    "data-confirm" => "Yakin hapus pegawai ini?",
    "data-reload" => 1,
    "data-size" => "btn-sm"
]) ?>

<?= ra_btn_ajax("Hapus", base_url("pegawai/delete"), [
    "icon" => "fa fa-trash",
    "data-id" => 10,
    "data-confirm" => "Yakin hapus pegawai ini?",
    "data-title" => "Konfirmasi Hapus",
    "data-success" => "Data berhasil dihapus!",
    "data-reload" => "datatable", 
    "data-table" => "#tablePegawai",
    "data-size" => "btn-sm"
]) ?>

Kalau kamu pakai DataTables, setelah redraw datatable, panggil lagi:
RA_BUTTON.init();

//JS Handler untuk URL / Modal / AJAX sweetalert2
<script>
document.addEventListener("DOMContentLoaded", function () {

    // init RA_BUTTON style
    RA_BUTTON.init();

    function raToast(icon, title){
        Swal.fire({
            toast: true,
            position: "top-end",
            icon: icon,
            title: title,
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true
        });
    }

    document.body.addEventListener("click", function(e){

        const btn = e.target.closest(".ra-btn");
        if(!btn) return;

        const ajaxUrl = btn.dataset.ajaxUrl;
        if(!ajaxUrl) return;

        e.preventDefault();

        const method = (btn.dataset.method || "POST").toUpperCase();

        const confirmText = btn.dataset.confirm || null;
        const confirmTitle = btn.dataset.title || "Konfirmasi";
        const successMsg = btn.dataset.success || "Berhasil!";
        const reloadMode = btn.dataset.reload || null;
        const redirectUrl = btn.dataset.redirect || null;
        const tableSelector = btn.dataset.table || null;

        // payload default
        let payload = {};

        // auto ambil semua data-id
        if(btn.dataset.id){
            payload.id = btn.dataset.id;
        }

        // ambil semua dataset param*
        for(const key in btn.dataset){
            if(key.startsWith("param")){
                let name = key.replace("param", "");
                name = name.charAt(0).toLowerCase() + name.slice(1);
                payload[name] = btn.dataset[key];
            }
        }

        // confirm sweetalert
        const doAjax = () => {
            RA_BUTTON.loading(btn, "border", "right");

            fetch(ajaxUrl, {
                method: method,
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
                },
                body: new URLSearchParams(payload).toString()
            })
            .then(res => res.json())
            .then(res => {

                RA_BUTTON.stop(btn);

                if(res.status === true || res.status === "true"){

                    // kalau server kasih message, pakai itu
                    let msg = res.message ? res.message : successMsg;

                    raToast("success", msg);

                    // reload mode
                    if(reloadMode === "page"){
                        setTimeout(() => location.reload(), 800);
                    }
                    else if(reloadMode === "datatable"){
                        if(tableSelector && window.jQuery){
                            const table = $(tableSelector).DataTable();
                            table.ajax.reload(null,false);
                        }
                    }

                    // redirect
                    if(redirectUrl){
                        setTimeout(() => window.location.href = redirectUrl, 800);
                    }

                }else{
                    let msg = res.message ? res.message : "Gagal!";
                    Swal.fire({
                        icon: "error",
                        title: "Oops!",
                        text: msg
                    });
                }

            })
            .catch(err => {
                RA_BUTTON.stop(btn);
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Request gagal: " + err
                });
            });
        };

        if(confirmText){
            Swal.fire({
                title: confirmTitle,
                text: confirmText,
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya",
                cancelButtonText: "Batal"
            }).then((result) => {
                if(result.isConfirmed){
                    doAjax();
                }
            });
        }else{
            doAjax();
        }

    });

});
</script>

public function delete()
{
    $id = $this->input->post('id');

    if(!$id){
        echo json_encode([
            "status" => false,
            "message" => "ID tidak ditemukan"
        ]);
        return;
    }

    $delete = $this->db->delete("pegawai", ["id_pegawai" => $id]);

    if($delete){
        echo json_encode([
            "status" => true,
            "message" => "Pegawai berhasil dihapus"
        ]);
    }else{
        echo json_encode([
            "status" => false,
            "message" => "Gagal menghapus data"
        ]);
    }
}

| Attribute      | Isi                        | Fungsi           |
| -------------- | -------------------------- | ---------------- |
| `data-size`    | `btn-xs / btn-sm / btn-md` | ukuran tombol    |
| `data-loading` | `right / grow / icon / 1`  | spinner otomatis |
| `class`        | bootstrap class            | tambahan styling |
| Attribute       | Contoh               | Fungsi                  |
| --------------- | -------------------- | ----------------------- |
| `data-ajax-url` | `/pegawai/delete`    | url request             |
| `data-method`   | `POST/GET`           | method request          |
| `data-id`       | `10`                 | id yg dikirim           |
| `data-confirm`  | `"Yakin hapus?"`     | confirm sweetalert      |
| `data-title`    | `"Konfirmasi Hapus"` | judul confirm           |
| `data-success`  | `"Berhasil!"`        | pesan sukses default    |
| `data-reload`   | `page/datatable`     | reload mode             |
| `data-table`    | `#tablePegawai`      | selector datatable      |
| `data-redirect` | `/pegawai`           | redirect setelah sukses |

<?= ra_btn_ajax("Approve", base_url("pegawai/approve"), [
   "data-paramStatus" => "approved",
   "data-paramLevel"  => "2"
]) ?>

🔥 Contoh Paling Real untuk DataTables
<?= ra_btn_ajax("Hapus", base_url("pegawai/delete"), [
    "icon" => "fa fa-trash",
    "data-id" => $row->id_pegawai,
    "data-confirm" => "Yakin hapus pegawai ini?",
    "data-title" => "Hapus Pegawai",
    "data-reload" => "datatable",
    "data-table" => "#tablePegawai"
]) ?>
*/
if (!function_exists('request')) {

    /**
     * Enterprise Request Helper v3
     *
     * $source : 'post' | 'get' | 'uri'
     * $key    : field name OR uri segment number
     * $type   : 'int' | 'string' | 'enum' | 'date' | 'bool'
     *
     * $options:
     *  required   => true/false
     *  default    => mixed
     *  enum       => array (required if type enum)
     *  format     => date format (default 'd-m-Y')
     *  cast       => 'int'|'string'|'bool' (force output type)
     *  strict     => true/false (default true)
     *  exception  => true/false (throw Exception instead of response)
     *  message    => custom error message
     */
    function request($source, $key, $type = 'string', $options = [])
    {
        $CI =& get_instance();

        $required  = $options['required']  ?? true;
        $default   = $options['default']   ?? null;
        $strict    = $options['strict']    ?? true;
        $exception = $options['exception'] ?? false;
        $message   = $options['message']   ?? "Input {$key} tidak valid";

        // ==========================
        // GET VALUE
        // ==========================
        switch ($source) {
            case 'post': $val = $CI->input->post($key, true); break;
            case 'get':  $val = $CI->input->get($key, true); break;
            case 'uri':  $val = $CI->uri->segment($key); break;
            default: _req_error("Invalid request source", 500, $exception);
        }

        // ==========================
        // EMPTY CHECK
        // ==========================
        if ($val === null || $val === '') {
            if (!$required) return $default;
            _req_error("Input {$key} wajib diisi", 400, $exception);
        }

        $val = trim((string) $val);

        // ==========================
        // TYPE VALIDATION
        // ==========================
        switch ($type) {

            case 'int':
                if (!ctype_digit($val)) {
                    _req_error($message ?: "Input {$key} harus angka", 400, $exception);
                }
                $val = (int) $val;
                break;

            case 'bool':
                if (!in_array($val, ['0','1','true','false'], true)) {
                    _req_error($message ?: "Input {$key} harus boolean", 400, $exception);
                }
                $val = in_array($val, ['1','true'], true);
                break;

            case 'enum':
                if (empty($options['enum']) || !is_array($options['enum'])) {
                    _req_error("Enum config salah", 500, $exception);
                }
                if (!in_array($val, $options['enum'], true)) {
                    _req_error($message ?: "Input {$key} tidak valid", 403, $exception);
                }
                break;

            case 'date':
                $format = $options['format'] ?? 'd-m-Y';
                $d = DateTime::createFromFormat($format, $val);
                if (!$d || $d->format($format) !== $val) {
                    _req_error($message ?: "Format tanggal {$key} tidak valid", 400, $exception);
                }
                $val = $d->format('Y-m-d'); // normalize
                break;

            case 'string':
            default:
                if ($strict && $val === '') {
                    _req_error($message, 400, $exception);
                }
                break;
        }

        // ==========================
        // FORCE CAST
        // ==========================
        if (!empty($options['cast'])) {
            switch ($options['cast']) {
                case 'int':  return (int) $val;
                case 'bool': return (bool) $val;
                case 'string': return (string) $val;
            }
        }

        return $val;
    }
}
/*
$first_date = request('uri', 4, 'date', [
    'required' => false,
    'format'   => 'd-m-Y'
]);

$last_date = request('uri', 5, 'date', [
    'required' => false,
    'format'   => 'd-m-Y'
]);
$opsi = request('uri', 6, 'enum', [
    'required' => false,
    'enum' => ['0','1']
]);

$range = request('uri', 7, 'enum', [
    'required' => false,
    'enum' => ['0','1']
]);
$limit = request('post', 'length', 'int', [
    'required' => false
]);
*/
// ==========================
// ERROR HANDLER TERINTEGRASI AJAX & SWAL
// ==========================
if (!function_exists('_req_error')) {
    function _req_error($message, $code = 400, $exception = false)
    {
        $CI =& get_instance();

        if ($exception) throw new Exception($message, $code);

        // ==========================
        // AJAX → JSON
        // ==========================
        if ($CI->input->is_ajax_request()) {
            if (function_exists('json_response_null')) {
                json_response_null([
                    'ok' => false,
                    'msg' => $message,
                    'errors' => [$message]
                ], $code);
            }

            echo json_encode(['ok' => false, 'msg' => $message]);
            exit;
        }

        // ==========================
        // Non-AJAX → Swal
        // ==========================
        if (function_exists('swal_response')) {
            swal_response([
                'status'  => 'error',
                'title'   => 'Validasi Gagal',
                'message' => $message,
                'reload'  => false
            ]);
        }

        // fallback ultimate
        show_error($message, $code);
    }
}
function selectra_ajax(
    $name,
    $url,
    $selected_text = '',
    $selected_id = '',
    $placeholder = '-- Cari Data --',
    $limit = 20,
    $attr = []
) {

    $attr['name']  = $name;
    $attr['id']    = $attr['id'] ?? $name;
    $attr['class'] = $attr['class'] ?? 'form-control select2-ajax';
?>
<select 
<?php foreach ($attr as $k => $v): ?>
    <?= $k ?>="<?= $v ?>"
<?php endforeach; ?>
style="width:100%"
>
<?php if(!empty($selected_id)): ?>
<option value="<?= $selected_id ?>" selected>
    <?= $selected_text ?>
</option>
<?php endif; ?>
</select>

<script>
(function(){

let el = $('#<?= $attr['id'] ?>');

// ============================
// AUTO DETECT MODAL
// ============================
let modalParent = el.closest('.modal');

let config = {

    placeholder: "<?= $placeholder ?>",
    allowClear: true,
    width: '100%',

    minimumInputLength: 0, // Ubah dari 2 ke 0

    ajax: {
        url: "<?= $url.'/'.$limit ?>",
        dataType: 'json',
        delay: 400,
        cache: true,

        data: function (params) {
            return {
                q: params.term || '',
                page: params.page || 1
            };
        },

        processResults: function (data, params) {

            params.page = params.page || 1;

            return {
                results: data.results,
                pagination: {
                    more: data.pagination.more
                }
            };
        }
    }
};

// kalau di dalam modal → tambahkan dropdownParent
if (modalParent.length) {
    config.dropdownParent = modalParent;
}

el.select2(config);

})();
</script>

<?php
}
if (!function_exists('badge_status')) {
    /**
     * @param string|int $value  Nilai status dari database
     * @param string     $type   Kategori status (pengajuan, aktifasi, dll)
     * @return string    HTML Badge
     */
    function badge_status($value, $type = 'pengajuan') {
        // Daftar semua konfigurasi status di aplikasi Anda
        $config = [
            'pengajuan' => [
                '0' => ['label' => 'REGISTRASI', 'class' => 'bg-warning'],
                '1' => ['label' => 'PROSES',     'class' => 'bg-info'],
                '2' => ['label' => 'SELESAI',    'class' => 'bg-primary'],
                '3' => ['label' => 'RKK',        'class' => 'bg-success'],
                'default' => ['label' => 'DITOLAK', 'class' => 'bg-danger']
            ],
            'aktifasi' => [
                '1' => ['label' => 'AKTIF',      'class' => 'bg-success'],
                'default' => ['label' => 'NON AKTIF', 'class' => 'bg-danger']
            ],
            'verifikasi' => [
                'Y' => ['label' => 'VERIFIED',   'class' => 'bg-success'],
                'N' => ['label' => 'PENDING',    'class' => 'bg-warning'],
                'default' => ['label' => 'WAITING', 'class' => 'bg-secondary']
            ]
        ];

        // Ambil grup berdasarkan tipe
        $group = $config[$type] ?? $config['pengajuan'];

        // Ambil detail berdasarkan value, jika tidak ada pakai default
        $res = $group[$value] ?? $group['default'];

        return '<span class="badge ' . $res['class'] . '">' . $res['label'] . '</span>';
    }
}