<script type="text/javascript">
function Timer() {
   var hr = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
   var bl = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
   var dt=new Date()
   document.getElementById('timer_waktu').innerHTML=hr[dt.getDay()]+", "+dt.getDate()+" "+bl[dt.getMonth()]+" "+dt.getFullYear()+" ["+ dt.getHours()+":"+dt.getMinutes()+":"+dt.getSeconds()+"]";
   setTimeout("Timer()",1000);
}
Timer();
const dangerData = $('.danger-data').data('flashdata');
const suksesData = $('.sukses-data').data('flashdata');
if(suksesData) {
	swal({
		title: 'Sukses',
		text: suksesData,
		icon: "success",
	})
}
if(dangerData) {
	swal({
		title: 'Gagal',
		text: dangerData,
		icon: "error",
	})
}
const BASE_URL = "<?= base_url(); ?>";
<?php
//================================================= H O M E =================================================
if ($page=="home")
{
	//	Agar saat home tidak ke universal
?>

<?php
}
elseif ($page=="validasi")
{
?>
window.DT_BTN_ENUM = {
  colors: ['primary','secondary','success','danger','warning','info','dark'],
  variants: ['solid','outline','pastel'],
  shapes: ['','btn-pill','btn-square','btn-rounded-sm','btn-rounded-lg'],
  effects: ['','btn-soft-shadow','btn-glow','btn-ghost'],
  contents: ['text','icon','loading']
};
function mapColor(color, variant){
  if (variant === 'solid')   return `btn-${color}`;
  if (variant === 'outline') return `btn-outline-${color}`;
  if (variant === 'pastel')  return `btn-light-${color}`;
}
window.DT_BUTTON_POOL = (function(){

  const E = window.DT_BTN_ENUM;
  const pool = [];

  for (const color of E.colors) {
    for (const variant of E.variants) {
      for (const shape of E.shapes) {
        for (const effect of E.effects) {
          for (const content of E.contents) {

            pool.push({
              color,
              variant,
              shape,
              effect,
              content,
              className: [
                'btn','btn-xs',
                mapColor(color, variant),
                shape,
                effect,
                content === 'icon' ? 'btn-icon' : ''
              ].join(' ').trim()
            });

          }
        }
      }
    }
  }

  console.log('TOTAL BUTTON:', pool.length); // 3780
  return pool;

})();
window.DT_BUTTON_STYLE = (function(pool){

  const MODES = {
    RANDOM_ALL: 1,
    FIX_COLOR: 2,
    FIX_COLOR_SHAPE: 3,
    FIX_ALL: 4,
    RANDOM_NO_ROUND: 5,
    FIX_SHAPE: 6
  };

  function generate(opt = {}) {
    const mode = opt.mode ?? MODES.RANDOM_ALL;
    let list = pool;

    /* ===========================
       MODE FILTERING
       =========================== */

    // 2️⃣ FIX COLOR
    if ([MODES.FIX_COLOR, MODES.FIX_COLOR_SHAPE, MODES.FIX_ALL].includes(mode)) {
      if (opt.color)
        list = list.filter(b => b.color === opt.color);
    }

    // 3️⃣ FIX COLOR + SHAPE
    if ([MODES.FIX_COLOR_SHAPE, MODES.FIX_ALL].includes(mode)) {
      if (opt.shape)
        list = list.filter(b => b.shape === opt.shape);
    }

    // 5️⃣ RANDOM KECUALI BULAT
    if (mode === MODES.RANDOM_NO_ROUND) {
      list = list.filter(b => b.contents !== 'icon');
    }

    // 6️⃣ FIX SHAPE
    if (mode === MODES.FIX_SHAPE) {
      if (opt.shape)
        list = list.filter(b => b.shape === opt.shape);
    }

    // 4️⃣ FIX SEMUA
    if (mode === MODES.FIX_ALL) {
      list = list.filter(b =>
        (!opt.variant || b.variant === opt.variant) &&
        (!opt.effect  || b.effect  === opt.effect) &&
        (!opt.content || b.content === opt.content)
      );
    }

    if (!list.length) {
      console.warn('DT_BUTTON_STYLE: empty result', opt);
      return 'btn btn-sm btn-secondary';
    }

    /* ===========================
       PERSIST (DETERMINISTIC)
       =========================== */
    if (opt.persist && opt.key) {
      const k = 'dtbtn_' + opt.key;
      if (localStorage[k]) return localStorage[k];
      const cls = pick(list).className;
      localStorage[k] = cls;
      return cls;
    }

    return pick(list).className;
  }

  function pick(arr) {
    return arr[Math.floor(Math.random() * arr.length)];
  }

  return { generate, MODES };

})(window.DT_BUTTON_POOL);

window.DT_BUTTON_BY_INDEX = function(index){
  const pool = window.DT_BUTTON_POOL;
  const i = index - 1;

  if (i < 0 || i >= pool.length) {
    console.warn('Index out of range:', index);
    return 'btn btn-sm btn-secondary';
  }
  return pool[i].className;
};

function renderButtons(limit = 3780){
  const wrap = document.getElementById('dt-btn-playground');
  wrap.innerHTML = '';

  window.DT_BUTTON_POOL.slice(0, limit).forEach((b, i)=>{
    const btn = document.createElement('button');
    btn.className = b.className;
    btn.textContent = i + 1;
    btn.title = JSON.stringify(b, null, 1);
    wrap.appendChild(btn);
  });
}

function jumpToIndex(){
  const idx = parseInt(document.getElementById('jumpIndex').value);
  if (!idx) return;

  const wrap = document.getElementById('dt-btn-playground');
  wrap.innerHTML = '';

  const b = window.DT_BUTTON_POOL[idx - 1];
  if (!b) return;

  const btn = document.createElement('button');
  btn.className = b.className;
  btn.textContent = 'Button #' + idx;
  btn.style.fontSize = '16px';
  btn.style.padding = '10px 20px';

  wrap.appendChild(btn);
}
window.DT_BUTTON_RANDOM_NO_ICON = function () {
  const pool = window.DT_BUTTON_POOL
    .filter(b => b.content !== 'icon'); // ⛔ exclude icon

  const rand = pool[Math.floor(Math.random() * pool.length)];
  return rand.className;
};
function shuffle(array){
  const a = array.slice();
  for (let i = a.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [a[i], a[j]] = [a[j], a[i]];
  }
  return a;
}
function renderAllRandomNoIcon(){
  const wrap = document.getElementById('dt-btn-playground');
  wrap.innerHTML = '';

  const filtered = window.DT_BUTTON_POOL.filter(
    b => b.content !== 'icon'
  );

  const shuffled = shuffle(filtered);

  shuffled.forEach((b, i)=>{
    const btn = document.createElement('button');
    btn.className = b.className;
    btn.textContent = i + 1;
    btn.title =
      `#${i+1}\n` +
      `color=${b.color}\n` +
      `variant=${b.variant}\n` +
      `shape=${b.shape || 'default'}\n` +
      `effect=${b.effect || 'none'}\n` +
      `content=${b.content}`;

    wrap.appendChild(btn);
  });

  console.log('Rendered:', shuffled.length, 'buttons (NO ICON)');
}
function resolveEffect(opt){
  if (opt.context === 'datatable') {
    return core.rand(['','btn-soft-shadow']);
  }
  return core.rand(core.EFFECTS);
}
function build(opt, mode) {

  const color  = resolveColor(opt, mode);
  const shape  = resolveShape(opt, mode);
  const effect = core.rand(core.EFFECTS);
  let   size   = core.rand(core.SIZES);

  // 👇 KONDISI KHUSUS DATATABLE
  if (opt.context === 'datatable') {
    size = ''; // paksa ukuran kecil stabil
  }

  return [
    'btn',
    'btn-sm',
    'dt-btn',      // 👈 DITAMBAH DI SINI
    color,
    shape,
    effect,
    size,
    opt.iconOnly ? 'btn-icon' : ''
  ].join(' ').trim();
}

function debounce(fn, delay) {
    let t; return function () {
        clearTimeout(t);
        t = setTimeout(() => fn.apply(this, arguments), delay);
    };
}
$(function() {
    var table = $('#dttb').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        pagingType: "full_numbers",
        oLanguage: {
            sProcessing: "Memuat data...",
            sSearch: "Cari:",
            sLengthMenu: "Tampilkan _MENU_ baris",
            sInfo: "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
            sInfoEmpty: "Menampilkan 0 data",
            sInfoFiltered: "(difilter dari _MAX_ data)",
            sEmptyTable: "Tidak ada data",
            sZeroRecords: "Data tidak ditemukan",
            sInfoThousands: ".",

            oPaginate: {
                sFirst: "Awal",
                sPrevious: "Sebelumnya",
                sNext: "Selanjutnya",
                sLast: "Akhir"
            },

            // ===== SELECT TRANSLATION =====
            select: {
                rows: {
                    _: "%d baris terpilih",
                    0: "",
                    1: "1 baris terpilih"
                },
                columns: {
                    _: "%d kolom terpilih",
                    0: "",
                    1: "1 kolom terpilih"
                },
                cells: {
                    _: "%d sel terpilih",
                    0: "",
                    1: "1 sel terpilih"
                }
            }
        },
        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],        
        select: {
            style: 'single'
        },
        dom:
          "<'row mb-2'\
            <'col-12 dt-buttons-wrap d-flex flex-wrap'B>\
          >" +
          "<'row'<'col-12'tr>>" +
          "<'row mt-2 align-items-center'\
            <'col-md-5'i>\
            <'col-md-7 text-end'p>\
          >",
        ajax: {
            url: "<?= base_url() ?>ol_validasi/validasi/data",
            type : "POST"
        },
        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
        columns: [
                {
                    "className":      'dt-control',
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ''
                },
                { data: 'nama_pegawai' },
                { data: 'nip' },
                { data: 'nama_unit' },
                { data: 'nama_komite' }
        ],
        order: [[4,'asc'],[1,'asc']],
        initComplete: function () {
            var api = this.api();
            api.columns().every(function (i) {
                if (i === 0) return;
                $('input', this.footer()).on(
                    'keyup change',
                    debounce(() => {
                        this.search(this.footer().querySelector('input').value).draw();
                    }, 500)
                );
            });
        },
        buttons: [
  {
    text: '<i class="fa fa-th"></i> Playground',
    className: DT_BUTTON_STYLE.generate({
      mode: DT_BUTTON_STYLE.MODES.FIX_COLOR,
      color: 'info',
      iconOnly: false
    }),
    action: function () {
      togglePlayground();
    }
  },
        {
            text: '<i class="fa fa-check"></i> Validasi',
            extend: 'selected',
            className: DT_BUTTON_RANDOM_NO_ICON(),
            context: 'datatable',
            action: function ( e, dt, node, config ) {
                const r = dt.row({ selected: true }).data();
                location.href =
                    BASE_URL + 'ol_validasi/validasi/validasi/' + r.barcode_pegawai;
            }
        },
        {
            text: '<i class="fa fa-check"></i> Validasi',
            extend: 'selected',
            className: DT_BUTTON_BY_INDEX(397),
            context: 'datatable',
            action: function ( e, dt, node, config ) {
                const r = dt.row({ selected: true }).data();
                location.href =
                    BASE_URL + 'ol_validasi/validasi/validasi/' + r.barcode_pegawai;
            }
        },
{
  text: '<i class="fa fa-edit"></i>',
  className: DT_BUTTON_STYLE.generate({
    mode: DT_BUTTON_STYLE.MODES.FIX_ALL,
    color: 'warning',
    shape: 'btn-square',
    effect: 'btn-glow',
    iconOnly: true,
    persist: true,
    key: 'btn_edit_validasi'
  }),
  context: 'datatable',
  action: () => alert('EDIT')
},
        {
            text: '<i class="fa fa-sync"></i> Reload',
            className: DT_BUTTON_RANDOM_NO_ICON(),
            context: 'datatable',
            action: function (e, dt) {
                dt.ajax.reload(null, false);
            }
        }
        ]
    });
