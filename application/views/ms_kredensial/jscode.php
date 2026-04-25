<script type="text/javascript">
function Timer() {
   var hr = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
   var bl = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
   var dt=new Date()
   document.getElementById('timer_waktu').innerHTML=hr[dt.getDay()]+", "+dt.getDate()+" "+bl[dt.getMonth()]+" "+dt.getFullYear()+" ["+ dt.getHours()+":"+dt.getMinutes()+":"+dt.getSeconds()+"]";
   setTimeout("Timer()",1000);
}
Timer();
//============================================ harusnya di script tapi disini saja supaya cuma halaman ini
const RA_BUTTON = {

    colors: [
        "btn-primary",
        "btn-secondary",
        "btn-success",
        "btn-danger",
        "btn-warning",
        "btn-info",
        "btn-dark"
    ],

    init: function () {

        $(".ra-btn").each(function () {

            // hapus semua warna bootstrap lama
            $(this).removeClass(
                "btn-primary btn-secondary btn-success btn-danger btn-warning btn-info btn-dark " +
                "btn-outline-primary btn-outline-secondary btn-outline-success btn-outline-danger btn-outline-warning btn-outline-info btn-outline-dark"
            );

            // random color
            let randomColor = RA_BUTTON.colors[Math.floor(Math.random() * RA_BUTTON.colors.length)];

            // apply
            $(this).addClass(randomColor);

        });

    }
};