$('#dttb tbody').on('click', 'td.dt-control', function () {

    const tr  = $(this).closest('tr');
    const row = table.row(tr);
    const d   = row.data();

    // 1. TOGGLE CLOSE JIKA SUDAH OPEN
    if (row.child.isShown()) {
        row.child.hide();
        tr.removeClass('shown');
        return;
    }

    // 2. TUTUP ROW LAIN
    table.rows().every(function () {
        if (this.child.isShown()) {
            this.child.hide();
            $(this.node()).removeClass('shown');
        }
    });

    // 3. OPEN CHILD
    tr.addClass('shown');
    row.child(childTableHtml(d.barcode_pegawai)).show();

    // =================================================
    // 🔥 CEK: JIKA CHILD DATATABLE SUDAH ADA → RELOAD SAJA
    // =================================================
    const tableId = '#child-' + d.barcode_pegawai;

    if ($.fn.DataTable.isDataTable(tableId)) {
        $(tableId).DataTable().ajax.reload();
        return;
    }

    // =================================================
    // 4. INIT CHILD DATATABLE (PERTAMA KALI)
    // =================================================
    $(tableId).DataTable({
        processing: true,
        serverSide: true,
        paging: true,
        searching: true,
        lengthChange: false,
        pageLength: 5,
        ajax: {
            url: BASE_URL + 'ol_validasi/validasi/logbook',
            type: 'POST',
            data: {
                barcode_pegawai: d.barcode_pegawai
            }
        },
        columns: [
            { data: 'nama_kewenangan' },
            { data: 'nama_kompetensi' },
            { data: 'nama_sifat_kewenangan', searchable:false }
        ]
    });
});
function childTableHtml(id) {
    return `
        <div class="p-2 bg-light">
            <table class="table table-bordered table-sm table-hover w-100"
                   id="child-${id}">
                <thead>
                    <tr>
                        <th>Kewenangan</th>
                        <th>Kompetensi</th>
                        <th>Sifat Kewenangan</th>
                    </tr>
                </thead>
            </table>
        </div>
    `;
}
});
function togglePlayground(force) {
  const p = document.getElementById('dt-playground-panel');

  if (force === true) {
    p.style.display = 'block';
    return;
  }
  if (force === false) {
    p.style.display = 'none';
    return;
  }

  p.style.display = p.style.display === 'none' ? 'block' : 'none';
}