//============================================
<?php
//================================================= H O M E =================================================
if ($page=="home")  
{
	//	Agar saat home tidak ke universal
?>

<?php
}
elseif ($page=="kompetensi")  
{
?>
function debounce(fn, delay) {
    let t; return function () {
        clearTimeout(t);
        t = setTimeout(() => fn.apply(this, arguments), delay);
    };
}
$(document).ready(function(){
  let table = $('#dttb').DataTable({
      processing: true,
      serverSide: true,
      searching: true,
      ordering: true,
      pageLength: 10,
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
      ajax: {
          url: "<?= base_url('master_kredensial/kompetensi/data_kompetensi') ?>",
          type: "POST"
      },
      select: {
          style: 'single',
          selector: 'td:not(.dt-control)'
      },
      order: [[1, "desc"]],
      lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
      dom:
        "<'row mb-2'\
          <'col-md-6'l>\
          <'col-md-6 text-end'B>\
        >" +
        "rt" +
        "<'row mt-2'\
          <'col-md-5'i>\
          <'col-md-7 text-end'p>\
        >",
      columns: [
          { data: "kode_unit" },
          { data: "nama_kompetensi" },
          { data: "nama_jabatan" },
          { data: "status_bagde" }
      ],
        createdRow: function(row, data, dataIndex){

            let warna_dttb = [
              "table-primary",
              "table-secondary",
              "table-success",
              "table-danger",
              "table-warning",
              "table-info",
              "table-light",
              "table-dark"
            ];

/*            let idx = dataIndex % warna_dttb.length;

            $(row).addClass(warna_dttb[idx]);*/
          let id = parseInt(data.id_kompetensi);
          let idx = id % warna_dttb.length;
          $(row).addClass(warna_dttb[idx]);
        },
initComplete: function () {
    const api = this.api();

    api.columns().every(function (colIdx) {

    //    if (colIdx === 0 || colIdx === 1) return;

        let that = this;

        $('input', this.footer()).on('keyup change', debounce(function () {
            that.search(this.value).draw();
        }, 500));
    });
  //  RA_BUTTON.init();
},
        buttons: [
/*          {
              text: 'Export Excel',
              className: 'ra-btn',
              action: function () {
                  alert("Export Excel jalan");
              }
          }*/
        ]
  });
  window.tableLogbook = table;
  RA_BUTTON.init();
    const modalEl = document.getElementById("modal-default");
    const raModal = new bootstrap.Modal(modalEl);

    function getSelectedRow() {
        return table.row({ selected: true }).data() || null;
    }
    function openRaModal({ title, url, method = "GET", params = {} }) {

        $("#raModalTitle").text(title);

        $("#raModalBody").html(`
            <div class="text-center py-4">
                <div class="spinner-border text-primary"></div>
                <div class="mt-2">Memuat...</div>
            </div>
        `);

        raModal.show();

        $.ajax({
            url: url,
            type: method,
            data: params,
            success: function (res) {
                $("#raModalBody").html(res);
                RA_BUTTON.init();
            },
            error: function () {
                $("#raModalBody").html(`
                    <div class="alert alert-danger">
                        Gagal memuat data
                    </div>
                `);
            }
        });
    }
	$(document).on("click", ".ra-btn[data-modal-url]", function (e) {

	    e.preventDefault();
	 //   if (!modalUrl) return true;
	    let $btn = $(this);

	    let modalUrl      = $btn.data("modal-url");
	    let modalTitle    = $btn.data("modal-title") || "Modal";
	    let method        = ($btn.data("modal-method") || "GET").toUpperCase();
	    let requireSelect = $btn.data("require-select");

	    if (!modalUrl) return;

	    let params = {};

	    // =============================
	    // Jika butuh row terpilih
	    // =============================
	    if (requireSelect) {

	        let row = getSelectedRow();

	        if (!row) {
	            Swal.fire("Info", "Pilih data dulu!", "warning");
	            return;
	        }

	        // kirim seluruh data row
	        params = { ...row };
	    }

	    // =============================
	    // Optional: ambil parameter tambahan dari tombol
	    // =============================
	    if ($btn.data("extra")) {
	        try {
	            let extraParams = JSON.parse($btn.attr("data-extra"));
	            params = { ...params, ...extraParams };
	        } catch (e) {
	            console.warn("Format data-extra salah (harus JSON)");
	        }
	    }

	    openRaModal({
	        title: modalTitle,
	        url: modalUrl,
	        method: method,
	        params: params
	    });

	});
});	
<?php
}
elseif ($page=="kewenangan")  
{
?>
function debounce(fn, delay) {
    let t; return function () {
        clearTimeout(t);
        t = setTimeout(() => fn.apply(this, arguments), delay);
    };
}
$(document).ready(function(){
  let table = $('#dttb').DataTable({
      processing: true,
      serverSide: true,
      searching: true,
      ordering: true,
      pageLength: 10,
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
      ajax: {
          url: "<?= base_url('master_kredensial/kewenangan/data_kewenangan') ?>",
          type: "POST"
      },
      select: {
          style: 'single',
          selector: 'td:not(.dt-control)'
      },
      order: [[1, "desc"]],
      lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
      dom:
        "<'row mb-2'\
          <'col-md-6'l>\
          <'col-md-6 text-end'B>\
        >" +
        "rt" +
        "<'row mt-2'\
          <'col-md-5'i>\
          <'col-md-7 text-end'p>\
        >",
      columns: [
          { data: "kode_unit" },
          { data: "nama_kompetensi" },
          { data: "nama_kewenangan" },
          { data: "nama_jabatan" },
          { data: "status_badge" }
      ],
        createdRow: function(row, data, dataIndex){

            let warna_dttb = [
              "table-primary",
              "table-secondary",
              "table-success",
              "table-danger",
              "table-warning",
              "table-info",
              "table-light",
              "table-dark"
            ];

/*            let idx = dataIndex % warna_dttb.length;

            $(row).addClass(warna_dttb[idx]);*/
          let id = parseInt(data.id_kompetensi);
          let idx = id % warna_dttb.length;
          $(row).addClass(warna_dttb[idx]);
        },
initComplete: function () {
    const api = this.api();

    api.columns().every(function (colIdx) {

    //    if (colIdx === 0 || colIdx === 1) return;

        let that = this;

        $('input', this.footer()).on('keyup change', debounce(function () {
            that.search(this.value).draw();
        }, 500));
    });
  //  RA_BUTTON.init();
},
        buttons: [
/*          {
              text: 'Export Excel',
              className: 'ra-btn',
              action: function () {
                  alert("Export Excel jalan");
              }
          }*/
        ]
  });
  window.tableLogbook = table;
  RA_BUTTON.init();
    const modalEl = document.getElementById("modal-default");
    const raModal = new bootstrap.Modal(modalEl);

    function getSelectedRow() {
        return table.row({ selected: true }).data() || null;
    }
    function openRaModal({ title, url, method = "GET", params = {} }) {

        $("#raModalTitle").text(title);

        $("#raModalBody").html(`
            <div class="text-center py-4">
                <div class="spinner-border text-primary"></div>
                <div class="mt-2">Memuat...</div>
            </div>
        `);

        raModal.show();

        $.ajax({
            url: url,
            type: method,
            data: params,
            success: function (res) {
                $("#raModalBody").html(res);
                RA_BUTTON.init();
            },
            error: function () {
                $("#raModalBody").html(`
                    <div class="alert alert-danger">
                        Gagal memuat data
                    </div>
                `);
            }
        });
    }
	$(document).on("click", ".ra-btn[data-modal-url]", function (e) {

	    e.preventDefault();
	 //   if (!modalUrl) return true;
	    let $btn = $(this);

	    let modalUrl      = $btn.data("modal-url");
	    let modalTitle    = $btn.data("modal-title") || "Modal";
	    let method        = ($btn.data("modal-method") || "GET").toUpperCase();
	    let requireSelect = $btn.data("require-select");

	    if (!modalUrl) return;

	    let params = {};

	    // =============================
	    // Jika butuh row terpilih
	    // =============================
	    if (requireSelect) {

	        let row = getSelectedRow();

	        if (!row) {
	            Swal.fire("Info", "Pilih data dulu!", "warning");
	            return;
	        }

	        // kirim seluruh data row
	        params = { ...row };
	    }

	    // =============================
	    // Optional: ambil parameter tambahan dari tombol
	    // =============================
	    if ($btn.data("extra")) {
	        try {
	            let extraParams = JSON.parse($btn.attr("data-extra"));
	            params = { ...params, ...extraParams };
	        } catch (e) {
	            console.warn("Format data-extra salah (harus JSON)");
	        }
	    }

	    openRaModal({
	        title: modalTitle,
	        url: modalUrl,
	        method: method,
	        params: params
	    });

	});
});	
<?php
}
elseif ($page=="grade")  
{
?>
function debounce(fn, delay) {
    let t; return function () {
        clearTimeout(t);
        t = setTimeout(() => fn.apply(this, arguments), delay);
    };
}
$(document).ready(function(){
  let table = $('#dttb').DataTable({
      processing: true,
      serverSide: true,
      searching: true,
      ordering: true,
      pageLength: 10,
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
      ajax: {
          url: "<?= base_url('master_kredensial/grade/data_grade') ?>",
          type: "POST"
      },
      select: {
          style: 'single',
          selector: 'td:not(.dt-control)'
      },
      order: [[1, "desc"]],
      lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
      dom:
        "<'row mb-2'\
          <'col-md-6'l>\
          <'col-md-6 text-end'B>\
        >" +
        "rt" +
        "<'row mt-2'\
          <'col-md-5'i>\
          <'col-md-7 text-end'p>\
        >",
      columns: [
          { data: "urutan_grade" },
          { data: "nama_grade" },
          { data: "nama_jabatan" }
      ],
        createdRow: function(row, data, dataIndex){

            let warna_dttb = [
              "table-primary",
              "table-secondary",
              "table-success",
              "table-danger",
              "table-warning",
              "table-info",
              "table-light",
              "table-dark"
            ];

/*            let idx = dataIndex % warna_dttb.length;

            $(row).addClass(warna_dttb[idx]);*/
          let id = parseInt(data.id_grade);
          let idx = id % warna_dttb.length;
          $(row).addClass(warna_dttb[idx]);
        },
initComplete: function () {
    const api = this.api();

    api.columns().every(function (colIdx) {

    //    if (colIdx === 0 || colIdx === 1) return;

        let that = this;

        $('input', this.footer()).on('keyup change', debounce(function () {
            that.search(this.value).draw();
        }, 500));
    });
  //  RA_BUTTON.init();
},
        buttons: [
/*          {
              text: 'Export Excel',
              className: 'ra-btn',
              action: function () {
                  alert("Export Excel jalan");
              }
          }*/
        ]
  });
  window.tableLogbook = table;
  RA_BUTTON.init();
    const modalEl = document.getElementById("modal-default");
    const raModal = new bootstrap.Modal(modalEl);

    function getSelectedRow() {
        return table.row({ selected: true }).data() || null;
    }
    function openRaModal({ title, url, method = "GET", params = {} }) {

        $("#raModalTitle").text(title);

        $("#raModalBody").html(`
            <div class="text-center py-4">
                <div class="spinner-border text-primary"></div>
                <div class="mt-2">Memuat...</div>
            </div>
        `);

        raModal.show();

        $.ajax({
            url: url,
            type: method,
            data: params,
            success: function (res) {
                $("#raModalBody").html(res);
                RA_BUTTON.init();
            },
            error: function () {
                $("#raModalBody").html(`
                    <div class="alert alert-danger">
                        Gagal memuat data
                    </div>
                `);
            }
        });
    }
    $(document).on("click", ".ra-btn[data-modal-url]", function (e) {

        e.preventDefault();
     //   if (!modalUrl) return true;
        let $btn = $(this);

        let modalUrl      = $btn.data("modal-url");
        let modalTitle    = $btn.data("modal-title") || "Modal";
        let method        = ($btn.data("modal-method") || "GET").toUpperCase();
        let requireSelect = $btn.data("require-select");

        if (!modalUrl) return;

        let params = {};

        // =============================
        // Jika butuh row terpilih
        // =============================
        if (requireSelect) {

            let row = getSelectedRow();

            if (!row) {
                Swal.fire("Info", "Pilih data dulu!", "warning");
                return;
            }

            // kirim seluruh data row
            params = { ...row };
        }

        // =============================
        // Optional: ambil parameter tambahan dari tombol
        // =============================
        if ($btn.data("extra")) {
            try {
                let extraParams = JSON.parse($btn.attr("data-extra"));
                params = { ...params, ...extraParams };
            } catch (e) {
                console.warn("Format data-extra salah (harus JSON)");
            }
        }

        openRaModal({
            title: modalTitle,
            url: modalUrl,
            method: method,
            params: params
        });

    });
}); 
<?php
}
elseif ($page=="area_klinis")  
{
?>
function debounce(fn, delay) {
    let t; return function () {
        clearTimeout(t);
        t = setTimeout(() => fn.apply(this, arguments), delay);
    };
}
$(document).ready(function(){
  let table = $('#dttb').DataTable({
      processing: true,
      serverSide: true,
      searching: true,
      ordering: true,
      pageLength: 10,
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
      ajax: {
          url: "<?= base_url('master_kredensial/area_klinis/data_area_klinis') ?>",
          type: "POST"
      },
      select: {
          style: 'single',
          selector: 'td:not(.dt-control)'
      },
      order: [[0, "desc"]],
      lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
      dom:
        "<'row mb-2'\
          <'col-md-6'l>\
          <'col-md-6 text-end'B>\
        >" +
        "rt" +
        "<'row mt-2'\
          <'col-md-5'i>\
          <'col-md-7 text-end'p>\
        >",
      columns: [
          { data: "nama_area_klinis" }
      ],
createdRow: function(row, data, dataIndex){
    const warna = [
      "table-primary",
      "table-secondary",
      "table-success",
      "table-danger",
      "table-warning",
      "table-info"
    ];
    $(row).addClass(warna[dataIndex % warna.length]);
},
initComplete: function () {
    const api = this.api();

    api.columns().every(function (colIdx) {

    //    if (colIdx === 0 || colIdx === 1) return;

        let that = this;

        $('input', this.footer()).on('keyup change', debounce(function () {
            that.search(this.value).draw();
        }, 500));
    });
  //  RA_BUTTON.init();
},
        buttons: [
/*          {
              text: 'Export Excel',
              className: 'ra-btn',
              action: function () {
                  alert("Export Excel jalan");
              }
          }*/
        ]
  });
  window.tableLogbook = table;
  RA_BUTTON.init();
    const modalEl = document.getElementById("modal-default");
    const raModal = new bootstrap.Modal(modalEl);

    function getSelectedRow() {
        return table.row({ selected: true }).data() || null;
    }
    function openRaModal({ title, url, method = "GET", params = {} }) {

        $("#raModalTitle").text(title);

        $("#raModalBody").html(`
            <div class="text-center py-4">
                <div class="spinner-border text-primary"></div>
                <div class="mt-2">Memuat...</div>
            </div>
        `);

        raModal.show();

        $.ajax({
            url: url,
            type: method,
            data: params,
            success: function (res) {
                $("#raModalBody").html(res);
                RA_BUTTON.init();
            },
            error: function () {
                $("#raModalBody").html(`
                    <div class="alert alert-danger">
                        Gagal memuat data
                    </div>
                `);
            }
        });
    }
    $(document).on("click", ".ra-btn[data-modal-url]", function (e) {

        e.preventDefault();
     //   if (!modalUrl) return true;
        let $btn = $(this);

        let modalUrl      = $btn.data("modal-url");
        let modalTitle    = $btn.data("modal-title") || "Modal";
        let method        = ($btn.data("modal-method") || "GET").toUpperCase();
        let requireSelect = $btn.data("require-select");

        if (!modalUrl) return;

        let params = {};

        // =============================
        // Jika butuh row terpilih
        // =============================
        if (requireSelect) {

            let row = getSelectedRow();

            if (!row) {
                Swal.fire("Info", "Pilih data dulu!", "warning");
                return;
            }

            // kirim seluruh data row
            params = { ...row };
        }

        // =============================
        // Optional: ambil parameter tambahan dari tombol
        // =============================
        if ($btn.data("extra")) {
            try {
                let extraParams = JSON.parse($btn.attr("data-extra"));
                params = { ...params, ...extraParams };
            } catch (e) {
                console.warn("Format data-extra salah (harus JSON)");
            }
        }

        openRaModal({
            title: modalTitle,
            url: modalUrl,
            method: method,
            params: params
        });

    });
}); 
<?php
}
elseif ($page=="kewenangan_klinis")  
{
?>
function debounce(fn, delay) {
    let t; return function () {
        clearTimeout(t);
        t = setTimeout(() => fn.apply(this, arguments), delay);
    };
}
$(document).ready(function(){
  let table = $('#dttb').DataTable({
      processing: true,
      serverSide: true,
      searching: true,
      ordering: true,
      pageLength: 10,
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
      ajax: {
          url: "<?= base_url('master_kredensial/kewenangan_klinis/data_kewenangan_klinis') ?>",
          type: "POST"
      },
      select: {
          style: 'single',
          selector: 'td:not(.dt-control)'
      },
      order: [[0, "desc"]],
      lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
      dom:
        "<'row mb-2'\
          <'col-md-6'l>\
          <'col-md-6 text-end'B>\
        >" +
        "rt" +
        "<'row mt-2'\
          <'col-md-5'i>\
          <'col-md-7 text-end'p>\
        >",
      columns: [
          { data: "coun_kewenangan_area", visible:false, searchable:false },
          { data: "nama_kewenangan" },
          { data: "nama_area_klinis" },
          { data: "nama_sifat_kewenangan" },
          { data: "nama_grade" }
      ],
createdRow: function(row, data, dataIndex){
    const warna = [
      "table-primary",
      "table-secondary",
      "table-success",
      "table-danger",
      "table-warning",
      "table-info"
    ];
    $(row).addClass(warna[dataIndex % warna.length]);
},
initComplete: function () {
    const api = this.api();

    api.columns().every(function (colIdx) {

    //    if (colIdx === 0 || colIdx === 1) return;

        let that = this;

        $('input', this.footer()).on('keyup change', debounce(function () {
            that.search(this.value).draw();
        }, 500));
    });
  //  RA_BUTTON.init();
},
        buttons: [
/*          {
              text: 'Export Excel',
              className: 'ra-btn',
              action: function () {
                  alert("Export Excel jalan");
              }
          }*/
        ]
  });
  window.tableLogbook = table;
  RA_BUTTON.init();
    const modalEl = document.getElementById("modal-default");
    const raModal = new bootstrap.Modal(modalEl);

    function getSelectedRow() {
        return table.row({ selected: true }).data() || null;
    }
    function openRaModal({ title, url, method = "GET", params = {} }) {

        $("#raModalTitle").text(title);

        $("#raModalBody").html(`
            <div class="text-center py-4">
                <div class="spinner-border text-primary"></div>
                <div class="mt-2">Memuat...</div>
            </div>
        `);

        raModal.show();

        $.ajax({
            url: url,
            type: method,
            data: params,
            success: function (res) {
                $("#raModalBody").html(res);
                RA_BUTTON.init();
            },
            error: function () {
                $("#raModalBody").html(`
                    <div class="alert alert-danger">
                        Gagal memuat data
                    </div>
                `);
            }
        });
    }
    $(document).on("click", ".ra-btn[data-modal-url]", function (e) {

        e.preventDefault();
     //   if (!modalUrl) return true;
        let $btn = $(this);

        let modalUrl      = $btn.data("modal-url");
        let modalTitle    = $btn.data("modal-title") || "Modal";
        let method        = ($btn.data("modal-method") || "GET").toUpperCase();
        let requireSelect = $btn.data("require-select");

        if (!modalUrl) return;

        let params = {};

        // =============================
        // Jika butuh row terpilih
        // =============================
        if (requireSelect) {

            let row = getSelectedRow();

            if (!row) {
                Swal.fire("Info", "Pilih data dulu!", "warning");
                return;
            }

            // kirim seluruh data row
            params = { ...row };
        }

        // =============================
        // Optional: ambil parameter tambahan dari tombol
        // =============================
        if ($btn.data("extra")) {
            try {
                let extraParams = JSON.parse($btn.attr("data-extra"));
                params = { ...params, ...extraParams };
            } catch (e) {
                console.warn("Format data-extra salah (harus JSON)");
            }
        }

        openRaModal({
            title: modalTitle,
            url: modalUrl,
            method: method,
            params: params
        });

    });
}); 
<?php
}
elseif ($page=="elemen")  
{
?>
	$("#search-inp").keypress(function(event) {
		var character = String.fromCharCode(event.keyCode);
		return isValid(character);     
	});

	function isValid(str) {
		return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
	}
    $(document).ready(function() {
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": true,
//			"pageLength": 10,
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
                "url"  : "<?php echo base_url();?>master_kredensial/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [  			
                      { "data": "id_elemen", "searchable":false, "visible":false },
					  { "data": "nama_elemen" },
					  { "data": "nama_jabatan", "searchable":false }
					
            ],
            "order": [[0, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_elemen']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/edit/'); ?>'+data,function(){
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
		$('#search-inp').keyup(function(){
		  table.search($(this).val()).draw() ;
		})		
	});	
<?php
}
elseif ($page=="asesmen")  
{
?>
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
    $(document).ready(function() {
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": true,
//			"pageLength": 10,
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
                "url"  : "<?php echo base_url();?>master_kredensial/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [  			
                      { "data": "id_asesmen", "searchable":false, "visible":false },
					  { "data": "nama_asesmen" },
					  { "data": "nama_elemen" },
					  { "data": "nama_jabatan" }
					
            ],
            "order": [[0, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_asesmen']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/edit/'); ?>'+data,function(){
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
		$('#search-inp').keyup(function(){
		  table.search($(this).val()).draw() ;
		})		
	});	
<?php
}
elseif ($page=="qf_2")  
{
?>
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
    $(document).ready(function() {
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": true,
//			"pageLength": 10,
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
                "url"  : "<?php echo base_url();?>master_kredensial/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [  			
                      { "data": "id_question", "searchable":false, "visible":false },
					  { "data": "nama_question" },
					  { "data": "nama_asesmen" },
					  { "data": "nama_elemen" },
					  { "data": "nama_jabatan" }
					
            ],
            "order": [[0, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_question']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/edit/'); ?>'+data,function(){
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
		$('#search-inp').keyup(function(){
		  table.search($(this).val()).draw() ;
		})		
	});	
<?php
}
elseif ($page=="format_question")  
{
?>
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
    $(document).ready(function() {
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": true,
//			"pageLength": 10,
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
                "url"  : "<?php echo base_url();?>master_kredensial/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [  			
                      { "data": "id_form", "searchable":false, "visible":false },                  
					  { "data": "kode_unit" },
					  { "data": "nama_kompetensi" },
					  { "data": "nama_jenis_form", "searchable":false },
					  { "data": "nama_working", "searchable":false },
					  { "data": "nama_jabatan", "searchable":false }
					
            ],
            "order": [[0, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_form']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/edit/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },		
                {
                    text: "<i class='fa fa-cogs'></i> Seting Pertanyaan",
                    extend: "selected",
                    className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_form'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('master_kredensial/'.$page.'/seting/'); ?>'+data;
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
		$('#search-inp').keyup(function(){
		  table.search($(this).val()).draw() ;
		})		
	});	
<?php
}
elseif ($page=="format_question_seting")
{
?>
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
$(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true,
    })
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": true,
//			"pageLength": 10,
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
                "url"  : "<?php echo base_url();?>master_kredensial/format_question/detil/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [  			
                      { "data": "id_form_detil", "searchable":false, "visible":false },
					  { "data": "no_urut_detil", "searchable":false, className:"text-center" },
					  { "data": "nama_elemen", "searchable":false },
					  { "data": "nama_asesmen", "searchable":false },
					  { "data": "nama_question" }
					
            ],
            "order": [[1, 'asc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [		 
                {
                  text: "<i class='fa fa-sort-amount-asc'></i> Rubah Urutan",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_form_detil']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/format_question/urutan/'); ?>'+data,function(){
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
		$('#search-inp').keyup(function(){
		  table.search($(this).val()).draw() ;
		})	
});
<?php
}
elseif ($page=="indikator")  
{
?>
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
    $(document).ready(function() {
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": true,
//			"pageLength": 10,
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
                "url"  : "<?php echo base_url();?>master_kredensial/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [  			
                      { "data": "id_asesmen", "searchable":false, "visible":false },
                      { "data": "id_indikator", "searchable":false, "visible":false },
					  { "data": "nama_asesmen", "orderable":false },
					  { "data": "nama_indikator", "orderable":false },
					  { "data": "poin_indikator", "orderable":false },
					  { "data": "ketercapaian_indikator", "orderable":false },
					  { "data": "pertanyaan_indikator", "orderable":false },
					  { "data": "jawaban_indikator", "orderable":false },
					  { "data": "jenis_soal", "orderable":false, className:"text-center" },
					  { "data": "metode_indikator", "orderable":false, className:"text-center" },
					  { "data": "perangkat_indikator", "orderable":false, className:"text-center" }
					
            ],
            "order": [[1, 'desc'],[0, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_indikator']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/edit/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },			
                {
                  text: "<i class='fa fa-cogs'></i> Metode Asesmen",
                  extend: "selected",
                  className: "btnfuchsia",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_indikator']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/metode/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },		
                {
                  text: "<i class='fa fa-cogs'></i> Perangkat Asesmen",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_indikator']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/perangkat/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> FORM 4",
                  extend: "selected",
                  className: "btnorange",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_indikator']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/pertanyaan/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },		
                {
                  text: "<i class='fa fa-edit'></i> Rubah Opsi Jawaban",
                  extend: "selected",
                  className: "btnolive",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_indikator']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/rubah_opsi/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },	
                {
                  text: "<i class='fa fa-cog'></i> Seting Jawaban",
                  extend: "selected",
                  className: "btnolive",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_indikator']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/seting_jawaban/'); ?>'+data,function(){
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
		$('#search-inp').keyup(function(){
		  table.search($(this).val()).draw() ;
		})		
	});	
<?php
}
elseif ($page=="metode")  
{
?>
	$("#search-inp").keypress(function(event) {
		var character = String.fromCharCode(event.keyCode);
		return isValid(character);     
	});

	function isValid(str) {
		return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
	}
    $(document).ready(function() {
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": true,
//			"pageLength": 10,
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
                "url"  : "<?php echo base_url();?>master_kredensial/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [  			
                      { "data": "id_metode", "searchable":false, "visible":false },
					  { "data": "nama_metode" }
					
            ],
            "order": [[0, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_metode']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/edit/'); ?>'+data,function(){
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
		$('#search-inp').keyup(function(){
		  table.search($(this).val()).draw() ;
		})		
	});	
<?php
}
elseif ($page=="perangkat")  
{
?>
	$("#search-inp").keypress(function(event) {
		var character = String.fromCharCode(event.keyCode);
		return isValid(character);     
	});

	function isValid(str) {
		return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
	}
    $(document).ready(function() {
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": true,
//			"pageLength": 10,
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
                "url"  : "<?php echo base_url();?>master_kredensial/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [  			
                      { "data": "id_perangkat", "searchable":false, "visible":false },
					  { "data": "nama_perangkat" }
					
            ],
            "order": [[0, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_perangkat']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/edit/'); ?>'+data,function(){
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
		$('#search-inp').keyup(function(){
		  table.search($(this).val()).draw() ;
		})		
	});	
<?php
}
elseif ($page=="alat")  
{
?>
	$("#search-inp").keypress(function(event) {
		var character = String.fromCharCode(event.keyCode);
		return isValid(character);     
	});

	function isValid(str) {
		return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
	}
    $(document).ready(function() {
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": true,
//			"pageLength": 10,
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
                "url"  : "<?php echo base_url();?>master_kredensial/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [  			
                      { "data": "id_alat", "searchable":false, "visible":false },
					  { "data": "nama_alat" }
					
            ],
            "order": [[0, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_alat']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/edit/'); ?>'+data,function(){
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
		$('#search-inp').keyup(function(){
		  table.search($(this).val()).draw() ;
		})		
	});	
<?php
}
elseif ($page=="alatbahan")  
{
?>
	$("#search-inp").keypress(function(event) {
		var character = String.fromCharCode(event.keyCode);
		return isValid(character);     
	});

	function isValid(str) {
		return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
	}
    $(document).ready(function() {
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": true,
//			"pageLength": 10,
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
                "url"  : "<?php echo base_url();?>master_kredensial/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [  			
                      { "data": "id_alat_bahan", "searchable":false, "visible":false },
					  { "data": "nama_kompetensi" },
					  { "data": "nama_elemen" },
					  { "data": "nama_working", "searchable":false }
					
            ],
            "order": [[0, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_alat_bahan']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/edit/'); ?>'+data,function(){
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
		$('#search-inp').keyup(function(){
		  table.search($(this).val()).draw() ;
		})		
	});	
<?php
}
elseif ($page=="form1")  
{
?>
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
    $(document).ready(function() {
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": true,
//			"pageLength": 10,
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
                "url"  : "<?php echo base_url();?>master_kredensial/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [  			
                      { "data": "id_form", "searchable":false, "visible":false },
					  { "data": "kode_unit" },
					  { "data": "nama_kompetensi" },
					  { "data": "nama_working", "searchable":false },
					  { "data": "nama_jabatan", "searchable":false }
					
            ],
            "order": [[0, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_form']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/edit/'); ?>'+data,function(){
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
		$('#search-inp').keyup(function(){
		  table.search($(this).val()).draw() ;
		})		
	});	
<?php
}
elseif ($page=="form3")  
{
?>
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
    $(document).ready(function() {
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": true,
//			"pageLength": 10,
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
                "url"  : "<?php echo base_url();?>master_kredensial/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [  			
                      { "data": "id_form", "searchable":false, "visible":false },
					  { "data": "kode_unit" },
					  { "data": "nama_kompetensi" },
					  { "data": "nama_working", "searchable":false },
					  { "data": "nama_jabatan", "searchable":false }
					
            ],
            "order": [[0, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_form']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/edit/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },		
                {
                    text: "<i class='fa fa-cogs'></i> Seting Form 3",
                    extend: "selected",
                    className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_form'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('master_kredensial/'.$page.'/seting/'); ?>'+data;
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
		$('#search-inp').keyup(function(){
		  table.search($(this).val()).draw() ;
		})		
	});	
<?php
}
elseif ($page=="form3_seting")  
{
?>
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
  function format ( d ) {        // `d` is the original data object for the row
    return '<table class="table table-striped text-muted style="padding-left:50px; ">'+
      '<tr> <td>Poin yang di amati:</td><td>'+d.poin_indikator+'</td> <td></td><td>Pertanyaan:</td><td>'+d.pertanyaan_indikator+'</td> </tr>'+
      '<tr> <td>Indikator Ketercapaian:</td><td>'+d.ketercapaian_indikator+'</td><td></td><td>Standar Jawaban:</td><td>'+d.jawaban_indikator+'</td> </tr>'+
      '</table>';
  }
    $(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true,
    })
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": true,
//			"pageLength": 10,
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
                "url"  : "<?php echo base_url();?>master_kredensial/form3/detil/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [  	
              {
                  "className": 'details-control',
                  "orderable": false,
                  "searchable":false,
                  "data":      null,
                  "defaultContent": ''
              },		
                      { "data": "id_form_detil", "searchable":false, "visible":false },
					  { "data": "no_urut_detil", "searchable":false, className:"text-center" },
					  { "data": "nama_elemen", "searchable":false },
					  { "data": "nama_asesmen", "searchable":false },
					  { "data": "nama_indikator" },
					  { "data": "metode_form_detil", "searchable":false },
					  { "data": "perangkat_form_detil", "searchable":false }
					
            ],
            "order": [[2, 'asc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                  text: "<i class='fa fa-sort-amount-asc'></i> Rubah Urutan",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_form_detil']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/form3/urutan/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
                {
                  text: "<i class='fa fa-cogs'></i> Metode Asesmen",
                  extend: "selected",
                  className: "btnfuchsia",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_form_detil']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/form3/metode/'); ?>'+data+'/<?php echo $id;?>/<?php echo $id2;?>/<?php echo $id3;?>',function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },		
                {
                  text: "<i class='fa fa-cogs'></i> Perangkat Asesmen",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_form_detil']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/form3/perangkat/'); ?>'+data+'/<?php echo $id;?>/<?php echo $id2;?>/<?php echo $id3;?>',function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },		
                {
                  text: "<i class='fa fa-cogs'></i> Form 3 dan 4",
                  extend: "selected",
                  className: "btnred",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_form_detil']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/form3/pertanyaan/'); ?>'+data+'/<?php echo $id;?>/<?php echo $id2;?>/<?php echo $id3;?>',function(){
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
        $('#dttb').on('click', 'td.details-control', function () {
  	      var tr = $(this).closest('tr');
  	      var row = table.row( tr );
  	      if ( row.child.isShown() ) {
  	        // This row is already open - close it
  	        row.child.hide();
  	        tr.removeClass('shown');
  	      }
  	      else {
  	        // Open this row
  	        row.child( format(row.data()) ).show();
  	        tr.addClass('shown');
  	      }
  	    });	
		$('#search-inp').keyup(function(){
		  table.search($(this).val()).draw() ;
		})		
	});	
<?php
}
elseif ($page=="form4")  
{
?>
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
    $(document).ready(function() {
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": true,
//			"pageLength": 10,
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
                "url"  : "<?php echo base_url();?>master_kredensial/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [  			
                      { "data": "id_form", "searchable":false, "visible":false },
					  { "data": "kode_unit" },
					  { "data": "nama_kompetensi" },
					  { "data": "nama_working", "searchable":false },
					  { "data": "nama_jabatan", "searchable":false }
					
            ],
            "order": [[0, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_form']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/edit/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },		
                {
                    text: "<i class='fa fa-cogs'></i> Seting Form",
                    extend: "selected",
                    className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_form'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('master_kredensial/'.$page.'/seting/'); ?>'+data;
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
		$('#search-inp').keyup(function(){
		  table.search($(this).val()).draw() ;
		})		
	});	
<?php
}
elseif ($page=="form4_seting")  
{
?>
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
  function format ( d ) {        // `d` is the original data object for the row
    return '<table class="table table-striped text-muted style="padding-left:50px; ">'+
      '<tr> <td>Poin yang di amati:</td><td>'+d.poin_indikator+'</td> <td></td><td>Pertanyaan:</td><td>'+d.pertanyaan_indikator+'</td> </tr>'+
      '<tr> <td>Indikator Ketercapaian:</td><td>'+d.ketercapaian_indikator+'</td><td></td><td>Standar Jawaban:</td><td>'+d.jawaban_indikator+'</td> </tr>'+
      '</table>';
  }
    $(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true,
    })
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": true,
//			"pageLength": 10,
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
                "url"  : "<?php echo base_url();?>master_kredensial/form4/detil/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [  	
              {
                  "className": 'details-control',
                  "orderable": false,
                  "searchable":false,
                  "data":      null,
                  "defaultContent": ''
              },		
                      { "data": "id_form_detil", "searchable":false, "visible":false },
					  { "data": "no_urut_detil", "searchable":false, className:"text-center" },
					  { "data": "nama_elemen", "searchable":false },
					  { "data": "nama_asesmen", "searchable":false },
					  { "data": "nama_indikator" },
					  { "data": "poin_indikator" }
					
            ],
            "order": [[1, 'asc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                  text: "<i class='fa fa-sort-amount-asc'></i> Rubah Urutan",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_form_detil']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/form4/urutan/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
                {
                  text: "<i class='fa fa-cogs'></i> Pertanyaan Standar",
                  extend: "selected",
                  className: "btnred",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_form_detil']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/form3/pertanyaan/'); ?>'+data+'/<?php echo $id;?>/<?php echo $id2;?>/<?php echo $id3;?>',function(){
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
        $('#dttb').on('click', 'td.details-control', function () {
  	      var tr = $(this).closest('tr');
  	      var row = table.row( tr );
  	      if ( row.child.isShown() ) {
  	        // This row is already open - close it
  	        row.child.hide();
  	        tr.removeClass('shown');
  	      }
  	      else {
  	        // Open this row
  	        row.child( format(row.data()) ).show();
  	        tr.addClass('shown');
  	      }
  	    });	
		$('#search-inp').keyup(function(){
		  table.search($(this).val()).draw() ;
		})		
	});	
<?php
}
elseif ($page=="form4b")  
{
?>
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
    $(document).ready(function() {
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": true,
//			"pageLength": 10,
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
                "url"  : "<?php echo base_url();?>master_kredensial/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [  			
                      { "data": "id_form", "searchable":false, "visible":false },
					  { "data": "kode_unit" },
					  { "data": "nama_kompetensi" },
					  { "data": "nama_working", "searchable":false },
					  { "data": "nama_jabatan", "searchable":false }
					
            ],
            "order": [[0, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_form']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/edit/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },		
                {
                    text: "<i class='fa fa-cogs'></i> Seting Form",
                    extend: "selected",
                    className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_form'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('master_kredensial/'.$page.'/seting/'); ?>'+data;
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
		$('#search-inp').keyup(function(){
		  table.search($(this).val()).draw() ;
		})		
	});	
<?php
}
elseif ($page=="form4b_seting")  
{
?>
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
  function format ( d ) {        // `d` is the original data object for the row
    return '<table class="table table-striped text-muted style="padding-left:50px; ">'+
      '<tr> <td>Poin yang di amati:</td><td>'+d.poin_indikator+'</td> <td></td><td>Pertanyaan:</td><td>'+d.pertanyaan_indikator+'</td> </tr>'+
      '<tr> <td>Indikator Ketercapaian:</td><td>'+d.ketercapaian_indikator+'</td><td></td><td>Standar Jawaban:</td><td>'+d.jawaban_indikator+'</td> </tr>'+
      '</table>';
  }
    $(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true,
    })
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": true,
//			"pageLength": 10,
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
                "url"  : "<?php echo base_url();?>master_kredensial/form4b/detil/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [  	
              {
                  "className": 'details-control',
                  "orderable": false,
                  "searchable":false,
                  "data":      null,
                  "defaultContent": ''
              },		
                      { "data": "id_form_detil", "searchable":false, "visible":false },
					  { "data": "no_urut_detil", "searchable":false, className:"text-center" },
					  { "data": "nama_elemen", "searchable":false },
					  { "data": "nama_asesmen", "searchable":false },
					  { "data": "nama_indikator" },
					  { "data": "pertanyaan_indikator" },
					  { "data": "ketercapaian_indikator" }
					
            ],
            "order": [[1, 'asc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [	 
                {
                  text: "<i class='fa fa-sort-amount-asc'></i> Rubah Urutan",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_form_detil']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/form4b/urutan/'); ?>'+data,function(){
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
        $('#dttb').on('click', 'td.details-control', function () {
  	      var tr = $(this).closest('tr');
  	      var row = table.row( tr );
  	      if ( row.child.isShown() ) {
  	        // This row is already open - close it
  	        row.child.hide();
  	        tr.removeClass('shown');
  	      }
  	      else {
  	        // Open this row
  	        row.child( format(row.data()) ).show();
  	        tr.addClass('shown');
  	      }
  	    });	
		$('#search-inp').keyup(function(){
		  table.search($(this).val()).draw() ;
		})		
	});	
<?php
}
elseif ($page=="form4c")  
{
?>
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
    $(document).ready(function() {
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": true,
//			"pageLength": 10,
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
                "url"  : "<?php echo base_url();?>master_kredensial/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [  			
                      { "data": "id_form", "searchable":false, "visible":false },
					  { "data": "kode_unit" },
					  { "data": "nama_kompetensi" },
					  { "data": "nama_working", "searchable":false },
					  { "data": "nama_jabatan", "searchable":false }
					
            ],
            "order": [[0, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_form']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/edit/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },		
                {
                    text: "<i class='fa fa-cogs'></i> Seting Form",
                    extend: "selected",
                    className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_form'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('master_kredensial/'.$page.'/seting/'); ?>'+data;
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
		$('#search-inp').keyup(function(){
		  table.search($(this).val()).draw() ;
		})		
	});	
<?php
}
elseif ($page=="form4c_seting")  
{
?>
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
  function format ( d ) {        // `d` is the original data object for the row
    return '<table class="table table-striped text-muted style="padding-left:50px; ">'+
      '<tr> <td>Poin yang di amati:</td><td>'+d.poin_indikator+'</td> <td></td><td>Pertanyaan:</td><td>'+d.pertanyaan_indikator+'</td> </tr>'+
      '<tr> <td>Indikator Ketercapaian:</td><td>'+d.ketercapaian_indikator+'</td><td></td><td>Standar Jawaban:</td><td>'+d.jawaban_indikator+'</td> </tr>'+
      '</table>';
  }
    $(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true,
    })
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": true,
//			"pageLength": 10,
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
                "url"  : "<?php echo base_url();?>master_kredensial/form4c/detil/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [  	
              {
                  "className": 'details-control',
                  "orderable": false,
                  "searchable":false,
                  "data":      null,
                  "defaultContent": ''
              },		
                      { "data": "id_form_detil", "searchable":false, "visible":false },
					  { "data": "no_urut_detil", "searchable":false, className:"text-center" },
					  { "data": "nama_elemen", "searchable":false },
					  { "data": "nama_asesmen", "searchable":false },
					  { "data": "nama_indikator" },
					  { "data": "pertanyaan_indikator" },
					  { "data": "jenis_soal", "searchable":false },
					  { "data": "jawaban_indikator" }
					
            ],
            "order": [[1, 'asc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [	 
                {
                  text: "<i class='fa fa-sort-amount-asc'></i> Rubah Urutan",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_form_detil']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/form4c/urutan/'); ?>'+data,function(){
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
        $('#dttb').on('click', 'td.details-control', function () {
  	      var tr = $(this).closest('tr');
  	      var row = table.row( tr );
  	      if ( row.child.isShown() ) {
  	        // This row is already open - close it
  	        row.child.hide();
  	        tr.removeClass('shown');
  	      }
  	      else {
  	        // Open this row
  	        row.child( format(row.data()) ).show();
  	        tr.addClass('shown');
  	      }
  	    });	
		$('#search-inp').keyup(function(){
		  table.search($(this).val()).draw() ;
		})		
	});	
<?php
}
elseif ($page=="form4d")  
{
?>
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
    $(document).ready(function() {
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": true,
//			"pageLength": 10,
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
                "url"  : "<?php echo base_url();?>master_kredensial/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [  			
                      { "data": "id_form", "searchable":false, "visible":false },
					  { "data": "kode_unit" },
					  { "data": "nama_kompetensi" },
					  { "data": "nama_working", "searchable":false },
					  { "data": "nama_jabatan", "searchable":false }
					
            ],
            "order": [[0, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_form']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/edit/'); ?>'+data,function(){
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
		$('#search-inp').keyup(function(){
		  table.search($(this).val()).draw() ;
		})		
	});	
<?php
}
elseif ($page=="langkah")  
{
?>
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
    $(document).ready(function() {
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": true,
//			"pageLength": 10,
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
                "url"  : "<?php echo base_url();?>master_kredensial/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [  			
                      { "data": "id_pra_asesmen", "searchable":false, "visible":false },
					  { "data": "nama_pra_asesmen" }
					
            ],
            "order": [[0, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_pra_asesmen']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/edit/'); ?>'+data,function(){
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
		$('#search-inp').keyup(function(){
		  table.search($(this).val()).draw() ;
		})		
	});	
<?php
}
elseif ($page=="kegiatan")  
{
?>
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
    $(document).ready(function() {
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": true,
//			"pageLength": 10,
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
                "url"  : "<?php echo base_url();?>master_kredensial/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [  			
                      { "data": "id_pra_detil", "searchable":false, "visible":false },
					  { "data": "nama_pra_asesmen" },
					  { "data": "nama_pra_detil" },
					  { "data": "nama_jabatan" }
					
            ],
            "order": [[0, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_pra_detil']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/edit/'); ?>'+data,function(){
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
		$('#search-inp').keyup(function(){
		  table.search($(this).val()).draw() ;
		})		
	});	
<?php
}
elseif ($page=="form5")  
{
?>
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
    $(document).ready(function() {
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": true,
//			"pageLength": 10,
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
                "url"  : "<?php echo base_url();?>master_kredensial/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [  			
                      { "data": "id_form", "searchable":false, "visible":false },
					  { "data": "kode_unit" },
					  { "data": "nama_kompetensi" },
					  { "data": "nama_working", "searchable":false },
					  { "data": "nama_jabatan", "searchable":false }
					
            ],
            "order": [[0, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_form']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/edit/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },		
                {
                    text: "<i class='fa fa-cogs'></i> Seting Form",
                    extend: "selected",
                    className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_form'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('master_kredensial/'.$page.'/seting/'); ?>'+data;
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
		$('#search-inp').keyup(function(){
		  table.search($(this).val()).draw() ;
		})		
	});	
<?php
}
elseif ($page=="form5_seting")  
{
?>
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
    $(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true,
    })
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": true,
//			"pageLength": 10,
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
                "url"  : "<?php echo base_url();?>master_kredensial/form5/detil/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [  		
					  { "data": "no_urut_detil", "searchable":false, className:"text-center" },
					  { "data": "nama_pra_asesmen" },
					  { "data": "nama_pra_detil" }
					
            ],
            "order": [[0, 'asc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [	 
                {
                  text: "<i class='fa fa-sort-amount-asc'></i> Rubah Urutan",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_form_detil']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/form5/urutan/'); ?>'+data,function(){
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
		$('#search-inp').keyup(function(){
		  table.search($(this).val()).draw() ;
		})		
	});	
<?php
}
elseif ($page=="form6")  
{
?>
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
    $(document).ready(function() {
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": true,
//			"pageLength": 10,
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
                "url"  : "<?php echo base_url();?>master_kredensial/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [  			
                      { "data": "id_form", "searchable":false, "visible":false },
					  { "data": "kode_unit" },
					  { "data": "nama_kompetensi" },
					  { "data": "nama_working", "searchable":false },
					  { "data": "nama_jabatan", "searchable":false }
					
            ],
            "order": [[0, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_form']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/edit/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },		
                {
                    text: "<i class='fa fa-cogs'></i> Seting Form",
                    extend: "selected",
                    className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_form'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('master_kredensial/'.$page.'/seting/'); ?>'+data;
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
		$('#search-inp').keyup(function(){
		  table.search($(this).val()).draw() ;
		})		
	});	
<?php
}
elseif ($page=="form6_seting")  
{
?>
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
    $(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true,
    })
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": true,
//			"pageLength": 10,
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
                "url"  : "<?php echo base_url();?>master_kredensial/form6/detil/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [  		
                      { "data": "id_form_detil", "searchable":false, "visible":false },
					  { "data": "no_urut_detil", "searchable":false, className:"text-center" },
					  { "data": "nama_pra_asesmen" },
					  { "data": "nama_pra_detil" }
					
            ],
            "order": [[1, 'asc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [	 
                {
                  text: "<i class='fa fa-sort-amount-asc'></i> Rubah Urutan",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_form_detil']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/form6/urutan/'); ?>'+data,function(){
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
		$('#search-inp').keyup(function(){
		  table.search($(this).val()).draw() ;
		})		
	});	
<?php
}
elseif ($page=="form7")  
{
?>
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
    $(document).ready(function() {
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": true,
//			"pageLength": 10,
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
                "url"  : "<?php echo base_url();?>master_kredensial/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [  			
                      { "data": "id_form", "searchable":false, "visible":false },
					  { "data": "kode_unit" },
					  { "data": "nama_kompetensi" },
					  { "data": "nama_working", "searchable":false },
					  { "data": "nama_jabatan", "searchable":false }
					
            ],
            "order": [[0, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_form']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/edit/'); ?>'+data,function(){
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
		$('#search-inp').keyup(function(){
		  table.search($(this).val()).draw() ;
		})		
	});	
<?php
}
elseif ($page=="form8")  
{
?>
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
    $(document).ready(function() {
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": true,
//			"pageLength": 10,
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
                "url"  : "<?php echo base_url();?>master_kredensial/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [  			
                      { "data": "id_form", "searchable":false, "visible":false },
					  { "data": "kode_unit" },
					  { "data": "nama_kompetensi" },
					  { "data": "nama_working", "searchable":false },
					  { "data": "nama_jabatan", "searchable":false }
					
            ],
            "order": [[0, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_form']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/edit/'); ?>'+data,function(){
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
		$('#search-inp').keyup(function(){
		  table.search($(this).val()).draw() ;
		})		
	});	
<?php
}
elseif ($page=="kat_kaji_ulang")  
{
?>
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
    $(document).ready(function() {
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": true,
//			"pageLength": 10,
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
                "url"  : "<?php echo base_url();?>master_kredensial/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [  			
                      { "data": "id_kat_kaji", "searchable":false, "visible":false },
					  { "data": "nama_kat_kaji" }
					
            ],
            "order": [[0, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_kat_kaji']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/edit/'); ?>'+data,function(){
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
		$('#search-inp').keyup(function(){
		  table.search($(this).val()).draw() ;
		})		
	});	
<?php
}
elseif ($page=="kaji_ulang")  
{
?>
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
    $(document).ready(function() {
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": true,
//			"pageLength": 10,
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
                "url"  : "<?php echo base_url();?>master_kredensial/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [  			
                      { "data": "id_kaji_ulang", "searchable":false, "visible":false },
					  { "data": "nama_kaji_ulang" },
					  { "data": "nama_kat_kaji", "searchable":false },
					  { "data": "nama_jenis_form", "searchable":false }
					
            ],
            "order": [[0, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_kaji_ulang']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/edit/'); ?>'+data,function(){
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
		$('#search-inp').keyup(function(){
		  table.search($(this).val()).draw() ;
		})		
	});	
<?php
}
elseif ($page=="form9a")  
{
?>
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
    $(document).ready(function() {
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": true,
//			"pageLength": 10,
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
                "url"  : "<?php echo base_url();?>master_kredensial/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [  			
                      { "data": "id_form", "searchable":false, "visible":false },
					  { "data": "kode_unit" },
					  { "data": "nama_kompetensi" },
					  { "data": "nama_working", "searchable":false },
					  { "data": "nama_jabatan", "searchable":false }
					
            ],
            "order": [[0, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_form']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/edit/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },		
                {
                    text: "<i class='fa fa-cogs'></i> Seting Form",
                    extend: "selected",
                    className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_form'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('master_kredensial/'.$page.'/seting/'); ?>'+data;
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
		$('#search-inp').keyup(function(){
		  table.search($(this).val()).draw() ;
		})		
	});	
<?php
}
elseif ($page=="form9a_seting")  
{
?>
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
    $(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true,
    })
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": true,
//			"pageLength": 10,
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
                "url"  : "<?php echo base_url();?>master_kredensial/form9a/detil/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [  		
                      { "data": "id_form_detil", "searchable":false, "visible":false },
					  { "data": "no_urut_detil", "searchable":false, className:"text-center" },
					  { "data": "nama_kaji_ulang" }
					
            ],
            "order": [[1, 'asc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [	 
                {
                  text: "<i class='fa fa-sort-amount-asc'></i> Rubah Urutan",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_form_detil']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/form9a/urutan/'); ?>'+data,function(){
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
		$('#search-inp').keyup(function(){
		  table.search($(this).val()).draw() ;
		})		
	});	
<?php
}
elseif ($page=="form9b")  
{
?>
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
    $(document).ready(function() {
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": true,
//			"pageLength": 10,
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
                "url"  : "<?php echo base_url();?>master_kredensial/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [  			
                      { "data": "id_form", "searchable":false, "visible":false },
					  { "data": "kode_unit" },
					  { "data": "nama_kompetensi" },
					  { "data": "nama_working", "searchable":false },
					  { "data": "nama_jabatan", "searchable":false }
					
            ],
            "order": [[0, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_form']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/'.$page.'/edit/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },		
                {
                    text: "<i class='fa fa-cogs'></i> Seting Form",
                    extend: "selected",
                    className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_form'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('master_kredensial/'.$page.'/seting/'); ?>'+data;
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
		$('#search-inp').keyup(function(){
		  table.search($(this).val()).draw() ;
		})		
	});	
<?php
}
elseif ($page=="form9b_seting")  
{
?>
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
    $(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true,
    })
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": true,
//			"pageLength": 10,
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
                "url"  : "<?php echo base_url();?>master_kredensial/form9b/detil/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [  		
                      { "data": "id_form_detil", "searchable":false, "visible":false },
					  { "data": "no_urut_detil", "searchable":false, className:"text-center" },
					  { "data": "nama_kaji_ulang" }
					
            ],
            "order": [[1, 'asc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [	 
                {
                  text: "<i class='fa fa-sort-amount-asc'></i> Rubah Urutan",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_form_detil']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('master_kredensial/form9b/urutan/'); ?>'+data,function(){
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
		$('#search-inp').keyup(function(){
		  table.search($(this).val()).draw() ;
		})		
	});	
<?php
}
?>
</script>
		</div>
	</body>
</html>