<?php
}
elseif ($page=="button"){
 /*
<button class="echo DT_BUTTON_STYLE.generate({ color:'success' }) ">
  Simpan
</button>
*/
?>

// random semua
DT_BUTTON_STYLE.generate();

{
  text:'<i class="fa fa-edit"></i>',
  className: DT_BUTTON_STYLE.generate(),
  action:()=>{}
}
// fix warna
DT_BUTTON_STYLE.generate({
  mode: DT_BUTTON_STYLE.MODES.FIX_COLOR,
  color: 'warning'
});

{
  text:'Edit',
  className: DT_BUTTON_STYLE.generate({
    mode: DT_BUTTON_STYLE.MODES.FIX_COLOR,
    color:'warning'
  })
}
// fix bentuk warna
DT_BUTTON_STYLE.generate({
  mode: DT_BUTTON_STYLE.MODES.FIX_COLOR_SHAPE,
  color: 'danger',
  shape: 'btn-square'
});

{
  text:'Edit',
  className: DT_BUTTON_STYLE.generate({
    mode: DT_BUTTON_STYLE.MODES.FIX_SHAPE,
    shape:'btn-pill'
  })
}
// fix semua
DT_BUTTON_STYLE.generate({
  mode: DT_BUTTON_STYLE.MODES.FIX_ALL,
  color:'info',
  variant:'outline',
  shape:'btn-rounded-lg',
  effect:'btn-soft-shadow',
  content:'icon',
  persist:true,
  key:'btn_edit'
});



{
  text:'<i class="fa fa-edit"></i>',
  className: DT_BUTTON_STYLE.generate({
    mode: DT_BUTTON_STYLE.MODES.FIX_BOTH,
    color:'success',
    shape:'btn-rounded-lg',
    iconOnly:true,
    persist:true,
    key:'btn_edit_validasi'
  })
}

// random semua kecuali pill
DT_BUTTON_STYLE.generate({
  mode: DT_BUTTON_STYLE.MODES.RANDOM_NO_ROUND
});

// random warna fixshape
DT_BUTTON_STYLE.generate({
  mode: DT_BUTTON_STYLE.MODES.FIX_SHAPE,
  shape:'btn-square'
});

// panggil button dengan index
DT_BUTTON_BY_INDEX(1024);
DT_BUTTON_BY_INDEX(1);
DT_BUTTON_BY_INDEX(3780);

<?php
}
elseif ($page=="validasi_validasi")
{
?>
    $(document).ready(function() {
        $('.select2').select2()
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
            "searching": false,
            "lengthChange": true,
            "pageLength": 10,
            "scrollX": true,
            "pagingType": "full_numbers",
            "oLanguage": {
                "sSearch": "Cari",
                "sLengthMenu": "Tampilkan _MENU_ baris",
                "sInfo": "Menampilkan _START_ s/d _END_ dari _TOTAL_ baris",
                "sInfoEmpty": "Total Record _TOTAL_",
                "sInfoFiltered": "(Filter dari _TOTAL_ Records)",
                "sEmptyTable": "Tidak ada data untuk ditampilkan",
                "sZeroRecords": "Tidak ada data yang sesuai",
                "sProcessing": "Loading... Mohon Tunggu",
                "sInfoThousands": "'",
                "oPaginate": {
                    "sFirst": "Awal",
                    "sPrevious": "Sebelumnya",
                    "sNext": "Selanjutnya",
                    "sLast": "Akhir"
                },
                "select": {
                    "cells": {
                        "0": "",
                        "1": "1 cell Terpilih",
                        "_": "%d cells Terpilih"
                    },
                    "columns": {
                        "0": "",
                        "1": "1 column Terpilih",
                        "_": "%d columns Terpilih"
                    },
                    "rows": {
                        "_": "%d rows Terpilih",
                        "0": "",
                    }
                },
            },
            "ajax": {
                "url"  : "<?php echo base_url();?>ol_validasi/validasi/logbook/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "nama_pegawai","searchable":false },
                      { "data": "nama_kewenangan","searchable":false },
                      { "data": "nama_kompetensi","searchable":false },
                      { "data": "nama_sifat_kewenangan","searchable":false, className: "text-center" }
            ],
            "order": [[2, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                  {
                    text: "<i class='fa fa-pencil'></i> Validasi",
                    extend: "selected",
                    className: "btnolive",
                      action: function ( e, dt, node, config ) { 
                       data1 = dt.rows( { selected: true } ).data()[0]['id_kewenangan'];
                       data2 = dt.rows( { selected: true } ).data()[0]['id_pegawai'];
                       data3 = dt.rows( { selected: true } ).data()[0]['id_sifat_kewenangan'];
                       $("#modal-default").modal();
                         $('.modal-body').load('<?php echo base_url('ol_validasi/validasi/rkk/'); ?>'+data1+'/'+data2+'/'+data3,function(){
                           $('#modal-default').modal({show:true});
                         });
                      }
                  },
                {
                    text: "<i class='fa fa-refresh'></i> Reload",
                    className: "btnReload",
                    action: function ( e, dt, node, config ) {
                        dt.ajax.reload();
                    }
                }
            ]
        });
        $(".dt-buttons").addClass("rapikan_tb_dtgrid");
        $(".btnnavy").removeClass("dt-button").addClass("btn bg-navy btn-sm");
        $(".btnyellow").removeClass("dt-button").addClass("btn bg-yellow btn-sm");
        $(".btnmaroon").removeClass("dt-button").addClass("btn bg-maroon btn-sm");
        $(".btnolive").removeClass("dt-button").addClass("btn bg-olive btn-sm");
        $(".btnpurple").removeClass("dt-button").addClass("btn bg-purple btn-sm");
        $(".btnred").removeClass("dt-button").addClass("btn bg-red btn-sm");
        $(".btnaqua").removeClass("dt-button").addClass("btn bg-aqua btn-sm");
        $(".btnlightblue").removeClass("dt-button").addClass("btn bg-light-blue btn-sm");
        $(".btnblue").removeClass("dt-button").addClass("btn bg-blue btn-sm");
        $(".btngreen").removeClass("dt-button").addClass("btn bg-green btn-sm");
        $(".btnteal").removeClass("dt-button").addClass("btn bg-teal btn-sm");
        $(".btnlime").removeClass("dt-button").addClass("btn bg-lime btn-sm");
        $(".btnorange").removeClass("dt-button").addClass("btn bg-orange btn-sm");
        $(".btnfuchsia").removeClass("dt-button").addClass("btn bg-fuchsia btn-sm");
        $(".btnReload").removeClass("dt-button").addClass("btn btn-success btn-sm");
    });
/*    function confirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href'); //use currentTarget because the click may be on the nested i tag and not a tag causing the href to be empty
        console.log(urlToRedirect); // verify if this is the right URL
        swal({
            title: "Apakah Anda Yakin Hapus Data",
            text: "Data Dapat Dipilih Kembali!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                // redirect with javascript here as per your logic after showing the alert using the urlToRedirect value
                window.location.href = urlToRedirect;
            } else {
                swal("Data Tidak Jadi Di Hapus");
            }
        });
    }*/
<?php  
}
?>
</script>
</body>
</html>
