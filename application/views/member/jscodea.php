<script type="text/javascript">
function Timer() {
   var hr = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
   var bl = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
   var dt=new Date()
   document.getElementById('timer_waktu').innerHTML=hr[dt.getDay()]+", "+dt.getDate()+" "+bl[dt.getMonth()]+" "+dt.getFullYear()+" ["+ dt.getHours()+":"+dt.getMinutes()+":"+dt.getSeconds()+"]";
   setTimeout("Timer()",1000);
}
Timer();
const base_url = "<?= base_url(); ?>";
<?php
//================================================= H O M E =================================================
if ($page=="home")
{
	//	Agar saat home tidak ke universal
?>
    function loadJadwal(bulan, tahun) {
        $('#jadwal-wrapper').html('Loading...');

        $.get(base_url + 'member/jadwal_ajax/' + bulan + '/' + tahun, function(html){

            $('#jadwal-wrapper').html(html);

            setTimeout(function(){
                if ($.fn.DataTable.isDataTable('#example1')) {
                    $('#example1').DataTable().destroy();
                }

                $('#example1').DataTable({
                    paging: false,
                    searching: false,
                    ordering: false,
                    info: false,
                    scrollX: true,
                    scrollY: '500px',
                    scrollCollapse: true,
                    fixedColumns: {
                        leftColumns: 1
                    }
                });
            }, 50);

        });
    }
    function loadJadwalDashboard(bulan, tahun) {
        $('#jadwal-wrapper2').html('Loading...');

        $.get(base_url + 'member/jadwal_dashboard_ajax/' + bulan + '/' + tahun, function(html){
            $('#jadwal-wrapper2').html(html);
        });
    }
    $(document).ready(function() {
      $('.select-example').select2({
        width: '100%'
      });
      flatpickr(".basic-date", { enableTime: false });
      const bulan = $('#bulan').val();
      const tahun = $('#tahun').val();
      loadJadwal(bulan, tahun);
      loadJadwalDashboard(bulan, tahun);
      $('#btnFilter').click(function(e){
          e.preventDefault();
          const bulan = $('select[name="bulan"]').val();
          const tahun = $('select[name="tahun"]').val();
          loadJadwal(bulan, tahun);          // reload full bulan
      //    loadJadwalDashboard(bulan, tahun);
        //  loadRangeJadwal('jadwal2-wrapper', s, f); // reload range 3-4
      });
    });
function sum(arr){
    return arr.reduce((a,b) => a + b, 0);
}
function pieOptions({ labels, data, colors, total }) {
    return {
        series: data,
        chart: {
            type: 'pie',
            height: 600
        },
        labels: labels,
        colors: colors,
        legend: {
            position: 'bottom',
            height: 250,
            fontSize: '11px',
            formatter: function(label, opts){
                const val = opts.w.globals.series[opts.seriesIndex];
                const perc = ((val / total) * 100).toFixed(1);
                return `${label} : ${val} ({${perc}%})`;
            }
        },
        dataLabels: { enabled: true },
        tooltip: { enabled: false }
    };
}
//var charts = {}; // simpan semua pie
var charts = charts || {}; // share dengan pie

function renderPieChart(el, res){
    const total = sum(res.data);

    if (charts[el]) charts[el].destroy();

    charts[el] = new ApexCharts(
        document.querySelector(el),
        pieOptions({
            labels: res.labels,
            data: res.data,
            colors: res.colors,
            total: total
        })
    );

    charts[el].render();
}
function loadPieChart(el, url){
    $.getJSON(url, function(res){
        renderPieChart(el, res);
    });
}
const tahun = $('#tahun_pie').val();

loadPieChart('#pie1', '<?php echo base_url("member/pie_logbook_ajax"); ?>/' + tahun);

// kalau nanti ada pie lain
loadPieChart('#pie2', '<?php echo base_url("member/pie_pelatihan_ajax"); ?>/' + tahun);
initApexLine();

$('#tahun_pie').change(function(){
    const tahun = $(this).val();
    loadPieChart('#pie1', '<?php echo base_url("member/pie_logbook_ajax"); ?>/' + tahun);
    loadPieChart('#pie2', '<?php echo base_url("member/pie_pelatihan_ajax"); ?>/' + tahun);
});

function lineOptions({ series, categories }) {

    return {
        series: series,
        chart: {
            type: 'line',
            height: 800,
            toolbar: { show: true }
        },
        stroke: { curve: 'smooth' },
        xaxis: { categories: categories },
        dataLabels: { enabled: true },
        markers: { size: 4 },
        tooltip: { enabled: false },
        legend: {
            position: 'bottom',
            horizontalAlign: 'left',
            fontSize: '11px',
            height: 300,
            formatter: function(seriesName, opts){

                const seriesIndex = opts.seriesIndex;
                const data = opts.w.config.series[seriesIndex].data;
                const total = sum(data);

                let text = seriesName + '<br>';

                categories.forEach(function(thn, i){
                    const val = data[i] ?? 0;
                    text += thn + ': ' + val;
                    if(i < categories.length - 1) text += ' | ';
                });

                return text;
            }
        }
    };
}

function renderLineChart(el, series, categories){

    if(!document.querySelector(el)){
        console.warn(`[Apex] element ${el} tidak ditemukan`);
        return;
    }

    if(charts[el]) charts[el].destroy();

    charts[el] = new ApexCharts(
        document.querySelector(el),
        lineOptions({
            series: series,
            categories: categories
        })
    );

    charts[el].render();
}
function initApexLine(){

    try {

        const seriesData = <?php echo $series_json; ?>;
        const categories = <?php echo $categories_json; ?>;

        renderLineChart('#line1', seriesData, categories);

    } catch(e){
        console.error('[Apex LINE ERROR]', e);
    }
}

    function debug(label, data){
      console.log('%c'+label,'color:#0d6efd;font-weight:bold', data);
    }
    /*
    debug('ADD FORM', $(this).serialize());
    */
    function safe(fn){
      try { fn(); }
      catch(e){
        console.error('[JS SAFE ERROR]', e);
      }
    }

var options = {
series: [{
  name: 'Jumlah',
  type: 'column',
  data: <?= $spent ?>
}, {
  name: 'Total 1 Minggu',
  type: 'line',
  data: <?= $total ?>
}],
  chart: {
    height: 270,
    type: 'line',
    // stacked: false,
    dropShadow: {
      enabled: true,
      top: 10,
      left: 0,
      blur: 2,
      color:'#48BECE',
      opacity: 0.2,
    },
  },
  stroke: {
    width: [0, 3],
    curve: 'smooth',
  },
  plotOptions: {
    bar: {
      columnWidth: '20',
      borderRadius: 5,
      borderRadiusApplication: 'around',
      borderRadiusWhenStacked: 'last',
    }
  },
  legend: {
    show: false,
  },
  colors: ['rgba(var(--primary),.2)', 'rgba(var(--primary),1)'],
  markers: {
    size: 4,
    colors: '#fff',
    strokeColors: 'rgba(var(--primary),1)',
    strokeWidth: 3,
    hover: {
      size: 4,
    }
  },
  xaxis: {
    show: false,
    type: 'category',
    categories: <?= $labels ?>,
    tooltip: {
      enabled: false
    },
    axisBorder: {
      show: true,
    },
    labels: {
      style: {
        colors: 'rgba(var(--secondary),1)',
        fontSize: '13px',
        fontFamily: 'Golos Text", sans-serif',
        fontWeight: 500,
      }
    }
  },
  yaxis: {
    show: false,
  },
  grid: {
    show: true,
    borderColor: 'rgba(var(--dark),.2)',
    strokeDashArray: 2,
    xaxis: {
      lines: {
        show: false
      },
    },
    yaxis: {
      lines: {
        show: true
      },
    },
  },
  tooltip: {
    x: {
      show: false,
    },
    style: {
      fontSize: '16px',
      fontFamily: '"Outfit", sans-serif',
    },
  },
  responsive: [{
    breakpoint: 1400,
    options: {
      chart: {
        height: 250
      },

    }
  }]
};
var chart = new ApexCharts(document.querySelector("#activityHours"), options);
chart.render();

var options = {
    series: <?= $pie_series ?>,
    chart: {
        height: 380,
        type: 'donut',
        dropShadow: {
            enabled: true,
            color: '#111',
            top: -1,
            left: 3,
            blur: 3,
            opacity: 0.2
        }
    },
    stroke: {
        width: 0,
    },
    plotOptions: {
        pie: {
            donut: {
                labels: {
                    show: true,
                    total: {
                        showAlways: true,
                        show: true
                    }
                }
            }
        }
    },
    labels: <?= $labels ?>,
    dataLabels: {
        dropShadow: {
            blur: 3,
            opacity: 0.8
        }
    },
    fill: {
        type: 'pattern',
        opacity: 1,
        pattern: {
            enabled: true,
            style: ['verticalLines', 'squares', 'horizontalLines', 'circles', 'slantedLines'],
        },
    },
    states: {
        hover: {
            filter: 'none'
        }
    },
    theme: {
        palette: 'palette2'
    },
    legend: {
      position: 'bottom',
    },
    responsive: [{
      breakpoint: 1366,
      options: {
          chart: {
              height: 250
          },
          legend: {
            show: false,
          },
      }
  }],
    colors: [getLocalStorageItem('color-primary','#48BECE'),getLocalStorageItem('color-secondary','#8B8476'),'#AECC34','#FF5E40','#F9D249'],
};

var chart = new ApexCharts(document.querySelector("#piem"), options);
chart.render();

document.addEventListener('DOMContentLoaded', function () {

  let calendar;
  let selectedStart = null;
  let selectedEnd   = null;
  let currentEvent  = null;
  let isReadOnly    = false; // inject dari PHP kalau perlu

  const calendarEl = document.getElementById('calendar');

  calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    locale: 'id',
    height: 650,
    headerToolbar: false,

    selectable: !isReadOnly,
    editable: !isReadOnly,
    eventResizableFromStart: !isReadOnly,
    dayMaxEventRows: true,
    eventDisplay: 'block',

    events: '<?= site_url("member/load") ?>',
    eventTimeFormat: { // default format jam
      hour: '2-digit',
      minute: '2-digit',
      hour12: false
    },

    views: {
      dayGridMonth: {
        displayEventTime: false // ⛔ JAM HILANG DI MONTH
      }
    },
    /* ========= KLIK TANGGAL (ADD) ========= */
    dateClick(info){
      if(isReadOnly) return;

      currentEvent  = null;
      selectedStart = info.dateStr;
      selectedEnd   = info.dateStr;

      $('#eventTitle').val('');
      $('#eventDesc').val('');
      $('#eventColor').val('#3788d8');
      $('#btnDeleteEvent').hide();

      $('#eventModal').modal('show');
    },

    /* ========= KLIK EVENT (EDIT) ========= */
    eventClick(info){
      if(isReadOnly) return;

      currentEvent  = info.event;
      selectedStart = info.event.startStr;
      selectedEnd   = info.event.endStr || info.event.startStr;

      $('#eventTitle').val(info.event.title);
      $('#eventDesc').val(info.event.extendedProps.description || '');
      $('#eventColor').val(info.event.backgroundColor);

      $('#btnDeleteEvent').show();
      $('#eventModal').modal('show');
    },

    /* ========= DRAG / RESIZE ========= */
    eventDrop(info){
      syncEventDate(info.event);
    },
    eventResize(info){
      syncEventDate(info.event);
    }
  });

  calendar.render();
  updateTitle();

  /* ========= SAVE ========= */
document.getElementById('btnSaveEvent').onclick = function(){

  const title = $('#eventTitle').val().trim();
  if(!title){
    alert('Judul wajib');
    return;
  }

  // ===== EDIT MODE =====
  if(currentEvent){

    currentEvent.setProp('title', title);
    currentEvent.setExtendedProp('description', $('#eventDesc').val());
    currentEvent.setProp('backgroundColor', $('#eventColor').val());
    currentEvent.setProp('borderColor', $('#eventColor').val());

    $.post('<?= site_url("member/update") ?>', {
      id: currentEvent.id,
      title: title,
      description: $('#eventDesc').val(),
      color: $('#eventColor').val(),
      start: currentEvent.startStr,
      end: currentEvent.endStr || currentEvent.startStr
    });

  }
  // ===== ADD MODE =====
  else {

    const newEvent = calendar.addEvent({
      title: title,
      start: selectedStart,
      end: selectedEnd,
      allDay: true,
      backgroundColor: $('#eventColor').val(),
      borderColor: $('#eventColor').val(),
      extendedProps: {
        description: $('#eventDesc').val()
      }
    });

    $.post('<?= site_url("member/add") ?>', {
      title: title,
      start: selectedStart,
      end: selectedEnd,
      allDay: true,
      color: $('#eventColor').val(),
      description: $('#eventDesc').val()
    }, function(res){
      if(res.id){
        newEvent.setProp('id', res.id); // ⬅️ penting!
      }
    }, 'json');
  }

  $('#eventModal').modal('hide');
};


  /* ========= DELETE ========= */
  $('#btnDeleteEvent').on('click', function(){
    if(!currentEvent) return;

    if(!confirm('Hapus event ini?')) return;

    $.post('<?= site_url("member/delete") ?>', {
      id: currentEvent.id
    });

    currentEvent.remove();
    $('#eventModal').modal('hide');
  });

  /* ========= UPDATE DATE ========= */
  function syncEventDate(event){
    $.post('<?= site_url("member/update") ?>', {
      id: event.id,
      start: event.startStr,
      end: event.endStr
    });
  }

  /* ========= NAV ========= */
  function updateTitle(){
    document.getElementById('calTitle').innerText =
      calendar.getDate().toLocaleDateString('id-ID',{
        month:'long', year:'numeric'
      });
  }

  document.getElementById('btnPrev').onclick = ()=>{
    calendar.prev(); updateTitle();
  };
  document.getElementById('btnNext').onclick = ()=>{
    calendar.next(); updateTitle();
  };
  document.getElementById('btnToday').onclick = ()=>{
    calendar.today(); updateTitle();
  };

  document.querySelectorAll('[data-view]').forEach(btn=>{
    btn.onclick = ()=>{
      calendar.changeView(btn.dataset.view);
      updateTitle();
    };
  });

initApex();

});

document.addEventListener('click', function (e) {
  const card = e.target.closest('.ra-card');
  if (!card) return;

  const jenis  = card.dataset.jenis;
  const target = card.dataset.target;
  const url    = card.dataset.url;
  const id     = card.dataset.id;
  const title  = card.dataset.title;

  // 1️⃣ MODAL dengan TARGET ID
  if (jenis === 'modal' && target === 'id' && id) {
    e.preventDefault();

    const modalEl = document.getElementById(id);
    if (!modalEl) return;

    const modal = new bootstrap.Modal(modalEl);
    modal.show();

    // set title
    const modalTitle = modalEl.querySelector('#raModalTitle');
    if (modalTitle) modalTitle.innerText = title;

    // load isi modal
    const body = modalEl.querySelector('#raModalBody');
    if (body && url) {
      body.innerHTML = '<div class="text-center p-5"><div class="spinner-border"></div></div>';
      fetch(url)
        .then(r => r.text())
        .then(html => body.innerHTML = html);
    }
    return;
  }

  // 2️⃣ MODAL dengan TARGET CLASS
  if (jenis === 'modal' && target === 'class') {
    e.preventDefault();
    document.querySelectorAll('.' + card.classList[1]).forEach(el => el.click());
    return;
  }

  // 3️⃣ TARGET KOSONG → BIARKAN HREF JALAN
});


/*$(document).on('click', '.ra-card', function (e) {

    const target = $(this).data('target');      // id | class | ''
    const value  = $(this).data('value');       // modal-default | billingCanvas
    const url    = $(this).data('url');

    // 1️⃣ LINK NORMAL
    if (!target) {
        return true;
    }

    e.preventDefault();

    let $el;

    // 2️⃣ TARGET ID
    if (target === 'id' && value) {
        $el = $('#' + value);
    }

    // 3️⃣ TARGET CLASS
    if (target === 'class' && value) {
        $el = $('.' + value);
    }

    if (!$el || !$el.length) {
        if (url) window.location.href = url;
        return;
    }

    // 🔥 AUTO DETECT COMPONENT
    if ($el.hasClass('modal')) {
        $el.modal('show');

        if (url) {
            $el.find('.modal-content').load(url);
        }
        return;
    }

    if ($el.hasClass('offcanvas')) {
        const oc = bootstrap.Offcanvas.getOrCreateInstance($el[0]);
        oc.show();

        if (url) {
            $el.find('.offcanvas-body').load(url);
        }
        return;
    }

    if ($el.hasClass('drawer')) {
        $el.toggleClass('open');

        if (url) {
            $el.find('.drawer-body').load(url);
        }
        return;
    }

    // 4️⃣ FALLBACK
    if (url) {
        window.location.href = url;
    }
});*/

/*    document.addEventListener('click', function(e){

      const card = e.target.closest('.ra-card');
      if(!card) return;

      const jenis  = card.dataset.jenis || '';
      const target = card.dataset.target || 'url';
      const url    = card.dataset.url || '#';
      const id     = card.dataset.id || '';
      const title  = card.dataset.title || '';

      if(jenis === 'modal'){

        const modalEl = document.getElementById(id || 'raModal');
        const modal   = new bootstrap.Modal(modalEl);

        document.getElementById('raModalTitle').innerText = title || 'Detail';
        document.getElementById('raModalBody').innerHTML =
          '<div class="text-center p-5"><div class="spinner-border"></div></div>';

        fetch(url)
          .then(r=>r.text())
          .then(html=>{
            document.getElementById('raModalBody').innerHTML = html;
          });

        modal.show();
        return;
      }
      if(jenis === 'ajax'){
        fetch(url)
          .then(r=>r.text())
          .then(html=>{
            document.getElementById('ajax-result').innerHTML = html;
          });
        return;
      }
      window.location.href = url;
    });
    
    $('.LihatBilling').on('click',function(){
        $('.modal-body').load('<?php echo base_url('member/billing/lihat/'); ?>',function(){
          $('#modal-default').modal({show:true});
        });
    });*/
<?php
}
// ============================================== TES
elseif ($page=="tes")
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
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
                "url"  : "<?php echo base_url();?>member/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_pengajuan", "searchable":false, "visible":false },
                      { "data": "tgl_pengajuan", "searchable":false },
                      { "data": "nama_pegawai", "searchable":false },
                      { "data": "nama_status_diusulkan", "searchable":false },
                      { "data": "status_pengajuan",
                        "render": function(data, type, row){
                            if (row.status_pengajuan === '0') {
                               return '<button class="btn btn-xs btn-danger"> Belum Terkirim</button>';
                           } else {
                               return '<button class="btn btn-xs btn-success"> Terkirim</button>';
                           }
                        }
                      }
            ],
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Pengajuan Kompetensi",
                    className: "btnlightblue",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                            $("#modal-default").modal();
                              $('.modal-body').load('<?php echo base_url('member/'.$page.'/tambah'); ?>',function(){
                                $('#modal-default').modal({show:true});
                              });
    
                    }
                },
                {
                    text: "<i class='fa fa-edit'></i> Lengkapi Pengajuan",
                    extend: "selected",
                    className: "btnmaroon",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_pengajuan'];
                        location.href = '<?php echo base_url('member/'.$page.'/isi/'); ?>'+data;
                    }
                },
              {
                    text: "<i class='fa fa-send'></i> Kirim Proses",
                    extend: "selected",
                    className: "btnfuchsia",
                  action: function ( e, dt, node, config ) {
                  //    data = dt.rows( { selected: true } ).data()[0]['id_pendaftaran_unit'];
                      data = dt.rows( { selected: true } ).data()[0]['kode_unit_pengajuan'];
                      if(data !== null && data !== ''){                     
                        peng = dt.rows( { selected: true } ).data()[0]['id_pengajuan'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('member/'.$page.'/kirim/1/'); ?>'+peng;
                      }
                      else{
                          swal({
                            title: "BELUM ADA KOMPETENSI",
                            text: "SILAHKAN ISI KOMPETENSI DAN JANGAN LUPA BERKAS LENGKAPI",
                            icon: "warning",
                            buttons: "Tutup",
                            dangerMode: true,
                          })
                        }
                      }
              },
              {
                    text: "<i class='fa fa-refresh'></i> Data Belum Terkirim",
                    extend: "selected",
                    className: "btngreen",
                  action: function ( e, dt, node, config ) {
                  //    data = dt.rows( { selected: true } ).data()[0]['id_pendaftaran_unit'];
                      data = dt.rows( { selected: true } ).data()[0]['status_pengajuan'];
                      if(data == '1'){                     
                        peng = dt.rows( { selected: true } ).data()[0]['id_pengajuan'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('member/'.$page.'/unkirim/0/'); ?>'+peng;
                      }
                      else{
                          swal({
                            title: "BELUM TERKIRIM",
                            text: "SILAHKAN ISI KOMPETENSI DAN JANGAN LUPA BERKAS LENGKAPI",
                            icon: "warning",
                            buttons: "Tutup",
                            dangerMode: true,
                          })
                        }
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
elseif ($page=="tes_isi")
{
?>
    function format ( d ) {        // `d` is the original data object for the row
      return '<table class="table table-striped text-muted style="padding-left:50px; ">'+
      '<tr> <td>Q:</td><td>'+d.jml_logbook+'</td> <td>Instansi:</td><td colspan="2">'+d.nama_working+'</td></tr>'+
      '<tr> <td>Pencatatan Registrasi Pasien:</td><td colspan="4">'+d.rm+'</td></tr>'+
      '</table>';
    }
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
    $(document).ready(function() {
        $('.select2').select2()
    });
    $('.OpenTambahKat').on('click',function(){
          var id = $(this).data('id');    
          var id2 = $(this).data('id2');    
        $('.modal-body').load('<?php echo base_url('member/tes/tambah_kompetensi/'); ?>'+id+'/'+id2,function(){
            $('#exampleModal').modal({show:true});
        });
    });
    $('.OpenIjasah').on('click',function(){
          var id = $(this).data('id');    
          var id2 = $(this).data('id2');    
        $('.modal-body').load('<?php echo base_url('member/tes/tambah_ijasah/'); ?>'+id+'/'+id2,function(){
            $('#exampleModal').modal({show:true});
        });
    });
    $('.OpenSurat').on('click',function(){
          var id = $(this).data('id');    
          var id2 = $(this).data('id2');    
        $('.modal-body').load('<?php echo base_url('member/tes/tambah_str/'); ?>'+id+'/'+id2,function(){
            $('#exampleModal').modal({show:true});
        });
    });
    $('.OpenSertifikat').on('click',function(){
          var id = $(this).data('id');    
          var id2 = $(this).data('id2');    
        $('.modal-body').load('<?php echo base_url('member/tes/tambah_sertifikat/'); ?>'+id+'/'+id2,function(){
            $('#exampleModal').modal({show:true});
        });
    });
    $('.OpenBerkasOpsi').on('click',function(){
          var id = $(this).data('id');    
          var id2 = $(this).data('id2');    
        $('.modal-body').load('<?php echo base_url('member/tes/tambah_berkaslain/'); ?>'+id+'/'+id2,function(){
            $('#exampleModal').modal({show:true});
        });
    });
    $('.OpenEtik').on('click',function(){
          var id = $(this).data('id');    
          var id2 = $(this).data('id2');    
        $('.modal-body').load('<?php echo base_url('member/tes/tambah_etik/'); ?>'+id+'/'+id2,function(){
            $('#exampleModal').modal({show:true});
        });
    });
    $('.OpenLogbook').on('click',function(){
          var id = $(this).data('id');    
          var id2 = $(this).data('id2');    
        $('.modal-body').load('<?php echo base_url('member/tes/tambah_logbook/'); ?>'+id+'/'+id2,function(){
            $('#exampleModal').modal({show:true});
        });
    });
<?php
}
// ============================================== MAHASISWA
elseif ($page=="mhs_logbook")
{
?>
$('#first_date').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#first_date").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#last_date').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#last_date").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
function format ( d ) {        // `d` is the original data object for the row
  return '<table class="table table-striped text-muted style="padding-left:50px; ">'+
'<tr> <td>Sifat :</td><td>'+d.nama_sifat_kewenangan+'</td></tr>'+
  '<tr> <td colspan="2">Pencatatan Registrasi Pasien:</td></tr>'+
  '<tr> <td colspan="2">'+d.rm+'</td></tr>'+
    '</table>';
}
	$("#search-inp").keypress(function(event) {
		var character = String.fromCharCode(event.keyCode);
		return isValid(character);
	});
	function isValid(str) {
		return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
	}
    $(document).ready(function() {
		$('.select2').select2()
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
                "url"  : "<?php echo base_url();?>mahasiswa/<?php echo $page;?>/data/<?php echo $first_date;?>/<?php echo $last_date;?>/<?php echo $id_ruangan;?>/<?php echo $pxe;?>",
                "type" : "POST"
            },
            "columns": [
                {
                    "className": 'details-control text-center',
                    "orderable": false,
                    "searchable":false,
                    "data":      null,
                    "defaultContent": ''
                },
                      { "data": "id_logbook", "searchable":false, "visible":false },
                      { "data": "tgl_logbook", "searchable":false },
					  { "data": "kode_unit", "searchable":false },
					  { "data": "nama_kompetensi" },
                      { "data": "jml_logbook", "searchable":false, className: "text-right" },
                      { "data": "penguji", "searchable":false },
                      { "data": "nama_working", "searchable":false }
            ],
            "order": [[2, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-book'></i> <i class='fa fa-plus'></i> Isi Log Book",
                    className: "btnfuchsia",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
							location.href = '<?php echo base_url('mahasiswa/'.$page.'/tambah'); ?>';
                    }
                },
              {
                text: "<i class='fa fa-pencil-square'></i> Edit",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                      data = dt.rows( { selected: true } ).data()[0]['barcode_logbook'];
                      data2 = dt.rows( { selected: true } ).data()[0]['id_pengajuan'];
                      if(data2 == '0'){                     
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('mahasiswa/'.$page.'/edit/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });
                      }
                      else{
                          swal({
                            title: "TIDAK DAPAT DI EDIT",
                            text: "DATA SUDAH MASUK PENGAJUAN KOMPETENSI",
                            icon: "warning",
                            buttons: "Tutup",
                            dangerMode: true,
                          })
                        }
                      }
              },  
              {
                text: "<i class='fa fa-close'></i> Hapus",
                extend: "selected",
                className: "btnred",
                  action: function ( e, dt, node, config ) {
                      data = dt.rows( { selected: true } ).data()[0]['id_logbook'];
                      data2 = dt.rows( { selected: true } ).data()[0]['id_pengajuan'];
                      if(data2 == '0'){            
                      	location.href = '<?php echo base_url('mahasiswa/'.$page.'/hapus/'); ?>'+data; //[Modif Disini]         
                      }
                      else{
                          swal({
                            title: "TIDAK DAPAT DI HAPUS",
                            text: "DATA SUDAH MASUK PENGAJUAN KOMPETENSI",
                            icon: "warning",
                            buttons: "Tutup",
                            dangerMode: true,
                          })
                        }
                      }
              }, 
                {
                    text: "<i class='fa fa-user-plus'></i> Input Pasien untuk Logbook",
                    extend: "selected",
                    className: "btnmaroon",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_logbook'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('mahasiswa/mhs_pasien/view/'); ?>'+data;
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
elseif ($page=="mhs_pasien")
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
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
            "url"  : "<?php echo base_url();?>mahasiswa/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "rm", "orderable":false, className : "text-center"},
                      { "data": "nama_pasien" },
                      { "data": "tgl_lahir", "searchable":false, "orderable":false },
                      { "data": "jk", "orderable":false, "searchable":false }
            ],
            "order": [[1, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah Pasien",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('mahasiswa/'.$page.'/tambah/'); ?><?php echo $id;?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
              {
                text: "<i class='fa fa-pencil-square'></i> Rubah Data",
                extend: "selected",
                className: "btnnavy",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_logbook_pasien'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('mahasiswa/'.$page.'/edit/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
                 {
                     text: "<i class='fa fa-close'></i> Hapus",
                     extend: "selected",
                     className: "btnred",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_logbook_pasien'];
                         data2 = dt.rows( { selected: true } ).data()[0]['jml_logbook'];
                     swal({
                       title: "HAPUS DATA ?",
                       text: "Data dihapus namun master pasien Tidak Hilang ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('mahasiswa/'.$page.'/hapus_pasien/'.$id.'/'); ?>'+data+'/'+data2; //[Modif Disini]
                       }
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
// =========================================================================
else if ($page=="profil"){
?>
document.addEventListener("DOMContentLoaded", function () {

    /* ============================
       INIT GLIGHTBOX
    ============================ */
    let lightbox = null;
    if (typeof GLightbox !== "undefined") {
        lightbox = GLightbox({
            selector: ".glightbox"
        });
    }


    /* ============================
       COVER UPLOAD + PREVIEW + GLIGHTBOX
    ============================ */
    const coverUpload = document.getElementById("coverUpload");
    const coverPreview = document.getElementById("coverPreview");
    const coverLightbox = document.getElementById("coverLightbox");

    if (coverUpload && coverPreview && coverLightbox) {
        coverUpload.addEventListener("change", function () {

            if (this.files && this.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    // update background cover
                    coverPreview.style.backgroundImage = "url(" + e.target.result + ")";
                    coverPreview.style.backgroundSize = "cover";
                    coverPreview.style.backgroundPosition = "top center";
                    coverPreview.style.backgroundRepeat = "no-repeat";

                    // update glightbox href cover
                    coverLightbox.setAttribute("href", e.target.result);

                    if (lightbox) {
                        lightbox.reload();
                    }
                };

                reader.readAsDataURL(this.files[0]);
            }
        });
    }


    /* ============================
       PROFILE UPLOAD + PREVIEW + GLIGHTBOX
    ============================ */
    const imageUpload = document.getElementById("imageUpload");
    const imgPreview = document.getElementById("imgPreview");
    const profileLightbox = document.getElementById("profileLightbox");

    if (imageUpload && imgPreview && profileLightbox) {
        imageUpload.addEventListener("change", function () {

            if (this.files && this.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    // preview circle
                    imgPreview.style.backgroundImage = "url(" + e.target.result + ")";
                    imgPreview.style.backgroundSize = "cover";
                    imgPreview.style.backgroundPosition = "center";
                    imgPreview.style.backgroundRepeat = "no-repeat";

                    // update glightbox href profile
                    profileLightbox.setAttribute("href", e.target.result);

                    if (lightbox) {
                        lightbox.reload();
                    }
                };

                reader.readAsDataURL(this.files[0]);
            }
        });
    }

});
$(document).ready(function() {
  flatpickr(".basic-date", {
      dateFormat: "d-m-Y"
  });
  $('.select-example').select2({
    width: '100%'
  });
  function checkField(fieldId) {
      var data = {};
      data[fieldId] = $('#' + fieldId).val();

      $.post('<?= base_url("member/check_unique") ?>', data, function(res){
          $('#' + fieldId + '_status').html(res);
      });
  }

  // realtime check
  $('#nip').on('keyup change', function(){ checkField('nip'); });
  $('#nik').on('keyup change', function(){ checkField('nik'); });
  $('#username').on('keyup change', function(){ checkField('username'); });
//  $('#email').on('keyup change', function(){ checkField('email'); });

      function refreshSelect2(selector) {
        if ($(selector).hasClass("select2-hidden-accessible")) {
            $(selector).select2("destroy");
        }
        $(selector).select2();
    }

    function resetSelect(selector, placeholder) {
        $(selector).empty();
        $(selector).append(`<option value="">${placeholder}</option>`);
        $(selector).val("");
        refreshSelect2(selector);
    }

    function loadSelect(url, selector, idField, textField, placeholder, selectedValue = "") {

        resetSelect(selector, placeholder);

        $.ajax({
            url: url,
            type: "POST",
            dataType: "json"
        }).done(function (data) {

            for (let i = 0; i < data.length; i++) {
                let id = data[i][idField];
                let name = data[i][textField];

                $(selector).append(`<option value="${id}">${name}</option>`);
            }

            refreshSelect2(selector);

            if (selectedValue !== "") {
                $(selector).val(selectedValue).trigger("change");
            }
        });
    }
    
    $("#id_prov").on("change", function () {
        let id_prov = $(this).val();

        resetSelect("#id_kab", "Belum Pilih Kabupaten");
        resetSelect("#id_kec", "Belum Pilih Kecamatan");
        resetSelect("#id_kel", "Belum Pilih Kelurahan");

        if (id_prov !== "") {
            loadSelect(
                "<?= base_url('member/kab_data/') ?>" + id_prov,
                "#id_kab",
                "id_kab",
                "nama_kab",
                "Belum Pilih Kabupaten"
            );
        }
    });

    // CHANGE KAB
    $("#id_kab").on("change", function () {
        let id_kab = $(this).val();

        resetSelect("#id_kec", "Belum Pilih Kecamatan");
        resetSelect("#id_kel", "Belum Pilih Kelurahan");

        if (id_kab !== "") {
            loadSelect(
                "<?= base_url('member/kec_data/') ?>" + id_kab,
                "#id_kec",
                "id_kec",
                "nama_kec",
                "Belum Pilih Kecamatan"
            );
        }
    });

    // CHANGE KEC
    $("#id_kec").on("change", function () {
        let id_kec = $(this).val();

        resetSelect("#id_kel", "Belum Pilih Kelurahan");

        if (id_kec !== "") {
            loadSelect(
                "<?= base_url('member/kel_data/') ?>" + id_kec,
                "#id_kel",
                "id_kel",
                "nama_kel",
                "Belum Pilih Kelurahan"
            );
        }
    });


    // =============================
    // AUTO LOAD UNTUK MODE EDIT
    // =============================
    let id_prov = "<?= $id_prov ?>";
    let id_kab  = "<?= $id_kab ?>";
    let id_kec  = "<?= $id_kec ?>";
    let id_kel  = "<?= $id_kel ?>";

    if (id_prov !== "") {
        loadSelect(
            "<?= base_url('member/kab_data/') ?>" + id_prov,
            "#id_kab",
            "id_kab",
            "nama_kab",
            "Belum Pilih Kabupaten",
            id_kab
        );
    }

    if (id_kab !== "") {
        loadSelect(
            "<?= base_url('member/kec_data/') ?>" + id_kab,
            "#id_kec",
            "id_kec",
            "nama_kec",
            "Belum Pilih Kecamatan",
            id_kec
        );
    }

    if (id_kec !== "") {
        loadSelect(
            "<?= base_url('member/kel_data/') ?>" + id_kec,
            "#id_kel",
            "id_kel",
            "nama_kel",
            "Belum Pilih Kelurahan",
            id_kel
        );
    }

});
<?php
}
else if ($page=="profils")
{
?>
var status = 0;
$(document).ready(function() {
//	$("body").addClass("sidebar-collapse");
	$('.select2').select2()
		$("#username").on("input", function(e) {
			$('#msg').hide();
			if ($('#username').val() == null || $('#username').val() == "") {
				$('#msg').show();
				$("#msg").html("Username Harus Diisi").css("color", "red");
			} else {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url();?>member/check_availability",
					data: $('#signupform').serialize(),
					dataType: "html",
					cache: false,
					success: function(msg) {
						$('#msg').show();
						$("#msg").html(msg);
					},
					error: function(jqXHR, textStatus, errorThrown) {
						$('#msg').show();
						$("#msg").html(textStatus + " " + errorThrown);
					}
				});
			}
		});
    $("#nip").on("input", function(e) {
			$('#msg2').hide();
			if ($('#nip').val() == null || $('#nip').val() == "") {
				$('#msg2').show();
				$("#msg2").html("Username Harus Diisi").css("color", "red");
			} else {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url();?>member/check_nip",
					data: $('#signupform').serialize(),
					dataType: "html",
					cache: false,
					success: function(msg2) {
						$('#msg2').show();
						$("#msg2").html(msg2);
					},
					error: function(jqXHR, textStatus, errorThrown) {
						$('#msg2').show();
						$("#msg2").html(textStatus + " " + errorThrown);
					}
				});
			}
		});
});
$('#tgl_lahir').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_lahir").inputmask("datetime", {
	mask: "1-2-y",
	placeholder: "dd-mm-yyyy",
	leapday: "-02-29",
	separator: "-",
	alias: "dd/mm/yyyy"
});
$('select[name=tipe_pegawai]').on('change',function(){
    $.ajax({
        url:'<?php echo base_url();?>member/jabfung_data/'+$(this).val(),
        type: "POST",
        dataType: 'json'
     }).done(function(data) {
        // alert(data[0]["nama_kab"]);
        // $('select[name=id_kab]').html(data);
           var len = data.length;
// alert("id="+data[1]["id_kab"]+" nama="+data[1]["nama_kab"]);
            $("#id_jabatan_fungsional").empty();
            for( var i = 0; i<len; i++){
                var id = data[i]["id_jabatan_fungsional"];
                var name = data[i]["nama_jabatan_fungsional"];

                $("#id_jabatan_fungsional").append("<option value='"+id+"'>"+name+"</option>");

            }
     }).fail(function() {

     }).always(function() {

    });
});
    $('select[name=id_prov]').on('change',function(){
        $.ajax({
            url:'<?php echo base_url();?>member/kab_data/'+$(this).val(),
            type: "POST",
            dataType: 'json'
         }).done(function(data) {
            // alert(data[0]["nama_kab"]);
            // $('select[name=id_kab]').html(data);
               var len = data.length;
// alert("id="+data[1]["id_kab"]+" nama="+data[1]["nama_kab"]);
                $("#id_kab").empty();
                $("#id_kec").empty();
                $("#id_kel").empty();
                for( var i = 0; i<len; i++){
                    var id = data[i]["id_kab"];
                    var name = data[i]["nama_kab"];

                    $("#id_kab").append("<option value='"+id+"'>"+name+"</option>");

                }
         }).fail(function() {

         }).always(function() {

        });
    });

    $('select[name=id_kab]').on('change',function(){
        $.ajax({
            url:'<?php echo base_url();?>member/kec_data/'+$(this).val(),
            type: "POST",
            dataType: 'json'
         }).done(function(data) {
               var len = data.length;
                $("#id_kec").empty();
                $("#id_kel").empty();

                for( var i = 0; i<len; i++){
                    var id = data[i]["id_kec"];
                    var name = data[i]["nama_kec"];

                    $("#id_kec").append("<option value='"+id+"'>"+name+"</option>");

                }
         }).fail(function() {

         }).always(function() {

        });
    });

    $('select[name=id_kec]').on('change',function(){
        $.ajax({
            url:'<?php echo base_url();?>member/kel_data/'+$(this).val(),
            type: "POST",
            dataType: 'json'
         }).done(function(data) {
               var len = data.length;
                $("#id_kel").empty();
                for( var i = 0; i<len; i++){
                    var id = data[i]["id_kel"];
                    var name = data[i]["nama_kel"];

                    $("#id_kel").append("<option value='"+id+"'>"+name+"</option>");

                }
         }).fail(function() {

         }).always(function() {

        });
    });
<?php
}
elseif ($page=="berkas")
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
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
                "url"  : "<?php echo base_url();?>member/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "tgl_sort", "searchable":false, "visible":false },
					  { "data": "nama_berkas", "orderable":false },
					  { "data": "no_berkas", "orderable":false },
					  { "data": "nama_berkas_kategori", "searchable":false, "orderable":false },
					  { "data": "link_berkas", "searchable":false, "orderable":false, 
						"render": function(data, type, row){
							if (row.link_berkas === '') {
							   return '<button class="btn btn-xs btn-danger"> Belum Ada File</button>';
						  	 } else if (row.link_berkas === null) {
						  	 	return '<button class="btn btn-xs btn-danger"> Belum Ada File</button>';
						  	 } else {
							    return '<button class="btn btn-xs btn-success"><i class="fa fa-search"></i> Klik Lihat Berkas</button>';
						   	 } 
						 }
					   }
            ],
            "order": [[0, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                 {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnlime",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('member/'.$page.'/tambah'); ?>';
                    }
                },
                {
                    text: "<i class='fa fa-pencil'></i> Rubah",
                    extend: "selected",
                    className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_berkas'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('member/'.$page.'/edit/'); ?>'+data;
                    }
                },
              {
                text: "<i class='fa fa-search'></i> Lihat Berkas",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                  //    data = dt.rows( { selected: true } ).data()[0]['id_pendaftaran_unit'];
                      data = dt.rows( { selected: true } ).data()[0]['link_berkas'];
                      if(data !== null && data !== ''){						
						window.open('<?php echo base_url('assets/berkas/ol/'); ?>'+data);
                      }
                      else{
                          swal({
                            title: "FILE BELUM ADA",
                            text: "SILAHKAN UPLOAD DI MENU RUBAH",
                            icon: "warning",
                            buttons: "Tutup",
                            dangerMode: true,
                          })
                        }
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
elseif ($page=="blaporan")
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
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
                "url"  : "<?php echo base_url();?>member/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_berkas", "searchable":false, "visible":false },
                      { "data": "nama_berkas" },
                      { "data": "no_berkas" },
                      { "data": "nama_berkas_kategori", "searchable":false },
                      { "data": "link_berkas", "searchable":false, 
                        "render": function(data, type, row){
                            if (row.link_berkas === '') {
                               return '<button class="btn btn-xs btn-danger"> Belum Ada File</button>';
                             } else if (row.link_berkas === null) {
                                return '<button class="btn btn-xs btn-danger"> Belum Ada File</button>';
                             } else {
                                return '<button class="btn btn-xs btn-success"><i class="fa fa-search"></i> Klik Lihat Berkas</button>';
                             } 
                         }
                       }
            ],
            "order": [[0, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                 {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnlime",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('member/'.$page.'/tambah'); ?>';
                    }
                },
                {
                    text: "<i class='fa fa-pencil'></i> Rubah",
                    extend: "selected",
                    className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_berkas'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('member/'.$page.'/edit/'); ?>'+data;
                    }
                },
              {
                text: "<i class='fa fa-search'></i> Lihat Berkas",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                  //    data = dt.rows( { selected: true } ).data()[0]['id_pendaftaran_unit'];
                      data = dt.rows( { selected: true } ).data()[0]['link_berkas'];
                      if(data !== null && data !== ''){                     
                        window.open('<?php echo base_url('assets/berkas/ol/'); ?>'+data);
                      }
                      else{
                          swal({
                            title: "FILE BELUM ADA",
                            text: "SILAHKAN UPLOAD DI MENU RUBAH",
                            icon: "warning",
                            buttons: "Tutup",
                            dangerMode: true,
                          })
                        }
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
elseif ($page=="ijasah")
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
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
                "url"  : "<?php echo base_url();?>member/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "tgl_sort", "searchable":false, "visible":false },
					  { "data": "nama_berkas", "orderable":false },
					  { "data": "nama_pendidikan", "searchable":false, "orderable":false },
					  { "data": "no_berkas", "searchable":false, "orderable":false },
					  { "data": "tgl_b_berkas", "searchable":false, "orderable":false },
					  { "data": "link_berkas", "searchable":false, "orderable":false, 
						"render": function(data, type, row){
							if (row.link_berkas === '') {
							   return '<button class="btn btn-xs btn-danger"> Belum Ada File</button>';
						  	 } else if (row.link_berkas === null) {
						  	 	return '<button class="btn btn-xs btn-danger"> Belum Ada File</button>';
						  	 } else {
							    return '<button class="btn btn-xs btn-success"><i class="fa fa-search"></i> Klik Lihat Berkas</button>';
						   	 } 
						 }
					   }

            ],
            "order": [[0, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                 {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnlime",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('member/'.$page.'/tambah'); ?>';
                    }
                },
                {
                    text: "<i class='fa fa-pencil'></i> Rubah",
                    extend: "selected",
                    className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_berkas'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('member/'.$page.'/edit/'); ?>'+data;
                    }
                },
              {
                text: "<i class='fa fa-search'></i> Lihat Berkas",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                  //    data = dt.rows( { selected: true } ).data()[0]['id_pendaftaran_unit'];
                      data = dt.rows( { selected: true } ).data()[0]['link_berkas'];
                      if(data !== null && data !== ''){						
						window.open('<?php echo base_url('assets/berkas/ol/'); ?>'+data);
                      }
                      else{
                          swal({
                            title: "FILE BELUM ADA",
                            text: "SILAHKAN UPLOAD DI MENU RUBAH",
                            icon: "warning",
                            buttons: "Tutup",
                            dangerMode: true,
                          })
                        }
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
elseif ($page=="pelatihan")
{
?>
    function format ( d ) {        // `d` is the original data object for the row
      return '<table class="table table-striped text-muted style="padding-left:50px; ">'+
	  '<tr> <td>Penyelenggara :</td><td>'+d.penyelenggara+'</td> <td></td><td>No SK / Sertifikat :</td><td>'+d.no_sertifikat+'</td> </tr>'+
	  '<tr> <td>Kategori Pelatihan :</td><td>'+d.nama_kategori_pelatihan+'</td> <td></td><td>Kategori :</td><td>'+d.nama_berkas_kategori+'</td> </tr>'+
        '</table>';
    }
	$("#search-inp").keypress(function(event) {
		var character = String.fromCharCode(event.keyCode);
		return isValid(character);
	});
	function isValid(str) {
		return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
	}
    $(document).ready(function() {
		$('.select2').select2()
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
                "url"  : "<?php echo base_url();?>member/<?php echo $page;?>/data",
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
                      { "data": "tgl_sort", "searchable":false, "visible":false },
					  { "data": "nama_berkas", "orderable":false },
					  { "data": "kredit", "searchable":false },
					  { "data": "tgl_a_berkas", "searchable":false, "orderable":false },
					  { "data": "tgl_b_berkas", "searchable":false, "orderable":false },
					  { "data": "link_berkas", "searchable":false, "orderable":false, 
						"render": function(data, type, row){
							if (row.link_berkas === '') {
							   return '<button class="btn btn-xs btn-danger"> Belum Ada File</button>';
						  	 } else if (row.link_berkas === null) {
						  	 	return '<button class="btn btn-xs btn-danger"> Belum Ada File</button>';
						  	 } else {
							    return '<button class="btn btn-xs btn-success"><i class="fa fa-search"></i> Klik Lihat Berkas</button>';
						   	 } 
						 }
					   }

            ],
            "order": [[1, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                 {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnlime",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('member/'.$page.'/tambah'); ?>';
                    }
                },
                {
                    text: "<i class='fa fa-pencil'></i> Rubah",
                    extend: "selected",
                    className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_berkas'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('member/'.$page.'/edit/'); ?>'+data;
                    }
                },
              {
                text: "<i class='fa fa-search'></i> Lihat Berkas",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                  //    data = dt.rows( { selected: true } ).data()[0]['id_pendaftaran_unit'];
                      data = dt.rows( { selected: true } ).data()[0]['link_berkas'];
                      if(data !== null && data !== ''){						
						window.open('<?php echo base_url('assets/berkas/ol/'); ?>'+data);
                      }
                      else{
                          swal({
                            title: "FILE BELUM ADA",
                            text: "SILAHKAN UPLOAD DI MENU RUBAH",
                            icon: "warning",
                            buttons: "Tutup",
                            dangerMode: true,
                          })
                        }
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
elseif ($page=="surat_ijin")
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
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
                "url"  : "<?php echo base_url();?>member/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "tgl_sort", "searchable":false, "visible":false },
					  { "data": "nama_berkas", "orderable":false },
					  { "data": "nama_berkas_kategori", "orderable":false },
					  { "data": "no_berkas", "orderable":false },
					  { "data": "tgl_a_berkas", "orderable":false },
					  { "data": "tgl_b_berkas", "searchable":false, "orderable":false, 
						"render": function(data, type, row, full){
							if (row.lifetime_berkas === '1') {
							   return '<button class="btn btn-xs btn-success">SEUMUR HIDUP</button>';
						  	 } else {
								return row['tgl_b_berkas'];
						   	 } 
						 }
					   },
					  { "data": "status_berkas", "searchable":false, 
						"render": function(data, type, row){
							if (row.lifetime_berkas === '1') {
							   return '<button class="btn btn-xs btn-success">SEUMUR HIDUP</button>';
						  	 } else {
								if (row.status_berkas === '0') {
								   return '<button class="btn btn-xs btn-danger"> EXPIRED</button>';
							  	 } else {
								    return '<button class="btn btn-xs btn-success"> AKTIF</button>';
						   	 	} 
						   	 } 
						 }
					   },
					  { "data": "link_berkas", "searchable":false, 
						"render": function(data, type, row){
							if (row.link_berkas === '') {
							   return '<button class="btn btn-xs btn-danger"> Belum Ada File</button>';
						  	 } else if (row.link_berkas === null) {
						  	 	return '<button class="btn btn-xs btn-danger"> Belum Ada File</button>';
						  	 } else {
							    return '<button class="btn btn-xs btn-success"><i class="fa fa-search"></i> Klik Lihat Berkas</button>';
						   	 } 
						 }
					   }

            ],
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                 {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnlime",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('member/'.$page.'/tambah'); ?>';
                    }
                },
                {
                    text: "<i class='fa fa-pencil'></i> Rubah",
                    extend: "selected",
                    className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_berkas'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('member/'.$page.'/edit/'); ?>'+data;
                    }
                },
                {
                    text: "<i class='fa fa-plus'></i> Perpanjangan Berkas",
                    extend: "selected",
                    className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_berkas'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('member/'.$page.'/perpanjangan/'); ?>'+data;
                    }
                },
              {
                text: "<i class='fa fa-search'></i> Lihat Berkas",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                  //    data = dt.rows( { selected: true } ).data()[0]['id_pendaftaran_unit'];
                      data = dt.rows( { selected: true } ).data()[0]['link_berkas'];
                      if(data !== null && data !== ''){						
						window.open('<?php echo base_url('assets/berkas/ol/'); ?>'+data);
                      }
                      else{
                          swal({
                            title: "FILE BELUM ADA",
                            text: "SILAHKAN UPLOAD DI MENU RUBAH",
                            icon: "warning",
                            buttons: "Tutup",
                            dangerMode: true,
                          })
                        }
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
elseif ($page=="berkas_tambah" || $page=="ijasah_tambah" || $page=="pelatihan_tambah" || $page=="surat_ijin_tambah" || $page=="berkas_edit" || $page=="ijasah_edit" || $page=="pelatihan_edit" || $page=="surat_ijin_edit" || $page=="surat_ijin_perpanjangan")
{
?>
$('#first_date').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#first_date").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#last_date').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#last_date").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
    $(document).ready(function() {
		$('.select2').select2()
	});
<?php
}
elseif ($page=="peminatan")
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
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
                "url"  : "<?php echo base_url();?>member/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_minat","searchable":false,"visible":false },
                      { "data": "nama_pegawai" },
                      { "data": "nama_peminatan" },
                                          { "data": "status_minat",
                                            "render": function(data, type, row){
                                                if (row.status_peminatan === '0') {
                                                   return '<button class="btn btn-xs btn-danger">NON AKTIF</button>';
                                               } else {
                                                   return '<button class="btn btn-xs btn-success">AKTIF</button>';
                                               }
                                            }
                                         }
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
                          $('.modal-body').load('<?php echo base_url('member/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
              {
                text: "<i class='fa fa-edit'></i> Rubah",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_minat'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/edit/'); ?>'+data,function(){
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
elseif ($page=="pengcab")
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
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
                "url"  : "<?php echo base_url();?>member/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_pegawai","searchable":false,"visible":false },
                      { "data": "nama_pengcab" },
            ],
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
              {
                text: "<i class='fa fa-edit'></i> Rubah",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_pegawai'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/edit/'); ?>'+data,function(){
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
elseif ($page=="absen")
{
?>
$('#id').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#id").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#id2').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#id2").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
<?php
if($jml > 0){
?>
/*function detectLocation()
{
  log("detectLocation() starting");
  if (navigator.geolocation)
  {
    log("navigator.geolocation is supported");
    navigator.geolocation.getCurrentPosition(geocodePosition, onError, { timeout: 30000 });
    navigator.geolocation.watchPosition(watchGeocodePosition);
  }
  else
  {
    log("navigator.geolocation not supported");
  }
}
function geocodePosition(){
    log("geocodePosition() starting");
}

function watchGeocodePosition(){
    log("watchGeocodePosition() starting");
}

function onError(error){
    log("error " + error.code);
}
function log(msg){
    document.getElementById("status").innerHTML = new Date() + " :: " + msg + "<br/>" + document.getElementById("status").innerHTML;
}*/
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    alert("Geolocation is not supported by this browser.");
  }

  function showPosition(position) {
    var latitude  = position.coords.latitude;
    var longitude = position.coords.longitude;
    var latlong   = latitude + ', ' + longitude;
    $('#location').val(latlong);

    const map = L.map('map').setView([latitude, longitude], <?= $zoom ?>);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: ''
    }).addTo(map);

    var Mylocation = L.icon({
      iconUrl: '<?= base_url('assets/img/icon/mark-office.png'); ?>',

      iconSize:     [38, 38], // size of the icon
      shadowSize:   [50, 64], // size of the shadow
      iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
      popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
    });

    L.marker([latitude, longitude], {icon: Mylocation}).addTo(map)
      .bindPopup('My Location')
      .openPopup();

    var officeIcon = L.icon({
      iconUrl: '<?= base_url('assets/img/icon/office-center.png'); ?>',

      iconSize:     [38, 95], // size of the icon
      shadowSize:   [50, 64], // size of the shadow
      iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
      popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
    });

    L.marker([<?= $base_location ?>], {icon: officeIcon}).addTo(map)
      .bindPopup('<?= $nama_unit ?>');

    L.circle([<?= $base_location ?>], {
      color: 'blue',
      fillColor: 'blue',
      fillOpacity: 0.5,
      radius: <?= $radius ?>
    }).addTo(map);
  }
<?php
}
?>
    $(document).ready(function() {
    //    detectLocation();
        $('.select2').select2()
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
                "url"  : "<?php echo base_url();?>member/<?php echo $page;?>/data/<?php echo $id;?>/<?php echo $id2;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "tgl_sort", "searchable":false, "visible":false },
                      { "data": "tgl_absen", "searchable":false },
                      { "data": "nama_pegawai", "searchable":false },
                      { "data": "nama_kategori_absen", "searchable":false },
                      { "data": "clock_in", "searchable":false },
                      { "data": "clock_out", "searchable":false }
            ],
            "order": [[2, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
              {
                text: "<i class='fa fa-sign-in'></i> Lihat Absen Masuk",
                extend: "selected",
                className: "btnyellow",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_absen'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/lihat_in/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
              {
                text: "<i class='fa fa-sign-out'></i> Lihat Absen Pulang",
                extend: "selected",
                className: "btnred",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_absen'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/lihat_out/'); ?>'+data,function(){
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
<?php
}
elseif ($page=="logbook")
{
?>
$('#first_date').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#first_date").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#last_date').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#last_date").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
function format ( d ) {        // `d` is the original data object for the row
  return '<table class="table table-striped text-muted style="padding-left:50px; ">'+
  '<tr> <td>Pencatatan Registrasi Pasien:</td></tr>'+
  '<tr> <td>'+d.rm+'</td></tr>'+
    '</table>';
}
	$("#search-inp").keypress(function(event) {
		var character = String.fromCharCode(event.keyCode);
		return isValid(character);
	});
	function isValid(str) {
		return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
	}
    $(document).ready(function() {
		$('.select2').select2()
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
                "url"  : "<?php echo base_url();?>ol_logbook/<?php echo $page;?>/data/<?php echo $first_date;?>/<?php echo $last_date;?>/<?php echo $id_ruangan;?>/<?php echo $pxe;?>",
                "type" : "POST"
            },
            "columns": [
                {
                    "className": 'details-control text-center',
                    "orderable": false,
                    "searchable":false,
                    "data":      null,
                    "defaultContent": ''
                },
                      { "data": "id_logbook", "searchable":false, "visible":false },
                      { "data": "tgl_logbook", "searchable":false },
					  { "data": "kode_unit", "searchable":false },
					  { "data": "nama_kompetensi" },
                      { "data": "jml_logbook", "searchable":false, className: "text-right" },
                      { "data": "nama_sifat_kewenangan", "searchable":false },
                      { "data": "nama_working", "searchable":false }
            ],
            "order": [[2, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-book'></i> <i class='fa fa-plus'></i> Isi Log Book",
                    className: "btnfuchsia",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
							location.href = '<?php echo base_url('ol_logbook/'.$page.'/tambah'); ?>';
                    }
                },
              {
                text: "<i class='fa fa-pencil-square'></i> Edit",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                      data = dt.rows( { selected: true } ).data()[0]['barcode_logbook'];
                      data2 = dt.rows( { selected: true } ).data()[0]['id_pengajuan'];
                      if(data2 == '0'){                     
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('ol_logbook/'.$page.'/edit/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });
                      }
                      else{
                          swal({
                            title: "TIDAK DAPAT DI EDIT",
                            text: "DATA SUDAH MASUK PENGAJUAN KOMPETENSI",
                            icon: "warning",
                            buttons: "Tutup",
                            dangerMode: true,
                          })
                        }
                      }
              },  
              {
                text: "<i class='fa fa-close'></i> Hapus",
                extend: "selected",
                className: "btnred",
                  action: function ( e, dt, node, config ) {
                      data = dt.rows( { selected: true } ).data()[0]['id_logbook'];
                      data2 = dt.rows( { selected: true } ).data()[0]['id_pengajuan'];
                      if(data2 == '0'){            
                      	location.href = '<?php echo base_url('ol_logbook/'.$page.'/hapus/'); ?>'+data; //[Modif Disini]         
                      }
                      else{
                          swal({
                            title: "TIDAK DAPAT DI HAPUS",
                            text: "DATA SUDAH MASUK PENGAJUAN KOMPETENSI",
                            icon: "warning",
                            buttons: "Tutup",
                            dangerMode: true,
                          })
                        }
                      }
              }, 
                {
                    text: "<i class='fa fa-user-plus'></i> Input Pasien untuk Logbook",
                    extend: "selected",
                    className: "btnmaroon",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_logbook'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('member/pasien/view/'); ?>'+data;
                    }
                },
                {
                    text: "<i class='fa fa-plus'></i> Tambah Signature / TTD di Logbook",
                    className: "btnorange",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                   action: function ( e, dt, node, config ) {  
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('ol_logbook/'.$page.'/sign'); ?>',
                          function(){
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
elseif($page=='logbook_tambah' || $page=='mhs_logbook_tambah' || $page=='logbook_non_keperawatan' || $page=='seting_dupak_tambah' || $page=='seting_dupak_transfer')
{
?>
$(function(){
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
	  'scrollX'		: true ,
	  'scrollX'			: true,
	  'scrollY'			: '350px',
	  'scrollCollapse'	: true,
    })
});
<?php
}
elseif($page=='logbook_isi' || $page=='mhs_logbook_isi')
{
?>
$('#tgl_logbook').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_logbook").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
    $(document).ready(function() {
		$('.select2').select2()
<?php  
$no= 0;
foreach($kr_kewenangan as $row){
	if(in_array($row['id_kewenangan'], $terpilih)){
	$jml_log = $this->m_ol_rancak->jumlah_record_logbook($row['id_kewenangan']);
		if($jml_log == 0){
		$no++;  
    ?>
        CKEDITOR.replace('editor<?= $no ?>', {enterMode: CKEDITOR.ENTER_BR});
    <?php 
		}
	}
}
?>
	});
<?php
}
elseif ($page=="ps_pakai")
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
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
            "url"  : "<?php echo base_url();?>member/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_logbook_pakai", "visible":false },
                      { "data": "nama_bahan" },
                      { "data": "jml_bahan", "searchable":false, "orderable":false }
            ],
            "order": [[0, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah BAKHP",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('member/'.$page.'/tambah/'); ?><?php echo $id;?>/<?php echo $idp;?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
              {
                text: "<i class='fa fa-pencil-square'></i> Rubah BAKHP",
                extend: "selected",
                className: "btnnavy",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_logbook_pakai'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/edit/'); ?>'+data+'/<?php echo $id;?>/<?php echo $idp;?>',function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
                 {
                     text: "<i class='fa fa-close'></i> Hapus",
                     extend: "selected",
                     className: "btnred",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_logbook_pakai'];
                     swal({
                       title: "HAPUS DATA ?",
                       text: "Data dihapus namun master pasien Tidak Hilang ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('member/'.$page.'/hapus_pakai/'); ?>'+data+'/<?php echo $id;?>/<?php echo $idp;?>'; //[Modif Disini]
                       }
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
elseif ($page=="ps_reject")
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
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
            "url"  : "<?php echo base_url();?>member/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_logbook_reject", "visible":false },
                      { "data": "nama_bahan" },
                      { "data": "jml_reject", "searchable":false, "orderable":false },
                      { "data": "nama_reject" },
            ],
            "order": [[1, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah Reject",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('member/'.$page.'/tambah/'); ?><?php echo $id;?>/<?php echo $idp;?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
              {
                text: "<i class='fa fa-pencil-square'></i> Rubah Reject",
                extend: "selected",
                className: "btnnavy",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_logbook_reject'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/edit/'); ?>'+data+'/<?php echo $id;?>/<?php echo $idp;?>',function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
                 {
                     text: "<i class='fa fa-close'></i> Hapus",
                     extend: "selected",
                     className: "btnred",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_logbook_reject'];
                     swal({
                       title: "HAPUS DATA ?",
                       text: "Data dihapus namun master pasien Tidak Hilang ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('member/'.$page.'/hapus_reject/'); ?>'+data+'/<?php echo $id;?>/<?php echo $idp;?>'; //[Modif Disini]
                       }
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
elseif ($page=="pasien")
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
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
            "url"  : "<?php echo base_url();?>member/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "rm", "orderable":false, className : "text-center"},
                      { "data": "nama_pasien" },
                      { "data": "tgl_lahir", "searchable":false, "orderable":false },
                      { "data": "jk", "orderable":false, "searchable":false }
            ],
            "order": [[1, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah Pasien",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('member/'.$page.'/tambah/'); ?><?php echo $id;?>/<?php echo $idp;?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
              {
                text: "<i class='fa fa-pencil-square'></i> Rubah Data",
                extend: "selected",
                className: "btnpurple",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_logbook_pasien'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/edit/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
                {
                    text: "<i class='fa fa-edit'></i> BAKHP",
                    extend: "selected",
                    className: "btnnavy",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_logbook_pasien'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('member/ps_pakai/view/'); ?>'+data+'/<?php echo $id;?>';
                    }
                },
                {
                    text: "<i class='fa fa-edit'></i> REJECT",
                    extend: "selected",
                    className: "btnmaroon",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_logbook_pasien'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('member/ps_reject/view/'); ?>'+data+'/<?php echo $id;?>';
                    }
                },
                 {
                     text: "<i class='fa fa-close'></i> Hapus",
                     extend: "selected",
                     className: "btnred",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_logbook_pasien'];
                         data2 = dt.rows( { selected: true } ).data()[0]['jml_logbook'];
                     swal({
                       title: "HAPUS DATA ?",
                       text: "Data dihapus namun master pasien Tidak Hilang ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('member/'.$page.'/hapus_pasien/'.$id.'/'); ?>'+data+'/'+data2; //[Modif Disini]
                       }
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
elseif ($page=="ps_pakai_tXambah")
{
?>
$('#rm').keypress(function (e) {
    var regex = new RegExp("^[a-zA-Z0-9_]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }
    e.preventDefault();
    return false;
});
$('#rm').on("input",function(event) {
  var current = $(this).val();
  var replaced = current.replace(/[^a-zA-Z0-9 _]/g,'');
  $(this).val(replaced);
});
$(document).ready(function() {
	$('.select2').select2();
$(document).on('click', '.add', function(){
var html = '';
html += '<tr>';
html += '<td class="text-sm text-label border-0"><select name="id_bahan[]" required="required" class="select_bahan form-control select2"><option value="0">Jenis BAKHP</option></select></td>';
html += '<td class="text-sm text-label border-0"><input type="text" name="jml_bahan[]" value="0" class="form-control" style="text-align:right;"  onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="3"/></td>';
html += '<td class="text-sm text-label border-0"><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
$('#item_table').append(html); 
$('.select2').select2(); 		 
		  $(".select_bahan").select2({
			ajax: {
				url: '<?php echo base_url();?>ol_logbook/data_bahan',
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		  });	
/*		  $(".select_reject").select2({
			ajax: {
				url: '?php echo base_url();?>ol_logbook/data_reject',
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		  });*/	
		$('#rm').keypress(function (e) {
		    var regex = new RegExp("^[a-zA-Z0-9_]+$");
		    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		    if (regex.test(str)) {
		        return true;
		    }
		    e.preventDefault();
		    return false;
		});
		$('#rm').on("input",function(event) {
		  var current = $(this).val();
		  var replaced = current.replace(/[^a-zA-Z0-9 _]/g,'');
		  $(this).val(replaced);
		});
});
$(document).on('click', '.remove', function(){
$(this).closest('tr').remove();
}); 
});
<?php
}
elseif ($page=="pasien2")
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
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
            "url"  : "<?php echo base_url();?>member/<?php echo $page;?>/data_pasien/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "rm", className : "text-center"},
                      { "data": "nama_pasien" },
                      { "data": "tgl_lahir", "searchable":false, "orderable":false },
                      { "data": "jk", "orderable":false, "searchable":false },
                      { "data": "nama_working", "orderable":false, "searchable":false }
            ],
            "order": [[0, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah Pasien",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('member/'.$page.'/tambah/'); ?><?php echo $id;?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
              {
                text: "<i class='fa fa-pencil-square'></i> Rubah Data Pasien",
                extend: "selected",
                className: "btnnavy",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_pasien'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/rubah/'.$id.'/'.$idl.'/'); ?>'+data,function(){
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
elseif ($page=="unit")
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
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
                "url"  : "<?php echo base_url();?>member/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_pegawai_unit","searchable":false,"visible":false },
                      { "data": "nama_unit" },
                      { "data": "nama_working","searchable":false },
                                          { "data": "status_pegawai_unit",
                                            "render": function(data, type, row){
                                                if (row.status_unit === '0') {
                                                   return '<button class="btn btn-xs btn-danger">NON AKTIF</button>';
                                               } else {
                                                   return '<button class="btn btn-xs btn-success">AKTIF</button>';
                                               }
                                            }
                                         }
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
                          $('.modal-body').load('<?php echo base_url('member/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
              {
                text: "<i class='fa fa-edit'></i> Rubah",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_pegawai_unit'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/edit/'); ?>'+data,function(){
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
elseif ($page=="pengajuan_kompetensi")
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
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
                "url"  : "<?php echo base_url();?>member/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_pengajuan", "searchable":false },
                      { "data": "tgl_pengajuan", "searchable":false },
                      { "data": "nama_status_diusulkan", "searchable":false },
					  { "data": "status_pengajuan",
						"render": function(data, type, row){
							if (row.status_pengajuan === 'Belum Terkirim') {
							   return '<button class="btn btn-xs btn-danger"> Belum Terkirim</button>';
						   } else {
							   return '<button class="btn btn-xs btn-success"> Terkirim</button>';
						   }
						}
					  },
					  { "data": "acc_kabid",
						"render": function(data, type, row){
							if (row.status_pengajuan === 'Belum Terkirim') {
							   return '<button class="btn btn-xs btn-default"> Belum Terkirim</button>';
							}else if (row.acc_kabid === 'Proses') {
							   return '<button class="btn btn-xs btn-default"> Proses</button>';
						   } else if (row.acc_kabid === 'Kompeten') {
							   return '<button class="btn btn-xs btn-success"> Kompeten</button>';
						   } else {
							   return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
						   }
						}
					  },
					  { "data": "acc_asesor",
						"render": function(data, type, row){
							if (row.status_pengajuan === 'Belum Terkirim') {
							   return '<button class="btn btn-xs btn-default"> Belum Terkirim</button>';
						   } else if (row.acc_asesor === 'Proses') {
							   return '<button class="btn btn-xs btn-default"> Proses</button>';
						   } else if (row.acc_asesor === 'Kompeten') {
							   return '<button class="btn btn-xs btn-success"> Kompeten</button>';
						   } else {
							   return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
						   }
						}
					  },
					 { "data": "nama_pegawai", "searchable":false },
					  { "data": "acc_komite",
						"render": function(data, type, row){
							if (row.status_pengajuan === 'Belum Terkirim') {
							   return '<button class="btn btn-xs btn-default"> Belum Terkirim</button>';
						   } else if (row.acc_komite === 'Proses') {
							   return '<button class="btn btn-xs btn-default"> Proses</button>';
						   } else if (row.acc_komite === 'Kompeten') {
							   return '<button class="btn btn-xs btn-success"> Kompeten</button>';
						   } else {
							   return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
						   }
						}
					  },
					  { "data": "acc_direktur",
						"render": function(data, type, row){
							if (row.status_pengajuan === 'Belum Terkirim') {
							   return '<button class="btn btn-xs btn-default"> Belum Terkirim</button>';
						   } else if (row.acc_direktur === 'Proses') {
							   return '<button class="btn btn-xs btn-default"> Proses</button>';
						   } else if (row.acc_direktur === 'Kompeten') {
							   return '<button class="btn btn-xs btn-success"> Kompeten</button>';
						   } else {
							   return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
						   }
						}
					  },
					  { "data": "status_terbitkan",
						"render": function(data, type, row){
							if (row.status_pengajuan === 'Belum Terkirim') {
							   return '<button class="btn btn-xs btn-default"> Belum Terkirim</button>';
						   } else if (row.status_terbitkan === 'Belum Diterbitkan') {
							   return '<button class="btn btn-xs btn-warning"> Belum Diterbitkan</button>';
						   } else if (row.status_terbitkan === 'Terbitkan') {
							   return '<button class="btn btn-xs btn-success"> Terbitkan</button>';
						   } else {
							   return '<button class="btn btn-xs btn-danger"> Tidak diterbitkan</button>';
						   }
						}
					  }
            ],
            "order": [[0, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-edit'></i> Lengkapi Pengajuan",
                    extend: "selected",
                    className: "btnolive",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_pengajuan'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('member/'.$page.'/isi/'); ?>'+data;
                    }
                },
                {
                    text: "<i class='fa fa-plus'></i> Pengajuan Kredensial / Non Perawat",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                    	<?php
                    		if($jml_pegdet > 0){
                    	?>
                           swal({
                            title: "NON KEPERAWATAN",
                            text: "Ada Data Penugasan Klinis",
                            icon: "warning",
                            buttons: "Tutup",
                            dangerMode: true,
                          })                   	
                    	<?php 		
                    		}else{
                    	?>
	                         $("#modal-default").modal();
	                          $('.modal-body').load('<?php echo base_url('member/'.$page.'/tambah/2'); ?>',function(){
	                            $('#modal-default').modal({show:true});
	                          });
                          <?php
							}
                          ?>
                    }
                },
                {
                    text: "<i class='fa fa-plus'></i> Pengajuan Perawat Kenaikan Tingkat",
                    className: "btnlightblue",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                    	<?php
                    		if($jml_pegdet == 0){
                    	?>
                           swal({
                            title: "KEPERAWATAN",
                            text: "Tidak Ada Data Penugasan Klinis",
                            icon: "warning",
                            buttons: "Tutup",
                            dangerMode: true,
                          })                   	
                    	<?php 		
                    		}else{
                    	?>
	                        $("#modal-default").modal();
	                          $('.modal-body').load('<?php echo base_url('member/'.$page.'/tambah/1'); ?>',function(){
	                            $('#modal-default').modal({show:true});
	                          });
                          <?php
							}
                          ?>
                    }
                },
                {
                    text: "<i class='fa fa-plus'></i> Pengajuan Perawat Pemulihan Kewenangan",
                    className: "btnpurple",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
             	<?php
                    		if($jml_pegdet == 0  OR $jml_yang_ditolak == 0){
                    	?>
                           swal({
                            title: "KEPERAWATAN",
                            text: "Tidak Ada Data Penugasan Klinis / Kewenangan Tertolak",
                            icon: "warning",
                            buttons: "Tutup",
                            dangerMode: true,
                          })                   	
                    	<?php 		
                    		}else{
                    	?>
	                        $("#modal-default").modal();
	                          $('.modal-body').load('<?php echo base_url('member/'.$page.'/tambah/4'); ?>',function(){
	                            $('#modal-default').modal({show:true});
	                          });
                          <?php
							}
                          ?>
                    }
                },
                {
                    text: "<i class='fa fa-plus'></i> Pengajuan Perawat Penambahan Kompetensi",
                    className: "btnfuchsia",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                    	<?php
                    		if($jml_pegdet == 0){
                    	?>
                           swal({
                            title: "KEPERAWATAN",
                            text: "Tidak Ada Data Penugasan Klinis",
                            icon: "warning",
                            buttons: "Tutup",
                            dangerMode: true,
                          })                   	
                    	<?php 		
                    		}else{
                    	?>
	                      $("#modal-default").modal();
	                          $('.modal-body').load('<?php echo base_url('member/'.$page.'/tambah/3'); ?>',function(){
	                            $('#modal-default').modal({show:true});
	                          });
                          <?php
							}
                          ?>
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
elseif ($page=="pengajuan_kompetensi_tambah")
{
?>
$(document).ready(function() {
	$('.select2').select2()
});
<?php
}
if ($page=="pengajuan_kompetensi_isi")
{
?>
    function format ( d ) {        // `d` is the original data object for the row
      return '<table class="table table-striped text-muted style="padding-left:50px; ">'+
	  '<tr> <td colspan="2">RM:</td><td colspan="2">'+d.rm+'</td> <td colspan="2">Jam :</td><td colspan="2">'+d.jam_logbook+'</td></tr>'+
	  '<tr> <td colspan="2">Tgl Karu:</td><td colspan="2">'+d.tgl_v_karu+'</td> <td colspan="2">Acc Kabid:</td><td colspan="2">'+d.tgl_v_kabid+'</td></tr>'+
	  '<tr> <td colspan="2">Acc Asesor:</td><td colspan="2">'+d.tgl_v_asesor+'</td> <td colspan="2">Acc Komite:</td><td colspan="2">'+d.tgl_v_komite+'</td></tr>'+
	  '<tr> <td colspan="2">Acc Direktur:</td><td colspan="2">'+d.tgl_v_direktur+'</td> <td colspan="2">Acc Komite:</td><td colspan="2">'+d.tgl_v_komite+'</td></tr>'+
      '</table>';
    }
	$("#search-inp").keypress(function(event) {
		var character = String.fromCharCode(event.keyCode);
		return isValid(character);
	});
	function isValid(str) {
		return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
	}
    $(document).ready(function() {
		$('.select2').select2()
		<?php if($id_status_diusulkan == 4){ ?>
        var table2 = $('#dttb2').DataTable( {
            "processing": true,
            "serverSide": true,
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
                "url"  : "<?php echo base_url();?>member/pengajuan_kompetensi/pemulihan/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_logbook_pemulihan", "searchable":false, "visible":true },
                      { "data": "tgl_awal", "searchable":false },
					  { "data": "tgl_akhir", "searchable":false },
					  { "data": "nama_pegawai", "searchable":false },
                      { "data": "nama_ruangan", "searchable":false },
					  { "data": "result_pemulihan",
						"render": function(data, type, row){
							if (row.result_pemulihan === '0') {
							   return '<button class="btn btn-xs btn-default"> Proses</button>';
						   } else if (row.result_pemulihan === '1') {
							   return '<button class="btn btn-xs btn-success"> Kompeten</button>';
						   } else {
							   return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
						   }
						}
					  },
					  { "data": "catatan_pemulihan", "searchable":false },
            ],
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
              {
                text: "<i class='fa fa-search'></i> Lihat Pemulihan",
                extend: "selected",
                className: "btnteal",
                  action: function ( e, dt, node, config ) {
                      data = dt.rows( { selected: true } ).data()[0]['id_logbook_pemulihan'];
                      $("#modal-default").modal();
                        $('.modal-body').load('<?php echo base_url('member/pengajuan_kompetensi/lihat_pemulihan/'); ?>'+data,function(){
                          $('#modal-default').modal({show:true});
                        });

                  }
              },
              {
                text: "<i class='fa fa-search'></i> Lihat Kegiatan Pemulihan",
                extend: "selected",
                className: "btnfuchsia",
                  action: function ( e, dt, node, config ) {
                      data = dt.rows( { selected: true } ).data()[0]['id_logbook_pemulihan'];
                      $("#modal-default").modal();
                        $('.modal-body').load('<?php echo base_url('member/pengajuan_kompetensi/lihat_kegiatan/'); ?>'+data,function(){
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
        <?php } ?>
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
                "url"  : "<?php echo base_url();?>member/pengajuan_kompetensi/tabel/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                    {
                        "className": 'details-control',
                        "orderable": false,
                        "searchable":false,
                        "data":      null,
                        "defaultContent": '<i class = "glyphicon glyphicon-plus-sign"> </ i>'
                    },
                      { "data": "id_logbook", "searchable":false, "visible":true },
                      { "data": "tgl_logbook", "searchable":false },
					  { "data": "nama_pegawai", "searchable":false },
					  { "data": "nama_kode_kewenangan", "searchable":false },
					  { "data": "nama_kewenangan" },
                      { "data": "jml_logbook", "searchable":false },
					  { "data": "v_karu",
						"render": function(data, type, row){
							if (row.v_karu === 'Proses') {
							   return '<button class="btn btn-xs btn-default"> Proses</button>';
						   } else if (row.v_karu === 'Kompeten') {
							   return '<button class="btn btn-xs btn-success"> Kompeten</button>';
						   } else {
							   return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
						   }
						}
					  },
                      { "data": "v_kabid",
						"render": function(data, type, row){
							if (row.v_kabid === 'Proses') {
							   return '<button class="btn btn-xs btn-default"> Proses</button>';
						   } else if (row.v_kabid === 'Kompeten') {
							   return '<button class="btn btn-xs btn-success"> Kompeten</button>';
						   } else {
							   return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
						   }
						}
					  },
                      { "data": "v_asesor",
						"render": function(data, type, row){
							if (row.v_asesor === 'Proses') {
							   return '<button class="btn btn-xs btn-default"> Proses</button>';
						   } else if (row.v_asesor === 'Kompeten') {
							   return '<button class="btn btn-xs btn-success"> Kompeten</button>';
						   } else {
							   return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
						   }
						}
					  },
                      { "data": "v_komite",
						"render": function(data, type, row){
							if (row.v_komite === 'Proses') {
							   return '<button class="btn btn-xs btn-default"> Proses</button>';
						   } else if (row.v_komite === 'Kompeten') {
							   return '<button class="btn btn-xs btn-success"> Kompeten</button>';
						   } else {
							   return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
						   }
						}
					  },
                      { "data": "v_direktur",
						"render": function(data, type, row){
							if (row.v_direktur === 'Proses') {
							   return '<button class="btn btn-xs btn-default"> Proses</button>';
						   } else if (row.v_direktur === 'Kompeten') {
							   return '<button class="btn btn-xs btn-success"> Kompeten</button>';
						   } else {
							   return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
						   }
						}
					  }
            ],
            "order": [[1, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
            <?php if($status_pengajuan == 0){ ?>
                 {
                     text: "<i class='fa fa-close'></i> Hilangkan Logbook Dari Daftar",
                     extend: "selected",
                     className: "btnred",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_logbook'];
                     swal({
                       title: "Logbook Tidak Di hapus",
                       text: "Yakin akan mereset logbook ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('member/pengajuan_kompetensi/reset_logbook/'); ?>'+data+'/<?php echo $id;?>'; //[Modif Disini]
                       }
                     });
                    }
                 },
            <?php } ?>
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
/*		am4core.ready(function() {
		am4core.useTheme(am4themes_dataviz);
		am4core.useTheme(am4themes_animated);
		var chart = am4core.create("chartdiv", am4charts.PieChart);
		chart.dataSource.url = "";
		var pieSeries = chart.series.push(new am4charts.PieSeries());
		pieSeries.dataFields.value = "total";
		pieSeries.dataFields.category = "nama_kompetensi";
		pieSeries.innerRadius = am4core.percent(50);
		pieSeries.ticks.template.disabled = true;
		pieSeries.labels.template.disabled = true;
		var rgm = new am4core.RadialGradientModifier();
		rgm.brightnesses.push(-0.8, -0.8, -0.5, 0, - 0.5);
		pieSeries.slices.template.fillModifier = rgm;
		pieSeries.slices.template.strokeModifier = rgm;
		pieSeries.slices.template.strokeOpacity = 0.4;
		pieSeries.slices.template.strokeWidth = 0;
		var title = chart.titles.create();
		title.text = "GRAFIK PERSENTASE KOMPETENSI";
		title.fontSize = 25;
		title.tooltipText = "JIKA TIDAK TAMPIL PERBAIKI ID AWAL DAN AKHIR LOGBOOK";
		chart.legend = new am4charts.Legend();
		chart.legend.position = "right";
		chart.legend.valign = "bottom";
		chart.legend.margin(5,5,5,5);
		chart.legend.valign = "top";
		chart.legend.scrollable = true;
		chart.legend.itemContainers.template.events.on("out", function(event){
		  var segments = event.target.dataItem.dataContext.segments;
		  segments.each(function(segment){
			segment.isHover = false;
		  })
		})
		chart.exporting.menu = new am4core.ExportMenu();
  }); */
<?php
}
elseif ($page=="berkas_logbook")
{
?>
$('#first_date').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#first_date").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#last_date').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#last_date").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
<?php 
	if($id_status_diusulkan == 100){
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
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
                "url"  : "<?php echo base_url();?>member/<?php echo $page;?>/data/<?php echo $first_date;?>/<?php echo $last_date;?>/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_logbook", "searchable":false },
                      { "data": "tgl_logbook", "searchable":false },
					  { "data": "rm", "searchable":false },
					  { "data": "nama_kode_kewenangan", "searchable":false },
					  { "data": "nama_kompetensi", "searchable":false },
					  { "data": "nama_kewenangan" },
					  { "data": "jml_logbook", "searchable":false },
					  { "data": "v_karu",
						"render": function(data, type, row){
							if (row.status_pengajuan === 'Belum Terkirim') {
							   return '<button class="btn btn-xs btn-default"> Belum Terkirim</button>';
							}else if (row.v_karu === 'Proses') {
							   return '<button class="btn btn-xs btn-default"> Proses</button>';
						   } else if (row.v_karu === 'Kompeten') {
							   return '<button class="btn btn-xs btn-success"> Kompeten</button>';
						   } else {
							   return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
						   }
						}
					  },
					  { "data": "tgl_v_karu" }
            ],
            "order": [[0, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-edit'></i> Pilih ID Logbook Awal",
                    extend: "selected",
                    className: "btnnavy",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_logbook'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('member/'.$page.'/simpana/'.$id.'/'); ?>'+data;
                    }
                },
                {
                    text: "<i class='fa fa-edit'></i> Pilih ID Logbook Akhir",
                    extend: "selected",
                    className: "btnfuchsia",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_logbook'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('member/'.$page.'/simpanb/'.$id.'/'); ?>'+data;
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
$(function(){
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
	  'scrollX'		: true ,
	  'scrollX'			: true,
	  'scrollY'			: '350px',
	  'scrollCollapse'	: true,
    })
});
<?php
}
elseif ($page=="berkas_ijasah")
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
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
                "url"  : "<?php echo base_url();?>member/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
					  { "data": "nama_berkas" },
					  { "data": "no_berkas", "searchable":false },
					  { "data": "tgl_b_berkas", "searchable":false },
					  {
						"data": "link_berkas",
						"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
							$(nTd).html("<a href='<?php echo base_url();?>assets/berkas/ol/"+oData.link_berkas+"' target=_blank><i class='fa fa-search'></i> Lihat File</a>")
						}
					  }
            ],
            "order": [[0, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-edit'></i> Pilih Berkas",
                    extend: "selected",
                    className: "btnlightblue",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_berkas'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('member/'.$page.'/simpan/'.$id.'/'); ?>'+data;
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
elseif ($page=="berkas_str")
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
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
                "url"  : "<?php echo base_url();?>member/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
					  { "data": "nama_berkas" },
					  { "data": "no_berkas", "searchable":false },
					  { "data": "no_sertifikat", "searchable":false },
					  { "data": "tgl_b_berkas", "searchable":false },
					  {
						"data": "link_berkas",
						"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
							$(nTd).html("<a href='<?php echo base_url();?>assets/berkas/ol/"+oData.link_berkas+"' target=_blank><i class='fa fa-search'></i> Lihat File</a>")
						}
					  }
            ],
            "order": [[0, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-edit'></i> Pilih Berkas",
                    extend: "selected",
                    className: "btnlightblue",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_berkas'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('member/'.$page.'/simpan/'.$id.'/'); ?>'+data;
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
elseif ($page=="berkas_sertifikat")
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
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
                "url"  : "<?php echo base_url();?>member/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
					  { "data": "nama_berkas" },
					  { "data": "penyelenggara", "searchable":false },
					  { "data": "tgl_a_berkas", "searchable":false },
					  { "data": "tgl_b_berkas", "searchable":false },
					  { "data": "nama_kategori_berkas", "searchable":false },
					  {
						"data": "link_berkas",
						"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
							$(nTd).html("<a href='<?php echo base_url();?>assets/berkas/ol/"+oData.link_berkas+"' target=_blank><i class='fa fa-search'></i> Lihat File</a>")
						}
					  }
            ],
            "order": [[0, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-edit'></i> Pilih Berkas",
                    extend: "selected",
                    className: "btnlightblue",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_berkas'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('member/'.$page.'/simpan/'.$id.'/'); ?>'+data;
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
elseif ($page=="berkaslain_berkas")
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
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
                "url"  : "<?php echo base_url();?>member/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
					  { "data": "nama_berkas" },
					  { "data": "nama_kategori_berkas", "searchable":false },
					  {
						"data": "link_berkas",
						"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
							$(nTd).html("<a href='<?php echo base_url();?>assets/berkas/ol/"+oData.link_berkas+"' target=_blank><i class='fa fa-search'></i> Lihat File</a>")
						}
					  }
            ],
            "order": [[0, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-edit'></i> Pilih Berkas",
                    extend: "selected",
                    className: "btnlightblue",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_berkas'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('member/'.$page.'/simpan/'.$id.'/'); ?>'+data;
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
elseif ($page=="berkas_etik")
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
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
                "url"  : "<?php echo base_url();?>member/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
					  { "data": "tgl_etik_pegawai", "searchable":false },
					  { "data": "jam_etik_pegawai", "searchable":false },
					  { "data": "jumlah_etik", "searchable":false },
					  { "data": "total_etik", "searchable":false },
					  { "data": "hasil_etik", "searchable":false },
					  { "data": "nama_pegawai" }
            ],
            "order": [[0, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-edit'></i> Pilih Berkas",
                    extend: "selected",
                    className: "btnmaroon",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_etik_pegawai'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('member/'.$page.'/simpan/'.$id.'/'); ?>'+data;
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
elseif ($page=="penilaian_kinerja")
{
?>
    $(document).ready(function() {
		$('.select2').select2()
		$('#example1').DataTable({
		  'paging'      	: false,
		  'lengthChange'	: false,
		  'searching'   	: false,
		  'ordering'    	: false,
		  'info'        	: true,
		  'scrollX'			: true,
		  'scrollY'			: '500px',
		  'scrollCollapse'	: true
		})
	});
<?php
}
elseif ($page=="working")
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
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
                "url"  : "<?php echo base_url();?>member/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_pegawai_instansi","searchable":false,"visible":false },
                      { "data": "nama_pegawai" },
                      { "data": "nama_working", "searchable":false },
                      { "data": "status_pegawai_instansi",
                        "render": function(data, type, row){
                            if (row.status_pegawai_instansi === '0') {
                               return '<button class="btn btn-xs btn-danger">NON AKTIF</button>';
                           } else {
                               return '<button class="btn btn-xs btn-success">AKTIF</button>';
                           }
                        }
                     }
            ],
            "order": [[0, 'desc'],[1, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
            <?php  
            	if(empty($this->session->id_level)){
            ?>
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('member/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
              {
                text: "<i class='fa fa-edit'></i> Rubah",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_pegawai_instansi'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/edit/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
            <?php  
            	}
            ?>
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
else if($page=='lt')
{
?>
$(function(){
	$('.select2').select2()
});

am4core.ready(function() {
am4core.useTheme(am4themes_animated);
var chart = am4core.create("chartdiv", am4charts.XYChart);
chart.data = [
<?php
foreach($json as $row1){
?>
{
  "year": <?php echo '"'.$row1['tgl_logbook'].'"'; ?>,
  <?php
  $no = 0;
  $jsonx = $this->m_member->lt2($row1['tgl_logbook'],$this->session->id_pegawai);
  foreach($jsonx as $row2){
	  $no++;
  ?>
  <?php echo '"'.$row2['id_kompetensi'].'"'; ?>:<?php echo $row2['jml_logbook']; ?>,
  <?php
  }
  ?>
},
<?php
}
?>
];

// Create category axis
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "year";
categoryAxis.renderer.opposite = true;

// Create value axis
var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.inversed = false;
valueAxis.title.text = "Jumlah Kompetensi";
valueAxis.renderer.minLabelPosition = 0.01;

<?php
foreach($ambil_kol_golongan_pemeriksaan_graph as $row1x){
//  $jsonxx = $this->m_umum->ambil_data('dsr_kredensial','id_dsr_kredensial',$nox);
?>
// Create series
var series<?php echo $row1x['id_kompetensi']; ?> = chart.series.push(new am4charts.LineSeries());
series<?php echo $row1x['id_kompetensi']; ?>.dataFields.valueY = <?php echo '"'.$row1x['id_kompetensi'].'"'; ?>;
series<?php echo $row1x['id_kompetensi']; ?>.dataFields.categoryX = "year";
series<?php echo $row1x['id_kompetensi']; ?>.name = <?php echo '"'.$row1x['nama_kompetensi'].'"'; ?>;
series<?php echo $row1x['id_kompetensi']; ?>.bullets.push(new am4charts.CircleBullet());
series<?php echo $row1x['id_kompetensi']; ?>.tooltipText = "{name} Thn {categoryX}: {valueY}";
series<?php echo $row1x['id_kompetensi']; ?>.legendSettings.valueText = "{valueY}";
series<?php echo $row1x['id_kompetensi']; ?>.visible  = false;

let hs<?php echo $row1x['id_kompetensi']; ?> = series<?php echo $row1x['id_kompetensi']; ?>.segments.template.states.create("hover")
hs<?php echo $row1x['id_kompetensi']; ?>.properties.strokeWidth = 5;
series<?php echo $row1x['id_kompetensi']; ?>.segments.template.strokeWidth = 1;

<?php
}
?>
chart.cursor = new am4charts.XYCursor();
chart.cursor.lineX.strokeOpacity = 0;
chart.cursor.lineY.strokeOpacity = 0;


chart.zoomOutButton.align = "left";
chart.zoomOutButton.valign = "bottom";
chart.zoomOutButton.marginLeft = 10;
chart.zoomOutButton.marginBottom = 10;

// Add scrollbar
var scrollbar = new am4charts.XYChartScrollbar();
//scrollbar.series.push(series)

chart.scrollbarX = scrollbar;

// Add legend
chart.legend = new am4charts.Legend();
chart.legend.itemContainers.template.events.on("over", function(event){
  var segments = event.target.dataItem.dataContext.segments;
  segments.each(function(segment){
    segment.isHover = true;
  })
})
chart.legend.position = "right";
chart.legend.valign = "bottom";
chart.legend.margin(5,5,5,5);
chart.legend.valign = "top";

chart.legend.itemContainers.template.events.on("out", function(event){
  var segments = event.target.dataItem.dataContext.segments;
  segments.each(function(segment){
    segment.isHover = false;
  })
})
chart.exporting.menu = new am4core.ExportMenu();
}); // end am4core.ready()
<?php
}
else if($page=='lb')
{
?>
$(function(){
	$('.select2').select2()
});

am4core.ready(function() {
am4core.useTheme(am4themes_animated);
var chart = am4core.create("chartdiv", am4charts.XYChart);
chart.data = [
<?php
foreach($json as $row1){
?>
{
  "year": <?php echo '"'.$row1['tgl_logbooke'].'"'; ?>,
  <?php
  $no = 0;
  $jsonx = $this->m_member->lb2($row1['tgl_logbook'],$this->session->id_pegawai);
  foreach($jsonx as $row2){
	  $no++;
  ?>
  <?php echo '"'.$row2['id_kompetensi'].'"'; ?>:<?php echo $row2['jml_logbook']; ?>,
  <?php
  }
  ?>
},
<?php
}
?>
];

// Create category axis
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "year";
categoryAxis.renderer.opposite = true;

// Create value axis
var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.inversed = false;
valueAxis.title.text = "Jumlah Kompetensi";
valueAxis.renderer.minLabelPosition = 0.01;

<?php
foreach($ambil_kol_golongan_pemeriksaan_graph as $row1x){
//  $jsonxx = $this->m_umum->ambil_data('dsr_kredensial','id_dsr_kredensial',$nox);
?>
// Create series
var series<?php echo $row1x['id_kompetensi']; ?> = chart.series.push(new am4charts.LineSeries());
series<?php echo $row1x['id_kompetensi']; ?>.dataFields.valueY = <?php echo '"'.$row1x['id_kompetensi'].'"'; ?>;
series<?php echo $row1x['id_kompetensi']; ?>.dataFields.categoryX = "year";
series<?php echo $row1x['id_kompetensi']; ?>.name = <?php echo '"'.$row1x['nama_kompetensi'].'"'; ?>;
series<?php echo $row1x['id_kompetensi']; ?>.bullets.push(new am4charts.CircleBullet());
series<?php echo $row1x['id_kompetensi']; ?>.tooltipText = "{name} : {valueY}";
series<?php echo $row1x['id_kompetensi']; ?>.legendSettings.valueText = "{valueY}";
series<?php echo $row1x['id_kompetensi']; ?>.visible  = false;

let hs<?php echo $row1x['id_kompetensi']; ?> = series<?php echo $row1x['id_kompetensi']; ?>.segments.template.states.create("hover")
hs<?php echo $row1x['id_kompetensi']; ?>.properties.strokeWidth = 5;
series<?php echo $row1x['id_kompetensi']; ?>.segments.template.strokeWidth = 1;

<?php
}
?>
chart.cursor = new am4charts.XYCursor();
chart.cursor.lineX.strokeOpacity = 0;
chart.cursor.lineY.strokeOpacity = 0;


chart.zoomOutButton.align = "left";
chart.zoomOutButton.valign = "bottom";
chart.zoomOutButton.marginLeft = 10;
chart.zoomOutButton.marginBottom = 10;

// Add scrollbar
var scrollbar = new am4charts.XYChartScrollbar();
//scrollbar.series.push(series)

chart.scrollbarX = scrollbar;

// Add legend
chart.legend = new am4charts.Legend();
chart.legend.itemContainers.template.events.on("over", function(event){
  var segments = event.target.dataItem.dataContext.segments;
  segments.each(function(segment){
    segment.isHover = true;
  })
})
chart.legend.position = "right";
chart.legend.valign = "bottom";
chart.legend.margin(5,5,5,5);
chart.legend.valign = "top";

chart.legend.itemContainers.template.events.on("out", function(event){
  var segments = event.target.dataItem.dataContext.segments;
  segments.each(function(segment){
    segment.isHover = false;
  })
})
chart.exporting.menu = new am4core.ExportMenu();
}); // end am4core.ready()
<?php
}
else if($page=='lh')
{
?>

$(function(){
	$('.select2').select2()
});

am4core.ready(function() {
am4core.useTheme(am4themes_animated);
var chart = am4core.create("chartdiv", am4charts.XYChart);
chart.data = [
<?php
foreach($json as $row1){
?>
{
  "year": <?php echo '"'.$row1['tgl_logbook'].'"'; ?>,
  <?php
  $no = 0;
  $jsonx = $this->m_member->lh2($row1['tgl_logbook'],$this->session->id_pegawai);
  foreach($jsonx as $row2){
	  $no++;
  ?>
  <?php echo '"'.$row2['id_kompetensi'].'"'; ?>:<?php echo $row2['jml_logbook']; ?>,
  <?php
  }
  ?>
},
<?php
}
?>
];

// Create category axis
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "year";
categoryAxis.renderer.opposite = true;

// Create value axis
var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.inversed = false;
valueAxis.title.text = "Nilai";
valueAxis.renderer.minLabelPosition = 0.01;

<?php
foreach($ambil_kol_golongan_pemeriksaan_graph as $row1x){
//  $jsonxx = $this->m_umum->ambil_data('dsr_kredensial','id_dsr_kredensial',$nox);
?>
// Create series
var series<?php echo $row1x['id_kompetensi']; ?> = chart.series.push(new am4charts.LineSeries());
series<?php echo $row1x['id_kompetensi']; ?>.dataFields.valueY = <?php echo '"'.$row1x['id_kompetensi'].'"'; ?>;
series<?php echo $row1x['id_kompetensi']; ?>.dataFields.categoryX = "year";
series<?php echo $row1x['id_kompetensi']; ?>.name = <?php echo '"'.$row1x['nama_kompetensi'].'"'; ?>;
series<?php echo $row1x['id_kompetensi']; ?>.bullets.push(new am4charts.CircleBullet());
series<?php echo $row1x['id_kompetensi']; ?>.tooltipText = "{name} Tgl {categoryX} : {valueY}";
series<?php echo $row1x['id_kompetensi']; ?>.legendSettings.valueText = "{valueY}";
series<?php echo $row1x['id_kompetensi']; ?>.visible  = false;

let hs<?php echo $row1x['id_kompetensi']; ?> = series<?php echo $row1x['id_kompetensi']; ?>.segments.template.states.create("hover")
hs<?php echo $row1x['id_kompetensi']; ?>.properties.strokeWidth = 5;
series<?php echo $row1x['id_kompetensi']; ?>.segments.template.strokeWidth = 1;

<?php
}
?>
chart.cursor = new am4charts.XYCursor();
chart.cursor.lineX.strokeOpacity = 0;
chart.cursor.lineY.strokeOpacity = 0;


chart.zoomOutButton.align = "left";
chart.zoomOutButton.valign = "bottom";
chart.zoomOutButton.marginLeft = 10;
chart.zoomOutButton.marginBottom = 10;

// Add scrollbar
var scrollbar = new am4charts.XYChartScrollbar();
//scrollbar.series.push(series)

chart.scrollbarX = scrollbar;

// Add legend
chart.legend = new am4charts.Legend();
chart.legend.itemContainers.template.events.on("over", function(event){
  var segments = event.target.dataItem.dataContext.segments;
  segments.each(function(segment){
    segment.isHover = true;
  })
})
chart.legend.position = "right";
chart.legend.valign = "bottom";
chart.legend.margin(5,5,5,5);
chart.legend.valign = "top";
chart.legend.scrollable = true

chart.legend.itemContainers.template.events.on("out", function(event){
  var segments = event.target.dataItem.dataContext.segments;
  segments.each(function(segment){
    segment.isHover = false;
  })
})
chart.exporting.menu = new am4core.ExportMenu();
}); // end am4core.ready()
<?php
}
elseif ($page=="analisis")
{
?>
$('#id').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#id").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#id2').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#id2").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
    $(document).ready(function() {
        $('.select2').select2()
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
"url"  : "<?php echo base_url();?>member/<?php echo $page;?>/data/<?php echo $id;?>/<?php echo $id2;?>/<?php echo $id3;?>/<?php echo $id4;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "tgl_laporan", "searchable":false, className : "text-center"},
                      { "data": "tgl_awal", "searchable":false, className : "text-center",  "orderable":false,
				            "render": function ( data, type, row ) {
				                return '(' + row.tgl_awal + ' -' + row.tgl_akhir + ')';
				            }
                      },
                      { "data": "judul_laporan", "orderable":false, className : "text-center"},
                      { "data": "tujuan_laporan", "orderable":false, className : "text-center"},
                      { "data": "nama_working", "searchable":false, "orderable":false, className : "text-center"},
                      { "data": "nama_pegawai", "searchable":false, "orderable":false, className : "text-center"}
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
                          $('.modal-body').load('<?php echo base_url('member/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
              {
                text: "<i class='fa fa-edit'></i> Rubah",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/edit/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
                {
                    text: "<i class='fa fa-area-chart'></i> Sesuaikan Data Tabel / Grafik",
                    extend: "selected",
                    className: "btnfuchsia",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_laporan'];
                        location.href = '<?php echo base_url('member/tabel/view/'); ?>'+data;
                    }
                },
/*              {
                text: "<i class='fa fa-recycle'></i> Share QC Ke User Lain?",
                extend: "selected",
                className: "btnorange",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<php echo base_url('member/'.$page.'/share_user/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
                            {
                text: "<i class='fa fa-recycle'></i> Share QC Ke Ruangan / Unit Lain?",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<php echo base_url('member/'.$page.'/share_unit/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
              {
                text: "<i class='fa fa-recycle'></i> Share QC Ke Instansi Lain?",
                extend: "selected",
                className: "btnorange",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<php echo base_url('member/'.$page.'/share_instansi/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },*/
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
elseif ($page=="tabel")
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
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
			"url"  : "<?php echo base_url();?>member/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "urutan_laporan_tabel", "searchable":false, className : "text-center"},
                      { "data": "judul_laporan_tabel", "searchable":false },
                      { "data": "lhu", "searchable":false },
                      { "data": "nama_tabel", "orderable":false },
                      { "data": "nama_working", "orderable":false },
                      { "data": "status_urutan_tabel", 
                        "render": function(data, type, row){
                            if (row.status_urutan_tabel === '1') {
                               return '<button class="btn btn-xs btn-success"> Sertakan</button>';
                           }  else {
                               return '<button class="btn btn-xs btn-danger"> Tidak disertakan</button>';
                           }
                        }                          
                      }
            ],
            "order": [[0, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
				{
				    text: "<i class='fa fa-area-chart'></i>&nbsp;<i class='fa fa-plus-square'></i> Tambah Hasil Analisa",
				    className: "btnmaroon",
				    init: function(api, node, config) {
				        $(node).removeClass('btn-default')
				    },
				    action: function ( e, dt, node, config ) {
				        $("#modal-default").modal();
				          $('.modal-body').load('<?php echo base_url('member/'.$page.'/tambah_tabel/'); ?><?php echo $id;?>',function(){
				            $('#modal-default').modal({show:true});
				          });
				    }
				},
              {
                text: "<i class='fa fa-line-chart'></i> Tambah Min - Max (Range)",
                extend: "selected",
                className: "btnolive",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/seting_range/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
				{
				text: "<i class='fa fa-bar-chart'></i>&nbsp;<i class='fa fa-plus-square'></i> Seting Tabel / Grafik",
				extend: "selected",
				className: "btnyellow",
				  action: function ( e, dt, node, config ) {
				          data = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
				          $("#modal-default").modal();
				            $('.modal-body').load('<?php echo base_url('member/'.$page.'/rubah_tabel/'); ?>'+data,function(){
				              $('#modal-default').modal({show:true});
				            });
				  }
				},
				{
				text: "<i class='fa fa-sort-amount-asc'></i> Sesuaikan Urutan",
				extend: "selected",
				className: "btnnavy",
				  action: function ( e, dt, node, config ) {
				          data = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
				          $("#modal-default").modal();
				            $('.modal-body').load('<?php echo base_url('member/'.$page.'/rubah_urutan/'); ?>'+data,function(){
				              $('#modal-default').modal({show:true});
				            });
				  }
				},
				{
				text: "<i class='fa fa-database'></i> Pilih Sumber Data",
				extend: "selected",
				className: "btnolive",
				  action: function ( e, dt, node, config ) {
				          data = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
				          $("#modal-default").modal();
				            $('.modal-body').load('<?php echo base_url('member/'.$page.'/rubah_lhu/'); ?>'+data,function(){
				              $('#modal-default').modal({show:true});
				            });
				  }
				},
              {
                text: "<i class='fa fa-gears'></i> Seting Kompetensi",
                extend: "selected",
                className: "btnlime",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/seting_kompetensi/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
              {
                text: "<i class='fa fa-gears'></i> Seting Isi Logbook / Kompetensi",
                extend: "selected",
                className: "btnyellow",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/seting_isi_kompetensi/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
              {
                text: "<i class='fa fa-gears'></i> Pilih Kewenangan / Kompetensi",
                extend: "selected",
                className: "btnblue",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/seting_kewenangan/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
              {
                text: "<i class='fa fa-gears'></i> Seting BAKHP",
                extend: "selected",
                className: "btnmaroon",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/seting_bahan/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
              {
                text: "<i class='fa fa-gears'></i> Seting Reject",
                extend: "selected",
                className: "btnteal",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/seting_reject/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
              {
                text: "<i class='fa fa-gears'></i> Seting Item Mutu",
                extend: "selected",
                className: "btnnavy",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/seting_item/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
              {
                text: "<i class='fa fa-gears'></i> Seting Indikator Mutu",
                extend: "selected",
                className: "btnfuchsia",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/seting_i_mutu/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
              {
                text: "<i class='fa fa-gears'></i> Pilih Berkas",
                extend: "selected",
                className: "btnblue",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/seting_berkas/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
              {
                text: "<i class='fa fa-file-pdf-o'></i> Apakah Print PDF Logbook?",
                extend: "selected",
                className: "btnorange",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/seting_print/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
              {
                text: "<i class='fa fa-send'></i> &nbsp; <i class='fa fa-link'></i>&nbsp; Buka Link Laporan (Termasuk Sub Laporan)",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                  //    data = dt.rows( { selected: true } ).data()[0]['id_pendaftaran_unit'];
                      laporan = dt.rows( { selected: true } ).data()[0]['id_laporan'];				
                      tabel = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];				
						window.open('<?php echo base_url('external/lihat/laporan/'); ?>'+laporan+'/'+tabel);
                      }
              }, 
              {
                text: "<i class='fa fa-file-text'></i> Sertakan Berkas Laporan",
                extend: "selected",
                className: "btnlime",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/tambah_berkas/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
                {
                text: "<i class='fa fa-copy'></i> Clone Data",
                extend: "selected",
                className: "btnolive",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/clone/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
                },
                {
                text: "<i class='fa fa-close'></i> Sertakan / Tidak tombol di Laporan",
                extend: "selected",
                className: "btnred",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/disabel/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
                },
                {
                    text: "<i class='fa fa-bar-chart'></i>&nbsp;<i class='fa fa-pencil-square'></i> Sesuaikan Hasil",
                    extend: "selected",
                    className: "btnmaroon",
                    action: function ( e, dt, node, config ) {
                        kompetensi = dt.rows( { selected: true } ).data()[0]['lhu'];
                        if( kompetensi === "" || !kompetensi){
                            swal({
                              title: "SUMBER DATA KOSONG",
                              text: "Isi Sumber Data Dahulu ",
                              icon: "warning",
                              buttons: "Tutup",
                              dangerMode: true,
                            })
                        }
                        else{
                        data = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                        location.href = '<?php echo base_url('member/'.$page.'/sesuaikan/'); ?>'+data;
                        }
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
elseif ($page=="tabel_pasien")
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
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
            "url"  : "<?php echo base_url();?>member/tabel/data_pasien/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "rm", className : "text-center"},
                      { "data": "nama_pasien" },
                      { "data": "tgl_lahir", "searchable":false, "orderable":false },
                      { "data": "jk", "orderable":false, "searchable":false }
            ],
            "order": [[0, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
              {
                text: "<i class='fa fa-pencil-square'></i> Rubah Data Pasien",
                extend: "selected",
                className: "btnnavy",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_pasien'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/rubah_pasien/'.$id.'/'.$idl.'/'); ?>'+data,function(){
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
elseif ($page=="tabel_sesuaikan")
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
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
			"url"  : "<?php echo base_url();?>member/tabel/data_sesuaikan/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "urutan_laporan_tabel", "searchable":false, className : "text-center"},
                      { "data": "judul_laporan_tabel", "searchable":false },
                      { "data": "lhu", "searchable":false },
                      { "data": "nama_tabel", "orderable":false },
                      { "data": "status_urutan_tabel", 
                        "render": function(data, type, row){
                            if (row.status_urutan_tabel === '1') {
                               return '<button class="btn btn-xs btn-success"> Sertakan</button>';
                           }  else {
                               return '<button class="btn btn-xs btn-danger"> Tidak disertakan</button>';
                           }
                        }                          
                      }
            ],
            "order": [[0, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
				{
				text: "<i class='fa fa-bar-chart'></i>&nbsp;<i class='fa fa-plus-square'></i> Seting Tabel / Grafik",
				extend: "selected",
				className: "btnyellow",
				  action: function ( e, dt, node, config ) {
				          data = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
				          $("#modal-default").modal();
				            $('.modal-body').load('<?php echo base_url('member/tabel/rubah_tabel/'); ?>'+data,function(){
				              $('#modal-default').modal({show:true});
				            });
				  }
				},
              {
                text: "<i class='fa fa-line-chart'></i> Tambah Min - Max (Range)",
                extend: "selected",
                className: "btnolive",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/tabel/seting_range/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
				{
				text: "<i class='fa fa-sort-amount-asc'></i> Sesuaikan Urutan",
				extend: "selected",
				className: "btnnavy",
				  action: function ( e, dt, node, config ) {
				          data = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
				          $("#modal-default").modal();
				            $('.modal-body').load('<?php echo base_url('member/tabel/rubah_urutan/'); ?>'+data,function(){
				              $('#modal-default').modal({show:true});
				            });
				  }
				},
				{
				text: "<i class='fa fa-database'></i> Pilih Sumber Data",
				extend: "selected",
				className: "btnolive",
				  action: function ( e, dt, node, config ) {
				          data = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
				          $("#modal-default").modal();
				            $('.modal-body').load('<?php echo base_url('member/tabel/rubah_lhu/'); ?>'+data,function(){
				              $('#modal-default').modal({show:true});
				            });
				  }
				},
              {
                text: "<i class='fa fa-gears'></i> Seting Kompetensi",
                extend: "selected",
                className: "btnlime",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/tabel/seting_kompetensi/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
              {
                text: "<i class='fa fa-gears'></i> Seting Isi Logbook / Kompetensi",
                extend: "selected",
                className: "btnyellow",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/tabel/seting_isi_kompetensi/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
              {
                text: "<i class='fa fa-gears'></i> Pilih Kewenangan / Kompetensi",
                extend: "selected",
                className: "btnblue",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/tabel/seting_kewenangan/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
              {
                text: "<i class='fa fa-gears'></i> Seting BAKHP",
                extend: "selected",
                className: "btnmaroon",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/tabel/seting_bahan/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
              {
                text: "<i class='fa fa-gears'></i> Seting Reject",
                extend: "selected",
                className: "btnteal",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/tabel/seting_reject/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
              {
                text: "<i class='fa fa-gears'></i> Seting Item Mutu",
                extend: "selected",
                className: "btnnavy",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/tabel/seting_item/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },              
              {
                text: "<i class='fa fa-gears'></i> Seting Indikator Mutu",
                extend: "selected",
                className: "btnfuchsia",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/tabel/seting_i_mutu/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
              {
                text: "<i class='fa fa-gears'></i> Pilih Berkas",
                extend: "selected",
                className: "btnblue",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/tabel/seting_berkas/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
              {
                text: "<i class='fa fa-file-pdf-o'></i> Apakah Print PDF Logbook?",
                extend: "selected",
                className: "btnorange",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/tabel/seting_print/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
              {
                text: "<i class='fa fa-send'></i> &nbsp; <i class='fa fa-link'></i>&nbsp; Buka Link Laporan",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                  //    data = dt.rows( { selected: true } ).data()[0]['id_pendaftaran_unit'];
                      laporan = dt.rows( { selected: true } ).data()[0]['id_laporan'];				
                      tabel = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];				
						window.open('<?php echo base_url('external/lihat/tabel/'); ?>'+laporan+'/'+tabel);
                      }
              },
              {
                text: "<i class='fa fa-file-text'></i> Sertakan Berkas Laporan",
                extend: "selected",
                className: "btnlime",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/tabel/tambah_berkas/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
                {
                text: "<i class='fa fa-copy'></i> Clone Data",
                extend: "selected",
                className: "btnolive",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/tabel/clone/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
                },
                {
                text: "<i class='fa fa-close'></i> Sertakan / Tidak tombol di Laporan",
                extend: "selected",
                className: "btnred",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/tabel/disabel/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
                },
                {
                    text: "<i class='fa fa-bar-chart'></i>&nbsp;<i class='fa fa-pencil-square'></i> Sesuaikan Hasil",
                    extend: "selected",
                    className: "btnmaroon",
                    action: function ( e, dt, node, config ) {
                        kompetensi = dt.rows( { selected: true } ).data()[0]['lhu'];
                        if( kompetensi === "" || !kompetensi){
                            swal({
                              title: "SUMBER DATA KOSONG",
                              text: "Isi Sumber Data Dahulu ",
                              icon: "warning",
                              buttons: "Tutup",
                              dangerMode: true,
                            })
                        }
                        else{
                        data = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                        location.href = '<?php echo base_url('member/tabel/sesuaikan/'); ?>'+data;
                        }
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
        CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
        CKEDITOR.replace('editor2', {enterMode: CKEDITOR.ENTER_BR});
        $('#example2').DataTable({
          'paging'      : false,
          'lengthChange': false,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'scrollX'         : true,
          'scrollY'         : '250px',
          'scrollCollapse'  : true,
        })
    });
<?php
	// ---------------------------------- 13 Grafik Pie Semua Item No 2
    if($tabel == 3){
?>
    am4core.ready(function() {
    am4core.useTheme(am4themes_dataviz);
    am4core.useTheme(am4themes_animated);
    var chart = am4core.create("chartdiv", am4charts.PieChart);
    chart.dataSource.url = "<?php echo base_url();?>member/tabel/pie/<?php echo $id;?>";
    var pieSeries = chart.series.push(new am4charts.PieSeries());
    pieSeries.dataFields.value = "total";
    pieSeries.dataFields.category = "nama_lhu";
    pieSeries.innerRadius = am4core.percent(0);

    pieSeries.labels.template.text = "[bold {color}]{category} :  {value} ({value.percent.formatNumber('#.0')}%) [/]";
    pieSeries.labels.template.paddingTop = 0;
    pieSeries.labels.template.paddingBottom = 0;
    pieSeries.labels.template.fontSize = 10;
	pieSeries.labels.template.maxWidth = 250;
	pieSeries.labels.template.wrap = true;
    pieSeries.labels.template.relativeRotation = 90;

    var rgm = new am4core.RadialGradientModifier();
    rgm.brightnesses.push(-0.8, -0.8, -0.5, 0, - 0.5);
    pieSeries.slices.template.fillModifier = rgm;
    pieSeries.slices.template.strokeModifier = rgm;
    pieSeries.slices.template.strokeOpacity = 0.4;
    pieSeries.slices.template.strokeWidth = 0;

    var legendContainer = am4core.create("legenddiv", am4core.Container);
    legendContainer.width = am4core.percent(100);
    legendContainer.height = am4core.percent(100);

    chart.legend = new am4charts.Legend();
    //chart.legend.labels.template.text = "[bold {color}]{category} : {value.percent.formatNumber('#.0')}% [/]";
    chart.legend.paddingTop = 0;
    chart.legend.paddingBottom = 0;
    chart.legend.fontSize = 11;
    chart.legend.wrap = true;
    chart.legend.labels.template.maxWidth = 150;
    chart.legend.labels.template.truncate = true;   
    chart.legend.scrollable = true;
    chart.legend.parent = legendContainer;

    chart.exporting.menu = new am4core.ExportMenu();
    chart.exporting.menu.align = "left";
    chart.exporting.menu.verticalAlign = "top";

    var watermark = chart.createChild(am4core.Label);
    watermark.text = "Source: [bold] kredensial.com [/]";
    watermark.align = "left";
    watermark.fillOpacity = 0.5;
    watermark.disabled = true;

    // Enable watermark on export
    chart.exporting.events.on("exportstarted", function(ev) {
      watermark.disabled = false;
    });

    // Disable watermark when export finishes
    chart.exporting.events.on("exportfinished", function(ev) {
      watermark.disabled = true;
    });

    // Add watermark to validated sprites
    chart.exporting.validateSprites.push(watermark);

    chart.responsive.enabled = true;

    var title = chart.titles.create();
    title.text = "<?php echo $judul_laporan_tabel; ?>";
    title.fontSize = 18;
    title.tooltipText = "<?php echo $judul_laporan_tabel; ?>";
    });
<?php  
} 
    if($tabel == 11){
    ?>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

var chart = am4core.create("chartdiv", am4charts.XYChart);
chart.hiddenState.properties.opacity = 0; // this creates initial fade-in


chart.data = [
<?php  
//========================================================== PHP
$group_loro = array("MONTH(tgl_logbook)", $grup2);
$period = $this->m_member->ambil_grafik_range_new($lhu,$tabel1,$select2,$konbln,$id,$group1); 
        foreach($period as $rowambil_bulan_grafik){                             //==================== FOREACH
            $bulan =  $this->m_rancak->getBulan(date('m',strtotime($rowambil_bulan_grafik['tgl_lhu'])));  
            $bln =  date('Y-m',strtotime($rowambil_bulan_grafik['tgl_lhu']));
            $tahun =  date('Y',strtotime($rowambil_bulan_grafik['tgl_lhu']));
            $join = $bulan.'   '.$tahun;
//========================================================== END PHP
?>
  {
    category: <?= '"'.$join.'"' ?>,
<?php  
//========================================================== PHP
if($lhu == 1 || $lhu == 2 || $lhu == 3){
    $skonbln = array('id_logbooker'=>$id_pegawai,'DATE_FORMAT(tgl_logbook,"%Y-%m")'=>$bln,$jumlah=>0,'id_instansi'=>$id_instansi);
}
if($lhu == 4){
    $skonbln = array('DATE_FORMAT(tgl_lhu,"%Y-%m")'=>$bln,$jumlah=>0);
}
if($lhu == 5){
    $skonbln = array('DATE_FORMAT(tgl_daftar,"%Y-%m")'=>$bln,'id_instansi'=>$id_instansi);
}
$komp = $this->m_member->ambil_grafik_range_new($lhu,$tabel1,$select2,$skonbln,$id,$grup2);
foreach($komp as $rowkomp){                                                     //==================== SUB FOREACH
//========================================================== END PHP
?>
    <?= $rowkomp['id_lhu'] ?>: <?= $rowkomp['hasil_lhu_detil'] ?>,
<?php 
//========================================================== PHP 
}                                                                               //==================== END SUB FOREACH
//========================================================== END PHP
?>
  },
<?php  
//========================================================== PHP
}                                                                               //==================== END FOREACH
//========================================================== END PHP
?>
];

chart.colors.step = 2;
chart.padding(30, 30, 10, 30);
chart.legend = new am4charts.Legend();

var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "category";
categoryAxis.renderer.grid.template.location = 0;

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.min = 0;
valueAxis.max = 100;
valueAxis.strictMinMax = true;
valueAxis.calculateTotals = true;
valueAxis.renderer.minWidth = 50;

<?php  
$kp = $this->m_member->ambil_grafik_range_new($lhu,$tabel1,$select2,$konbln,$id,$grup2);
    foreach($kp as $rowkp){
?>

var series<?= $rowkp['id_lhu'] ?> = chart.series.push(new am4charts.ColumnSeries());
series<?= $rowkp['id_lhu'] ?>.columns.template.width = am4core.percent(80);
series<?= $rowkp['id_lhu'] ?>.columns.template.tooltipText = "{name}: {valueY}";
series<?= $rowkp['id_lhu'] ?>.name = <?= '"'.$rowkp['nama_lhu'].'"' ?>;
series<?= $rowkp['id_lhu'] ?>.dataFields.categoryX = "category";
series<?= $rowkp['id_lhu'] ?>.dataFields.valueY = <?= '"'.$rowkp['id_lhu'].'"' ?>;
series<?= $rowkp['id_lhu'] ?>.dataFields.valueYShow = "totalPercent";
series<?= $rowkp['id_lhu'] ?>.dataItems.template.locations.categoryX = 0.5;
series<?= $rowkp['id_lhu'] ?>.stacked = true;
series<?= $rowkp['id_lhu'] ?>.tooltip.pointerOrientation = "vertical";

var bullet<?= $rowkp['id_lhu'] ?> = series<?= $rowkp['id_lhu'] ?>.bullets.push(new am4charts.LabelBullet());
bullet<?= $rowkp['id_lhu'] ?>.interactionsEnabled = false;
bullet<?= $rowkp['id_lhu'] ?>.label.text = "{valueY} : {valueY.totalPercent.formatNumber('#.00')}%";
//bullet<?= $rowkp['id_lhu'] ?>.label.truncate = true;
bullet<?= $rowkp['id_lhu'] ?>.label.text.wrap = true;
bullet<?= $rowkp['id_lhu'] ?>.label.fill = am4core.color("#ffffff");
bullet<?= $rowkp['id_lhu'] ?>.locationY = 0.5;


<?php  
    }
?>

chart.scrollbarX = new am4core.Scrollbar();


    chart.cursor = new am4charts.XYCursor();
    chart.cursor.lineX.strokeOpacity = 0;
    chart.cursor.lineY.strokeOpacity = 0;

    chart.zoomOutButton.align = "left";
    chart.zoomOutButton.valign = "bottom";
    chart.zoomOutButton.marginLeft = 10;
    chart.zoomOutButton.marginBottom = 10;

     //   chart.leftAxesContainer.layout = "vertical";
    //    chart.rightAxesContainer.layout = "vertical"; 
/*    var scrollbar = new am4charts.XYChartScrollbar();
    chart.scrollbarX = scrollbar;*/
/*    chart.legend = new am4charts.Legend();
    chart.legend.labels.template.text = "{categoryY}: [bold]{valueX}[/]";
//    chart.legend.position = 'top'
    chart.legend.labels.template.maxWidth = 350;
    chart.legend.labels.template.truncate = true;
    chart.legend.fontSize = 11;
    chart.legend.scrollable = true*/
   chart.legend.labels.maxWidth = 350;
   chart.legend.labels.maxHeight  = 350;
    chart.legend.labels.truncate = true;
    chart.legend.fontSize = 10;

    var legendContainer = am4core.create("legenddiv", am4core.Container);
    legendContainer.width = am4core.percent(100);
    legendContainer.height = am4core.percent(100);
    chart.legend.parent = legendContainer;
    chart.leftAxesContainer.layout = "vertical";

    chart.exporting.menu = new am4core.ExportMenu();
    chart.exporting.menu.align = "left";
    chart.exporting.menu.verticalAlign = "top";

    var watermark = chart.createChild(am4core.Label);
    watermark.text = "Source: [bold] kredensial.com [/]";
    watermark.align = "left";
    watermark.fillOpacity = 0.5;
    watermark.disabled = true;

    // Enable watermark on export
    chart.exporting.events.on("exportstarted", function(ev) {
      watermark.disabled = true;
    });

    // Disable watermark when export finishes
    chart.exporting.events.on("exportfinished", function(ev) {
      watermark.disabled = true;
    });

    // Add watermark to validated sprites
    chart.exporting.validateSprites.push(watermark);

    var title = chart.titles.create();
    title.text = "<?php echo $judul_laporan_tabel; ?>";
    title.fontSize = 18;
    title.tooltipText = "<?php echo $judul_laporan_tabel; ?>";

}); 
    <?php
    }
    if($tabel == 10){
    ?>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

var chart = am4core.create("chartdiv", am4charts.XYChart);

// some extra padding for range labels
chart.paddingBottom = 50;

chart.cursor = new am4charts.XYCursor();
chart.scrollbarX = new am4core.Scrollbar();

// will use this to store colors of the same items
var colors = {};

var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "category";
categoryAxis.renderer.minGridDistance = 60;
categoryAxis.renderer.grid.template.location = 0;
//categoryAxis.renderer.inside = true;
categoryAxis.renderer.labels.template.valign = "top";
categoryAxis.renderer.labels.template.fontSize = 9;
categoryAxis.dataItems.template.text = "{realName}";
categoryAxis.adapter.add("tooltipText", function(tooltipText, target){
  return categoryAxis.tooltipDataItem.dataContext.realName;
})

/*categoryAxis.renderer.labels.template.adapter.add("dy", function(dy, target) {
  if (target.dataItem && target.dataItem.index & 2 == 2) {
    return dy + 25;
  }
  return dy;
});*/
categoryAxis.renderer.labels.template.rotation = 90;
//categoryAxis.renderer.labels.template.rotation = 10;

let label = categoryAxis.renderer.labels.template;
label.wrap = true;
label.maxWidth = 120;

categoryAxis.events.on("sizechanged", function(ev) {
let axis = ev.target;
  var cellWidth = axis.pixelWidth / (axis.endIndex - axis.startIndex);
  if (cellWidth < axis.renderer.labels.template.maxWidth) {
    axis.renderer.labels.template.rotation = -45;
    axis.renderer.labels.template.horizontalCenter = "right";
    axis.renderer.labels.template.verticalCenter = "middle";
  }
  else {
    axis.renderer.labels.template.rotation = 0;
    axis.renderer.labels.template.horizontalCenter = "middle";
    axis.renderer.labels.template.verticalCenter = "top";
  }
});

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.tooltip.disabled = true;
valueAxis.min = 0;

// single column series for all data
var columnSeries = chart.series.push(new am4charts.ColumnSeries());
columnSeries.columns.template.width = am4core.percent(80);
columnSeries.tooltipText = "{provider}: {realName}, {valueY}";
columnSeries.dataFields.categoryX = "category";
columnSeries.dataFields.valueY = "value";

// second value axis for quantity
var valueAxis2 = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis2.renderer.opposite = true;
valueAxis2.syncWithAxis = valueAxis;
valueAxis2.tooltip.disabled = true;

// quantity line series
var lineSeries = chart.series.push(new am4charts.LineSeries());
lineSeries.tooltipText = "{valueY}";
lineSeries.dataFields.categoryX = "category";
lineSeries.dataFields.valueY = "quantity";
lineSeries.yAxis = valueAxis2;
lineSeries.bullets.push(new am4charts.CircleBullet());
lineSeries.stroke = chart.colors.getIndex(13);
lineSeries.fill = lineSeries.stroke;
lineSeries.strokeWidth = 2;
lineSeries.snapTooltip = true;

// when data validated, adjust location of data item based on count
lineSeries.events.on("datavalidated", function(){
 lineSeries.dataItems.each(function(dataItem){
   // if count divides by two, location is 0 (on the grid)
   if(dataItem.dataContext.count / 2 == Math.round(dataItem.dataContext.count / 2)){
   dataItem.setLocation("categoryX", 0);
   }
   // otherwise location is 0.5 (middle)
   else{
    dataItem.setLocation("categoryX", 0.5);
   }
 })
})

// fill adapter, here we save color value to colors object so that each time the item has the same name, the same color is used
columnSeries.columns.template.adapter.add("fill", function(fill, target) {
 var name = target.dataItem.dataContext.realName;
 if (!colors[name]) {
   colors[name] = chart.colors.next();
 }
 target.stroke = colors[name];
 return colors[name];
})

var rangeTemplate = categoryAxis.axisRanges.template;
rangeTemplate.tick.disabled = false;
rangeTemplate.tick.location = 0;
rangeTemplate.tick.strokeOpacity = 0.6;
rangeTemplate.tick.length = 60;
rangeTemplate.grid.strokeOpacity = 0.5;
rangeTemplate.label.tooltip = new am4core.Tooltip();
rangeTemplate.label.tooltip.dy = -10;
rangeTemplate.label.cloneTooltip = false;

///// DATA
var chartData = [];
var lineSeriesData = [];

var data =
{
<?php
//========================================================== PHP
$group_loro = array("MONTH(tgl_logbook)", $grup2);
$period = $this->m_member->ambil_grafik_range_new($lhu,$tabel1,$select2,$konbln,$id,$group1);
        foreach($period as $rowambil_bulan_grafik){
            $bulan =  $this->m_rancak->getBulan(date('m',strtotime($rowambil_bulan_grafik['tgl_lhu'])));  
            $bln =  date('Y-m',strtotime($rowambil_bulan_grafik['tgl_lhu']));
            $tahun =  date('Y',strtotime($rowambil_bulan_grafik['tgl_lhu']));
            $join = $bulan.'   '.$tahun;
//========================================================== # PHP
    ?>
 <?= '"'.$join.'"' ?>: 
 {
    <?php 
//========================================================== PHP
if($lhu == 1 || $lhu == 2 || $lhu == 3){
    $skonbln = array('id_logbooker'=>$id_pegawai,'DATE_FORMAT(tgl_logbook,"%Y-%m")'=>$bln,$jumlah=>0,'id_instansi'=>$id_instansi);
}
if($lhu == 4){
    $skonbln = array('barcode_pegawai'=>$barcode_pegawai,'DATE_FORMAT(tgl_lhu,"%Y-%m")'=>$bln,$jumlah=>0,'id_instansi'=>$id_instansi);
}
if($lhu == 5){
    $skonbln = array('DATE_FORMAT(tgl_daftar,"%Y-%m")'=>$bln,'id_instansi'=>$id_instansi);
}
$data_kompetensi = $this->m_member->ambil_grafik_range_new($lhu,$tabel1,$select2,$skonbln,$id,$grup2);
        foreach($data_kompetensi as $row2){
//========================================================== # PHP
    ?>
   <?= '"'.$row2['nama_lhu'].'"' ?>: <?= $row2['hasil_lhu_detil'] ?>,
   <?php  
//========================================================== PHP
        }
//========================================================== # PHP
   ?>
 },
 <?php  
 //========================================================== PHP
    }
//========================================================== # PHP
 ?>
}

// process data ant prepare it for the chart
for (var providerName in data) {
 var providerData = data[providerName];

 // add data of one provider to temp array
 var tempArray = [];
 var count = 0;
 // add items
 for (var itemName in providerData) {
   if(itemName != "quantity"){
   count++;
   // we generate unique category for each column (providerName + "_" + itemName) and store realName
   tempArray.push({ category: providerName + "_" + itemName, realName: itemName, value: providerData[itemName], provider: providerName})
   }
 }
 // sort temp array
 tempArray.sort(function(a, b) {
   if (a.value > b.value) {
   return 1;
   }
   else if (a.value < b.value) {
   return -1
   }
   else {
   return 0;
   }
 })

 // add quantity and count to middle data item (line series uses it)
 var lineSeriesDataIndex = Math.floor(count / 2);
 tempArray[lineSeriesDataIndex].quantity = providerData.quantity;
 tempArray[lineSeriesDataIndex].count = count;
 // push to the final data
 am4core.array.each(tempArray, function(item) {
   chartData.push(item);
 })



 // create range (the additional label at the bottom)
 var range = categoryAxis.axisRanges.create();
 range.category = tempArray[0].category;
 range.endCategory = tempArray[tempArray.length - 1].category;
 range.label.text = tempArray[0].provider;
 range.label.dy = 30;
 range.label.truncate = true;
 range.label.fontWeight = "bold";
 range.label.tooltipText = tempArray[0].provider;

 range.label.adapter.add("maxWidth", function(maxWidth, target){
   var range = target.dataItem;
   var startPosition = categoryAxis.categoryToPosition(range.category, 0);
   var endPosition = categoryAxis.categoryToPosition(range.endCategory, 1);
   var startX = categoryAxis.positionToCoordinate(startPosition);
   var endX = categoryAxis.positionToCoordinate(endPosition);
   return endX - startX;
 })
}

chart.data = chartData;


// last tick
var range = categoryAxis.axisRanges.create();
range.category = chart.data[chart.data.length - 1].category;
range.label.disabled = true;
range.tick.location = 1;
range.grid.location = 1;

chart.cursor = new am4charts.XYCursor();
chart.cursor.xAxis = categoryAxis;
chart.cursor.fullWidthLineX = true;
chart.cursor.lineX.strokeWidth = 0;
chart.cursor.lineX.fill = am4core.color("#8F3985");
chart.cursor.lineX.fillOpacity = 0.1;

/*    chart.cursor = new am4charts.XYCursor();
    chart.cursor.lineX.strokeOpacity = 0;
    chart.cursor.lineY.strokeOpacity = 0;*/

    chart.zoomOutButton.align = "left";
    chart.zoomOutButton.valign = "bottom";
    chart.zoomOutButton.marginLeft = 10;
    chart.zoomOutButton.marginBottom = 10;

     //   chart.leftAxesContainer.layout = "vertical";
    //    chart.rightAxesContainer.layout = "vertical"; 
    var scrollbar = new am4charts.XYChartScrollbar();
    chart.scrollbarX = scrollbar;
    chart.legend = new am4charts.Legend();
    chart.legend.labels.template.text = "{realName}, {valueY}";
//    chart.legend.position = 'top'
    chart.legend.labels.template.maxWidth = 350;
    chart.legend.labels.template.truncate = true;
    chart.legend.fontSize = 11;
    chart.legend.scrollable = true

/*    var legendContainer = am4core.create("legenddiv", am4core.Container);
    legendContainer.width = am4core.percent(100);
    legendContainer.height = am4core.percent(100);
    chart.legend.parent = legendContainer;
    chart.leftAxesContainer.layout = "vertical";*/

    chart.exporting.menu = new am4core.ExportMenu();
    chart.exporting.menu.align = "left";
    chart.exporting.menu.verticalAlign = "top";

    var watermark = chart.createChild(am4core.Label);
    watermark.text = "Source: [bold] kredensial.com [/]";
    watermark.align = "left";
    watermark.fillOpacity = 0.5;
    watermark.disabled = true;

    // Enable watermark on export
    chart.exporting.events.on("exportstarted", function(ev) {
      watermark.disabled = true;
    });

    // Disable watermark when export finishes
    chart.exporting.events.on("exportfinished", function(ev) {
      watermark.disabled = true;
    });

    // Add watermark to validated sprites
    chart.exporting.validateSprites.push(watermark);

    var title = chart.titles.create();
    title.text = "<?php echo $judul_laporan_tabel; ?>";
    title.fontSize = 18;
    title.tooltipText = "<?php echo $judul_laporan_tabel; ?>";

}); // end am4core.ready()
    <?php
    }
    if($tabel == 9){
?>
am4core.ready(function() {
am4core.useTheme(am4themes_animated);
var chart = am4core.create("chartdiv", am4charts.XYChart);

chart.data = [
<?php  
//========================================================== PHP
$period = $this->m_member->ambil_grafik_range_new($lhu,$tabel1,$select2,$konbln,$id,$grtgl);
    foreach($period as $rowambil_bulan_grafik){
        $tahun =  date('d-m-Y',strtotime($rowambil_bulan_grafik['tgl_lhu']));
        $tgl =  date('Y-m-d',strtotime($rowambil_bulan_grafik['tgl_lhu']));
//========================================================== # PHP
?>
{
  "year": <?= '"'.$tahun.'"' ?>,
  <?php  
//========================================================== PHP
if($lhu == 1 || $lhu == 2 || $lhu == 3){
    $skonbln = array('id_logbooker'=>$id_pegawai,'tgl_logbook'=>$tgl,$jumlah=>0,'id_instansi'=>$id_instansi);
}
if($lhu == 4){
    $skonbln = array('barcode_pegawai'=>$barcode_pegawai,'tgl_lhu'=>$tgl,$jumlah=>0,'id_instansi'=>$id_instansi);
}
if($lhu == 5){
    $skonbln = array('tgl_daftar'=>$tgl,'id_instansi'=>$id_instansi);
}
$data_kompetensi = $this->m_member->ambil_grafik_range_new($lhu,$tabel1,$select2,$skonbln,$id,$grup2);
        foreach($data_kompetensi as $row2){
//========================================================== # PHP
  ?>
  <?= '"'.$row2['id_lhu'].'"' ?>: <?= $row2['hasil_lhu_detil'] ?>,
  <?php
//========================================================== PHP
        }
//========================================================== # PHP
  ?>
}, 
<?php
//========================================================== PHP
    }
//========================================================== # PHP
?>
];

/*            chart.responsive.enabled = true;
            chart.maskBullets = false;
            chart.dateFormatter.dateFormat = "dd-MM-yyyy";*/

// Create category axis
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "year";
categoryAxis.renderer.opposite = true;
//categoryAxis.fontSize = 10;

/*categoryAxis.tooltip.getFillFromObject = false; 
categoryAxis.tooltip.label.fill = "#ff0000"
categoryAxis.tooltip.label.fontFamily = "Courier New"
categoryAxis.tooltip.label.fontSize = 7;*/

// Create value axis
var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.inversed = false;
valueAxis.title.text = "Nilai";
valueAxis.renderer.minLabelPosition = 0.01;
//valueAxis.fontSize = 10;;


/*            var categoryAxis = chart.xAxes.push(new am4charts.DateAxis());
            categoryAxis.renderer.grid.template.location = 0;
            categoryAxis.renderer.minGridDistance = 30;

            var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
            dateAxis.renderer.minGridDistance = 30;
            dateAxis.periodChangeDateFormats.setKey("month", "[bold]yyyy");
            */
       // valueAxis.min = ?php echo $min_standar; ?>;
        // valueAxis.max = ?php echo $max_standar; ?>;

<?php  
//========================================================== PHP
$pseries = $this->m_member->ambil_grafik_range_new($lhu,$tabel1,$select2,$konbln,$id,$grup2);
    foreach($pseries as $rowpseries){
//========================================================== # PHP
?>
var series<?= $rowpseries['id_lhu'] ?> = chart.series.push(new am4charts.LineSeries());
series<?= $rowpseries['id_lhu'] ?>.dataFields.valueY = <?= '"'.$rowpseries['id_lhu'].'"' ?>;
series<?= $rowpseries['id_lhu'] ?>.dataFields.categoryX = "year";
series<?= $rowpseries['id_lhu'] ?>.name = <?= '"'.$rowpseries['nama_lhu'].'"' ?>;
series<?= $rowpseries['id_lhu'] ?>.bullets.push(new am4charts.CircleBullet());
series<?= $rowpseries['id_lhu'] ?>.tooltipText = "{name} tgl {categoryX} = {valueY}";
series<?= $rowpseries['id_lhu'] ?>.legendSettings.valueText = "{valueY}";
series<?= $rowpseries['id_lhu'] ?>.visible  = true;

let hs<?= $rowpseries['id_lhu'] ?> = series<?= $rowpseries['id_lhu'] ?>.segments.template.states.create("hover")
hs<?= $rowpseries['id_lhu'] ?>.properties.strokeWidth = 5;
series<?= $rowpseries['id_lhu'] ?>.segments.template.strokeWidth = 1;

var circleBullet<?= $rowpseries['id_lhu'] ?> = series<?= $rowpseries['id_lhu'] ?>.bullets.push(new am4charts.CircleBullet());
circleBullet<?= $rowpseries['id_lhu'] ?>.circle.stroke = am4core.color("#fff");
circleBullet<?= $rowpseries['id_lhu'] ?>.circle.strokeWidth = 2;
circleBullet<?= $rowpseries['id_lhu'] ?>.tooltipText = "Value: [bold]{name} : {valueY}[/]";

var labelBullet<?= $rowpseries['id_lhu'] ?> = series<?= $rowpseries['id_lhu'] ?>.bullets.push(new am4charts.LabelBullet());
labelBullet<?= $rowpseries['id_lhu'] ?>.label.text = "[bold {color}]{valueY}[/]";
//labelBullet<?= $rowpseries['id_lhu'] ?>.label.text = "[bold {color}]{name} \n {valueY}[/]";
labelBullet<?= $rowpseries['id_lhu'] ?>.label.dy = -20;
labelBullet<?= $rowpseries['id_lhu'] ?>.fontSize = 9;

<?php  
//========================================================== PHP
}
//========================================================== # PHP
?>
chart.cursor = new am4charts.XYCursor();
chart.cursor.xAxis = categoryAxis;
chart.cursor.fullWidthLineX = true;
chart.cursor.lineX.strokeWidth = 0;
chart.cursor.lineX.fill = am4core.color("#8F3985");
chart.cursor.lineX.fillOpacity = 0.1;
/*    chart.cursor = new am4charts.XYCursor();
    chart.cursor.lineX.strokeOpacity = 0;
    chart.cursor.lineY.strokeOpacity = 0;*/

    chart.zoomOutButton.align = "left";
    chart.zoomOutButton.valign = "bottom";
    chart.zoomOutButton.marginLeft = 10;
    chart.zoomOutButton.marginBottom = 10;

    var scrollbar = new am4charts.XYChartScrollbar();

    chart.scrollbarX = scrollbar;
    chart.legend = new am4charts.Legend();
    chart.legend.labels.template.text = "[bold {color}]{name}[/]";

//    chart.legend.scrollable = true
     //   chart.leftAxesContainer.layout = "vertical";
    //    chart.rightAxesContainer.layout = "vertical"; 

var legendContainer = am4core.create("legenddiv", am4core.Container);
legendContainer.width = am4core.percent(100);
legendContainer.height = am4core.percent(100);
chart.legend.parent = legendContainer;
 //   chart.legend = new am4charts.Legend();
  //  chart.legend.labels.template.text = "[bold {color}]{name}[/]";
 //      chart.legend.labels.template.text = "[bold {color}]{name} : {value} [/]";
       chart.legend.labels.template.text = "[bold {color}]{name} : tgl {categoryX} = {value} [/]";
    chart.legend.labels.template.maxWidth = 350;
    chart.legend.labels.template.truncate = true;
chart.legend.fontSize = 11;
 //   chart.legend.scrollable = true
    chart.leftAxesContainer.layout = "vertical";

    chart.exporting.menu = new am4core.ExportMenu();
    chart.exporting.menu.align = "left";
    chart.exporting.menu.verticalAlign = "top";

    var watermark = chart.createChild(am4core.Label);
    watermark.text = "Source: [bold] kredensial.com [/]";
    watermark.align = "left";
    watermark.fillOpacity = 0.5;
    watermark.disabled = true;

    // Enable watermark on export
    chart.exporting.events.on("exportstarted", function(ev) {
      watermark.disabled = true;
    });

    // Disable watermark when export finishes
    chart.exporting.events.on("exportfinished", function(ev) {
      watermark.disabled = true;
    });

    // Add watermark to validated sprites
    chart.exporting.validateSprites.push(watermark);

    var title = chart.titles.create();
    title.text = "<?php echo $judul_laporan_tabel; ?>";
    title.fontSize = 18;
    title.tooltipText = "<?php echo $judul_laporan_tabel; ?>";

}); // end am4core.ready()
<?php
    }
if($tabel == 455){
?>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.XYChart);

//

// Increase contrast by taking evey second color
chart.colors.step = 2;

// Add data
chart.data = [{
  "date": new Date(2023, 11, 20),
  "visits": 90,
  "views": 45,
  "hits": 65,
}, {
  "date": new Date(2024, 1, 21),
  "visits": 102,
  "views": 78,
  "hits": 83,
}, {
  "date": new Date(2024, 2, 22),
  "visits": 65,
  "views": 23,
  "vishitsits": 74,
}, {
  "date": new Date(2024, 2, 23),
  "visits": 62,
  "views": 76,
  "hits": 59,
}, {
  "date": new Date(2024, 3, 24),
  "visits": 55,
  "views": 53,
  "hits": 63,
}, {
  "date": new Date(2024, 3, 25),
  "visits": 81,
  "views": 76,
  "hits": 84,
}];

// Create axes
var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
dateAxis.renderer.minGridDistance = 50;

// Create series
function createAxisAndSeries(field, name, opposite, bullet) {
  var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
  if(chart.yAxes.indexOf(valueAxis) != 0){
    valueAxis.syncWithAxis = chart.yAxes.getIndex(0);
  }
  
  var series = chart.series.push(new am4charts.LineSeries());
  series.dataFields.valueY = field;
  series.dataFields.dateX = "date";
  series.strokeWidth = 2;
  series.yAxis = valueAxis;
  series.name = name;
  series.tooltipText = "{name}: [bold]{valueY}[/]";
  series.tensionX = 0.8;
  series.showOnInit = true;
  
  var interfaceColors = new am4core.InterfaceColorSet();
  
  switch(bullet) {
    case "triangle":
      var bullet = series.bullets.push(new am4charts.Bullet());
      bullet.width = 12;
      bullet.height = 12;
      bullet.horizontalCenter = "middle";
      bullet.verticalCenter = "middle";
      
      var triangle = bullet.createChild(am4core.Triangle);
      triangle.stroke = interfaceColors.getFor("background");
      triangle.strokeWidth = 2;
      triangle.direction = "top";
      triangle.width = 12;
      triangle.height = 12;
      break;
    case "rectangle":
      var bullet = series.bullets.push(new am4charts.Bullet());
      bullet.width = 10;
      bullet.height = 10;
      bullet.horizontalCenter = "middle";
      bullet.verticalCenter = "middle";
      
      var rectangle = bullet.createChild(am4core.Rectangle);
      rectangle.stroke = interfaceColors.getFor("background");
      rectangle.strokeWidth = 2;
      rectangle.width = 10;
      rectangle.height = 10;
      break;
    default:
      var bullet = series.bullets.push(new am4charts.CircleBullet());
      bullet.circle.stroke = interfaceColors.getFor("background");
      bullet.circle.strokeWidth = 2;
      break;
  }
  
  valueAxis.renderer.line.strokeOpacity = 1;
  valueAxis.renderer.line.strokeWidth = 2;
  valueAxis.renderer.line.stroke = series.stroke;
  valueAxis.renderer.labels.template.fill = series.stroke;
  valueAxis.renderer.opposite = opposite;
}

createAxisAndSeries("visits", "Visits", false, "circle");
createAxisAndSeries("views", "Views", true, "triangle");
createAxisAndSeries("hits", "Hits", true, "rectangle");

// Add legend
chart.legend = new am4charts.Legend();
chart.legend.scrollable = true
chart.legend.labels.template.maxWidth = 350;
chart.legend.labels.template.truncate = true;
chart.legend.fontSize = 11;

chart.cursor = new am4charts.XYCursor();
chart.cursor.xAxis = categoryAxis;
chart.cursor.fullWidthLineX = true;
chart.cursor.lineX.strokeWidth = 0;
chart.cursor.lineX.fill = am4core.color("#8F3985");
chart.cursor.lineX.fillOpacity = 0.1;
/*    chart.cursor = new am4charts.XYCursor();
    chart.cursor.lineX.strokeOpacity = 0;
    chart.cursor.lineY.strokeOpacity = 0;*/

    chart.zoomOutButton.align = "left";
    chart.zoomOutButton.valign = "bottom";
    chart.zoomOutButton.marginLeft = 10;
    chart.zoomOutButton.marginBottom = 10;

    var scrollbar = new am4charts.XYChartScrollbar();

    chart.scrollbarX = scrollbar;
/*    chart.legend = new am4charts.Legend();
    chart.legend.labels.template.text = "[bold {color}]{name}[/]";*/

//    chart.legend.scrollable = true
     //   chart.leftAxesContainer.layout = "vertical";
    //    chart.rightAxesContainer.layout = "vertical"; 

var legendContainer = am4core.create("legenddiv", am4core.Container);
legendContainer.width = am4core.percent(100);
legendContainer.height = am4core.percent(100);
chart.legend.parent = legendContainer;
 //   chart.legend = new am4charts.Legend();
  //  chart.legend.labels.template.text = "[bold {color}]{name}[/]";
 //      chart.legend.labels.template.text = "[bold {color}]{name} : {value} [/]";
/*       chart.legend.labels.template.text = "[bold {color}]{name} : tgl {categoryX} = {value} [/]";
    chart.legend.labels.template.maxWidth = 350;
    chart.legend.labels.template.truncate = true;
chart.legend.fontSize = 11;*/
 //   chart.legend.scrollable = true
    chart.leftAxesContainer.layout = "vertical";

    chart.exporting.menu = new am4core.ExportMenu();
    chart.exporting.menu.align = "left";
    chart.exporting.menu.verticalAlign = "top";

    var watermark = chart.createChild(am4core.Label);
    watermark.text = "Source: [bold] kredensial.com [/]";
    watermark.align = "left";
    watermark.fillOpacity = 0.5;
    watermark.disabled = true;

    // Enable watermark on export
    chart.exporting.events.on("exportstarted", function(ev) {
      watermark.disabled = true;
    });

    // Disable watermark when export finishes
    chart.exporting.events.on("exportfinished", function(ev) {
      watermark.disabled = true;
    });

    // Add watermark to validated sprites
    chart.exporting.validateSprites.push(watermark);

    var title = chart.titles.create();
    title.text = "<?php echo $judul_laporan_tabel; ?>";
    title.fontSize = 18;
    title.tooltipText = "<?php echo $judul_laporan_tabel; ?>";

}); // end am4core.ready()
<?php  
}
if($tabel == 4){
?>
    am4core.ready(function() {
    am4core.useTheme(am4themes_animated);
    var chart = am4core.create("chartdiv", am4charts.XYChart);

    chart.data = [
    <?php
    $jml_hasil_lhu = 0;
    foreach($grafik_garis_opsi as $rowgrafik_garis_opsi){
    ?>
    {
      "year": new Date(<?php echo $rowgrafik_garis_opsi['thn']; ?>, <?php echo $rowgrafik_garis_opsi['bln']-1; ?>, <?php echo $rowgrafik_garis_opsi['hr']; ?>),
      <?php
     if($lhu == 1){ // 1kompetensi-2bakhp-3reject-4lhu
    	$jsonx = $this->m_member->grafik_garis_hasil_logbook($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_lhu'],$kewenangan,$share_it,$idpeg);
    }
    if($lhu == 2){
    	$jsonx = $this->m_member->grafik_garis_hasil_pasien($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_lhu'],'id_bahan','jml_bahan');
    }
    if($lhu == 3){
    	$jsonx = $this->m_member->grafik_garis_hasil_pasien($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_lhu'],'id_reject','jml_reject');
    }
    if($lhu == 4){
  	    $jsonx = $this->m_member->grafik_garis_hasil_lhu($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_lhu'],$select_jscode,$id);
    }
      foreach($jsonx as $row2){
      	$jml_hasil_lhu = $jml_hasil_lhu + $row2['hasil_lhu_detil'];
      ?>
      <?php echo '"'.$row2['id_lhu'].'"'; ?>:<?php echo round($row2['hasil_lhu_detil'],2); ?>,
      "jumlahemas":<?php echo round($jml_hasil_lhu,2); ?>
      <?php
      }
      ?>
    },
    <?php
    }
    ?>
    ];

    chart.maskBullets = false;
    chart.dateFormatter.dateFormat = "dd-MM-yyyy";

// Create axes
var categoryAxis = chart.xAxes.push(new am4charts.DateAxis());
//var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 30;

let label = categoryAxis.renderer.labels.template;
label.wrap = true;
label.maxWidth = 120;

categoryAxis.events.on("sizechanged", function(ev) {
let axis = ev.target;
  var cellWidth = axis.pixelWidth / (axis.endIndex - axis.startIndex);
  if (cellWidth < axis.renderer.labels.template.maxWidth) {
    axis.renderer.labels.template.rotation = -45;
    axis.renderer.labels.template.horizontalCenter = "right";
    axis.renderer.labels.template.verticalCenter = "middle";
  }
  else {
    axis.renderer.labels.template.rotation = 0;
    axis.renderer.labels.template.horizontalCenter = "middle";
    axis.renderer.labels.template.verticalCenter = "top";
  }
});

var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
dateAxis.renderer.minGridDistance = 30;

// Set date label formatting
dateAxis.periodChangeDateFormats.setKey("month", "[bold]yyyy");
// Create series
function createSeriesAndAxis(field, name, topMargin, bottomMargin) {
    // Create value axis
    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.renderer.minLabelPosition = 0.01;

  
  var series = chart.series.push(new am4charts.LineSeries());
  series.dataFields.valueY = field;
  series.dataFields.dateX = "year";
//  series.dataFields.categoryX = "year";
  series.name = name;
//  series.tooltipText = "{dateX}: [b]{valueY}[/]";
  series.strokeWidth = 2;
  series.yAxis = valueAxis;
//  series.legendSettings.valueText = "{valueY}";

//  series.visible  = false;

  let hs = series.segments.template.states.create("hover")
  hs.properties.strokeWidth = 5;
  series.segments.template.strokeWidth = 1;

  // Add simple bullet
  var circleBullet = series.bullets.push(new am4charts.CircleBullet());
  circleBullet.circle.stroke = am4core.color("#fff");
  circleBullet.circle.strokeWidth = 2;
 // circleBullet.tooltipText = "[bold]{name} : {valueY}[/]";

  var labelBullet = series.bullets.push(new am4charts.LabelBullet());
  labelBullet.label.text = "[bold]{valueY}[/]";
  labelBullet.label.dy = -20;
  labelBullet.fontSize = 11;
  
  valueAxis.renderer.line.strokeOpacity = 1;
  valueAxis.renderer.line.stroke = series.stroke;
  valueAxis.renderer.grid.template.stroke = series.stroke;
  valueAxis.renderer.grid.template.strokeOpacity = 0.1;
  valueAxis.renderer.labels.template.fill = series.stroke;
  valueAxis.renderer.minGridDistance = 25;
  valueAxis.align = "right";
  
  if (topMargin && bottomMargin) {
    valueAxis.marginTop = 10;
    valueAxis.marginBottom = 10;
  }
  else {
    if (topMargin) {
      valueAxis.marginTop = 20;
    }
    if (bottomMargin) {
      valueAxis.marginBottom = 20;
    }
  }
  
    var bullet = series.bullets.push(new am4charts.CircleBullet());
    bullet.circle.stroke = am4core.color("#fff");
    bullet.circle.strokeWidth = 2;
    bullet.adapter.add("dy", function(dy, target) {
      hideBullet(target);
      return dy;
    })

    function hideBullet(bullet) {
      if (bullet.pixelX < 0 || bullet.pixelX > chart.plotContainer.measuredWidth || bullet.pixelY < 0 || bullet.pixelY > chart.plotContainer.measuredHeight) {
        bullet.visible = false;
      }
      else {
        bullet.visible = true;
      }
    }
}

    <?php
    foreach($ambil_limbah_grafik as $rowambil_limbah_grafik){
    ?>
    createSeriesAndAxis(<?php echo '"'.$rowambil_limbah_grafik['id_lhu'].'"'; ?>, <?php echo '"'.$rowambil_limbah_grafik['nama_lhu'].'"'; ?>, true, true);
    <?php
    }
    ?>

var latitudeSeries = chart.series.push(new am4charts.LineSeries());
latitudeSeries.dataFields.valueY = "jumlahemas";
latitudeSeries.dataFields.dateX = "year";
//latitudeSeries.yAxis = latitudeAxis;
//latitudeSeries.name = "Total";
latitudeSeries.strokeWidth = 2;
//latitudeSeries.propertyFields.strokeDasharray = "dashLength";
latitudeSeries.tooltipText = "Total : ({jumlahemas})";
//latitudeSeries.showOnInit = true;

var latitudeBullet = latitudeSeries.bullets.push(new am4charts.CircleBullet());
latitudeBullet.circle.fill = am4core.color("#f00");
latitudeBullet.circle.strokeWidth = 2;
latitudeBullet.circle.propertyFields.radius = "townSize";

var latitudeState = latitudeBullet.states.create("hover");
latitudeState.properties.scale = 1.2;

var latitudeLabel = latitudeSeries.bullets.push(new am4charts.LabelBullet());
latitudeLabel.label.text = "{valueY}";
latitudeLabel.label.horizontalCenter = "left";
latitudeLabel.label.dx = 20;
//latitudeLabel.label.dy = -20;
latitudeLabel.fontSize = 11;

    // createSeriesAndAxis("value", "Series #1", false, true);
    chart.cursor = new am4charts.XYCursor();
    chart.cursor.lineX.strokeOpacity = 0;
    chart.cursor.lineY.strokeOpacity = 0;

    chart.zoomOutButton.align = "left";
    chart.zoomOutButton.valign = "bottom";
    chart.zoomOutButton.marginLeft = 10;
    chart.zoomOutButton.marginBottom = 10;

    // Add scrollbar
    var scrollbar = new am4charts.XYChartScrollbar();
    //scrollbar.series.push(series)

    chart.scrollbarX = scrollbar;

    chart.legend = new am4charts.Legend();
    chart.legend.labels.template.text = "[bold {color}]{name}[/]";

    chart.legend.scrollable = true
//    chart.leftAxesContainer.layout = "vertical";
    chart.rightAxesContainer.layout = "vertical"; 

    chart.exporting.menu = new am4core.ExportMenu();
    chart.exporting.menu.align = "left";
    chart.exporting.menu.verticalAlign = "top";

    var watermark = chart.createChild(am4core.Label);
    watermark.text = "Source: [bold] kredensial.com [/]";
    watermark.align = "left";
    watermark.fillOpacity = 0.5;
    watermark.disabled = true;

    chart.exporting.events.on("exportstarted", function(ev) {
      watermark.disabled = true;
    });

    chart.exporting.events.on("exportfinished", function(ev) {
      watermark.disabled = true;
    });

    chart.exporting.validateSprites.push(watermark);

    var title = chart.titles.create();
    title.text = "<?php echo $judul_laporan_tabel; ?>";
    title.fontSize = 18;
    title.tooltipText = "<?php echo $judul_laporan_tabel; ?>";

    }); 
<?php  
}
if($tabel == 5){
?>
    am4core.ready(function() {
    am4core.useTheme(am4themes_animated);
    var chart = am4core.create("chartdiv", am4charts.XYChart);

    chart.data = [
    <?php
    foreach($grafik_garis_opsi as $rowgrafik_garis_opsi){
    ?>
    {
      "year": new Date(<?php echo $rowgrafik_garis_opsi['thn']; ?>, <?php echo $rowgrafik_garis_opsi['bln']-1; ?>, <?php echo $rowgrafik_garis_opsi['hr']; ?>),
      <?php
     if($lhu == 1){ // 1kompetensi-2bakhp-3reject-4lhu
    	$jsonx = $this->m_member->grafik_garis_hasil_logbook($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_lhu'],$kewenangan,$share_it,$idpeg);
    }
    if($lhu == 2){
    	$jsonx = $this->m_member->grafik_garis_hasil_pasien($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_lhu'],'id_bahan','jml_bahan');
    }
    if($lhu == 3){
    	$jsonx = $this->m_member->grafik_garis_hasil_pasien($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_lhu'],'id_reject','jml_reject');
    }
    if($lhu == 4){
  	    $jsonx = $this->m_member->grafik_garis_hasil_lhu($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_lhu'],$select_jscode,$id);
    }
      foreach($jsonx as $row2){
      ?>
      <?php echo '"'.$row2['id_lhu'].'"'; ?>:<?php echo round($row2['hasil_lhu_detil'],2); ?>,
      <?php
      }
      ?>
    },
    <?php
    }
    ?>
    ];

    chart.maskBullets = false;
    chart.dateFormatter.dateFormat = "dd-MM-yyyy";

// Create axes
var categoryAxis = chart.xAxes.push(new am4charts.DateAxis());
//var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 30;

let label = categoryAxis.renderer.labels.template;
label.wrap = true;
label.maxWidth = 120;

categoryAxis.events.on("sizechanged", function(ev) {
let axis = ev.target;
  var cellWidth = axis.pixelWidth / (axis.endIndex - axis.startIndex);
  if (cellWidth < axis.renderer.labels.template.maxWidth) {
    axis.renderer.labels.template.rotation = -45;
    axis.renderer.labels.template.horizontalCenter = "right";
    axis.renderer.labels.template.verticalCenter = "middle";
  }
  else {
    axis.renderer.labels.template.rotation = 0;
    axis.renderer.labels.template.horizontalCenter = "middle";
    axis.renderer.labels.template.verticalCenter = "top";
  }
});

var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
dateAxis.renderer.minGridDistance = 30;

// Set date label formatting
dateAxis.periodChangeDateFormats.setKey("month", "[bold]yyyy");
// Create series
function createSeriesAndAxis(field, name, topMargin, bottomMargin) {
    // Create value axis
    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.renderer.minLabelPosition = 0.01;

  
  var series = chart.series.push(new am4charts.LineSeries());
  series.dataFields.valueY = field;
  series.dataFields.dateX = "year";
//  series.dataFields.categoryX = "year";
  series.name = name;
//  series.tooltipText = "{dateX}: [b]{valueY}[/]";
  series.strokeWidth = 2;
  series.yAxis = valueAxis;
//  series.legendSettings.valueText = "{valueY}";

//  series.visible  = false;

  let hs = series.segments.template.states.create("hover")
  hs.properties.strokeWidth = 5;
  series.segments.template.strokeWidth = 1;

  // Add simple bullet
  var circleBullet = series.bullets.push(new am4charts.CircleBullet());
  circleBullet.circle.stroke = am4core.color("#fff");
  circleBullet.circle.strokeWidth = 2;
 // circleBullet.tooltipText = "[bold]{name} : {valueY}[/]";

  var labelBullet = series.bullets.push(new am4charts.LabelBullet());
  labelBullet.label.text = "[bold]{valueY}[/]";
  labelBullet.label.dy = -20;
  labelBullet.fontSize = 11;
  
  valueAxis.renderer.line.strokeOpacity = 1;
  valueAxis.renderer.line.stroke = series.stroke;
  valueAxis.renderer.grid.template.stroke = series.stroke;
  valueAxis.renderer.grid.template.strokeOpacity = 0.1;
  valueAxis.renderer.labels.template.fill = series.stroke;
  valueAxis.renderer.minGridDistance = 25;
  valueAxis.align = "right";
  
  if (topMargin && bottomMargin) {
    valueAxis.marginTop = 10;
    valueAxis.marginBottom = 10;
  }
  else {
    if (topMargin) {
      valueAxis.marginTop = 20;
    }
    if (bottomMargin) {
      valueAxis.marginBottom = 20;
    }
  }
  
    var bullet = series.bullets.push(new am4charts.CircleBullet());
    bullet.circle.stroke = am4core.color("#fff");
    bullet.circle.strokeWidth = 2;
    bullet.adapter.add("dy", function(dy, target) {
      hideBullet(target);
      return dy;
    })

    function hideBullet(bullet) {
      if (bullet.pixelX < 0 || bullet.pixelX > chart.plotContainer.measuredWidth || bullet.pixelY < 0 || bullet.pixelY > chart.plotContainer.measuredHeight) {
        bullet.visible = false;
      }
      else {
        bullet.visible = true;
      }
    }
}

    <?php
    foreach($ambil_limbah_grafik as $rowambil_limbah_grafik){
    ?>
    createSeriesAndAxis(<?php echo '"'.$rowambil_limbah_grafik['id_lhu'].'"'; ?>, <?php echo '"'.$rowambil_limbah_grafik['nama_lhu'].'"'; ?>, true, true);
    <?php
    }
    ?>

    // createSeriesAndAxis("value", "Series #1", false, true);
    chart.cursor = new am4charts.XYCursor();
    chart.cursor.lineX.strokeOpacity = 0;
    chart.cursor.lineY.strokeOpacity = 0;

    chart.zoomOutButton.align = "left";
    chart.zoomOutButton.valign = "bottom";
    chart.zoomOutButton.marginLeft = 10;
    chart.zoomOutButton.marginBottom = 10;

    // Add scrollbar
    var scrollbar = new am4charts.XYChartScrollbar();
    //scrollbar.series.push(series)

    chart.scrollbarX = scrollbar;

    chart.legend = new am4charts.Legend();
    chart.legend.labels.template.text = "[bold {color}]{name}[/]";

    chart.legend.scrollable = true
//    chart.leftAxesContainer.layout = "vertical";
    chart.rightAxesContainer.layout = "vertical"; 

    chart.exporting.menu = new am4core.ExportMenu();
    chart.exporting.menu.align = "left";
    chart.exporting.menu.verticalAlign = "top";

    var watermark = chart.createChild(am4core.Label);
    watermark.text = "Source: [bold] kredensial.com [/]";
    watermark.align = "left";
    watermark.fillOpacity = 0.5;
    watermark.disabled = true;

    chart.exporting.events.on("exportstarted", function(ev) {
      watermark.disabled = true;
    });

    chart.exporting.events.on("exportfinished", function(ev) {
      watermark.disabled = true;
    });

    chart.exporting.validateSprites.push(watermark);

    var title = chart.titles.create();
    title.text = "<?php echo $judul_laporan_tabel; ?>";
    title.fontSize = 18;
    title.tooltipText = "<?php echo $judul_laporan_tabel; ?>";

    }); 
<?php  
}
	// ---------------------------------- 11 Grafik Garis Range separate No 8
 if($tabel == 8){
?>
    am4core.ready(function() {
    am4core.useTheme(am4themes_animated);
    var chart = am4core.create("chartdiv", am4charts.XYChart);

    chart.data = [
    <?php
    $jml_hasil_lhu = 0;
    foreach($grafik_garis_opsi as $rowgrafik_garis_opsi){
    ?>
    {
    //  "year":  echo '"'.$rowgrafik_garis_opsi['tgl_lhu'].'"'; ?>,
      "year": new Date(<?php echo $rowgrafik_garis_opsi['thn']; ?>, <?php echo $rowgrafik_garis_opsi['bln']-1; ?>, <?php echo $rowgrafik_garis_opsi['hr']; ?>),
      <?php
      $no = 0;

    if($lhu == 1){ // 1kompetensi-2bakhp-3reject-4lhu
    	$jsonx = $this->m_member->grafik_garis_hasil_logbook($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_lhu'],$kewenangan,$share_it,$idpeg);
    }
    if($lhu == 2){
    	$jsonx = $this->m_member->grafik_garis_hasil_pasien($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_lhu'],'id_bahan','jml_bahan');
    }
    if($lhu == 3){
    	$jsonx = $this->m_member->grafik_garis_hasil_pasien($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_lhu'],'id_reject','jml_reject');
    }
    if($lhu == 4){
  	    $jsonx = $this->m_member->grafik_garis_hasil_lhu($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_lhu'],$select_jscode,$id);
    }
      foreach($jsonx as $row2){
      	$jml_hasil_lhu = $jml_hasil_lhu + $row2['hasil_lhu_detil'];
          $no++;
      ?>
      <?php echo '"'.$row2['id_lhu'].'"'; ?>:<?php echo round($row2['hasil_lhu_detil'],2); ?>,
      "jumlahemas":<?php echo round($jml_hasil_lhu,2); ?>
      <?php
      }
      ?>
    },
    <?php
    }
    ?>
    ];

    chart.maskBullets = false;
    chart.dateFormatter.dateFormat = "dd-MM-yyyy";

// Create axes
var categoryAxis = chart.xAxes.push(new am4charts.DateAxis());
//var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 30;

var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
dateAxis.renderer.minGridDistance = 30;

// Set date label formatting
dateAxis.periodChangeDateFormats.setKey("month", "[bold]yyyy");
// Create series
function createSeriesAndAxis(field, name, topMargin, bottomMargin) {
    // Create value axis
    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.renderer.minLabelPosition = 0.01;
       // valueAxis.min = ?php echo $min_standar; ?>;
        // valueAxis.max = ?php echo $max_standar; ?>;
  
  var series = chart.series.push(new am4charts.LineSeries());
  series.dataFields.valueY = field;
  series.dataFields.dateX = "year";
//  series.dataFields.categoryX = "year";
  series.name = name;
//  series.tooltipText = "{name}: [b]{valueY}[/]";
  series.strokeWidth = 2;
  series.yAxis = valueAxis;
//  series.legendSettings.valueText = "{valueY}";

//  series.visible  = false;

  let hs = series.segments.template.states.create("hover")
  hs.properties.strokeWidth = 5;
  series.segments.template.strokeWidth = 1;

  // Add simple bullet
  var circleBullet = series.bullets.push(new am4charts.CircleBullet());
  circleBullet.circle.stroke = am4core.color("#fff");
  circleBullet.circle.strokeWidth = 2;
 // circleBullet.tooltipText = "[bold]{name} : {valueY}[/]";

  var labelBullet = series.bullets.push(new am4charts.LabelBullet());
  labelBullet.label.text = "[bold]{valueY}[/]";
  labelBullet.label.dy = -20;
  labelBullet.fontSize = 11;

			//	labelBullet.tooltip.label.wrap = true;
			//	labelBullet.tooltip.label.width = 300;
  
  valueAxis.renderer.line.strokeOpacity = 1;
  valueAxis.renderer.line.stroke = series.stroke;
  valueAxis.renderer.grid.template.stroke = series.stroke;
  valueAxis.renderer.grid.template.strokeOpacity = 0.1;
  valueAxis.renderer.labels.template.fill = series.stroke;
  valueAxis.renderer.minGridDistance = 25;
  valueAxis.align = "right";
  
  if (topMargin && bottomMargin) {
    valueAxis.marginTop = 10;
    valueAxis.marginBottom = 10;
  }
  else {
    if (topMargin) {
      valueAxis.marginTop = 20;
    }
    if (bottomMargin) {
      valueAxis.marginBottom = 20;
    }
  }
  
    var bullet = series.bullets.push(new am4charts.CircleBullet());
    bullet.circle.stroke = am4core.color("#fff");
    bullet.circle.strokeWidth = 2;
    bullet.adapter.add("dy", function(dy, target) {
      hideBullet(target);
      return dy;
    })

    function hideBullet(bullet) {
      if (bullet.pixelX < 0 || bullet.pixelX > chart.plotContainer.measuredWidth || bullet.pixelY < 0 || bullet.pixelY > chart.plotContainer.measuredHeight) {
        bullet.visible = false;
      }
      else {
        bullet.visible = true;
      }
    }
}

    <?php
    foreach($ambil_limbah_grafik as $rowambil_limbah_grafik){
    ?>
    createSeriesAndAxis(<?php echo '"'.$rowambil_limbah_grafik['id_lhu'].'"'; ?>, <?php echo '"'.$rowambil_limbah_grafik['nama_lhu'].'"'; ?>, true, true);
    <?php
    }
    ?>

    // createSeriesAndAxis("value", "Series #1", false, true);
    chart.cursor = new am4charts.XYCursor();
    chart.cursor.lineX.strokeOpacity = 0;
    chart.cursor.lineY.strokeOpacity = 0;

    chart.zoomOutButton.align = "left";
    chart.zoomOutButton.valign = "bottom";
    chart.zoomOutButton.marginLeft = 10;
    chart.zoomOutButton.marginBottom = 10;

    // Add scrollbar
    var scrollbar = new am4charts.XYChartScrollbar();
    //scrollbar.series.push(series)

    chart.scrollbarX = scrollbar;

var legendContainer = am4core.create("legenddiv", am4core.Container);
legendContainer.width = am4core.percent(100);
legendContainer.height = am4core.percent(100);
//chart.legend.parent = legendContainer;
    chart.legend = new am4charts.Legend();
  //  chart.legend.labels.template.text = "[bold {color}]{name}[/]";
       chart.legend.labels.template.text = "[bold {color}]{name}[/]";
chart.legend.itemContainers.template.tooltipText = "[bold {color}]{name}[/]";
    chart.legend.labels.template.maxWidth = 350;
    chart.legend.labels.template.truncate = true;
chart.legend.fontSize = 11;
    chart.legend.scrollable = true
chart.legend.labels.template.wrap = false;

/*chart.legend.itemContainers.template.events.on("over", function(ev) {
  var series = ev.target.dataItem.dataContext;
  series.bulletsContainer.show();
});

chart.legend.itemContainers.template.events.on("out", function(ev) {
  var series = ev.target.dataItem.dataContext;
  series.bulletsContainer.hide();
});
*/
    chart.leftAxesContainer.layout = "vertical";

    chart.exporting.menu = new am4core.ExportMenu();
    chart.exporting.menu.align = "left";
    chart.exporting.menu.verticalAlign = "top";

    var watermark = chart.createChild(am4core.Label);
    watermark.text = "Source: [bold] kredensial.com [/]";
    watermark.align = "left";
    watermark.fillOpacity = 0.5;
    watermark.disabled = true;

    chart.exporting.events.on("exportstarted", function(ev) {
      watermark.disabled = true;
    });

    chart.exporting.events.on("exportfinished", function(ev) {
      watermark.disabled = true;
    });

    chart.exporting.validateSprites.push(watermark);

    var title = chart.titles.create();
    title.text = "<?php echo $judul_laporan_tabel; ?>";
    title.fontSize = 18;
    title.tooltipText = "<?php echo $judul_laporan_tabel; ?>";

    }); 
<?php  
}
	if($tabel == 7){
?>
am4core.ready(function() {
am4core.useTheme(am4themes_animated);
var chart = am4core.create("chartdiv", am4charts.XYChart);

    chart.data = [
    <?php
    foreach($grafik_garis_opsi as $rowgrafik_garis_opsi){
    ?>
    {
      "year": <?php echo '"'.$rowgrafik_garis_opsi['tgl_lhu'].'"'; ?>,
      <?php
      $no = 0;

    if($lhu == 1){ // 1kompetensi-2bakhp-3reject-4lhu
    	$jsonx = $this->m_member->grafik_garis_hasil_logbook($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_lhu'],$kewenangan,$share_it,$idpeg);
    }
    if($lhu == 2){
    	$jsonx = $this->m_member->grafik_garis_hasil_pasien($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_lhu'],'id_bahan','jml_bahan');
    }
    if($lhu == 3){
    	$jsonx = $this->m_member->grafik_garis_hasil_pasien($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_lhu'],'id_reject','jml_reject');
    }
    if($lhu == 4){
  	    $jsonx = $this->m_member->grafik_garis_hasil_lhu($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_lhu'],$select_jscode,$id);
    }
      foreach($jsonx as $row2){
          $no++;
      ?>
      <?php echo '"'.$row2['id_lhu'].'"'; ?>:<?php echo round($row2['hasil_lhu_detil'],2); ?>
      <?php
      }
      ?>
    },
    <?php
    }
    ?>
    ];

/*            chart.responsive.enabled = true;
            chart.maskBullets = false;
            chart.dateFormatter.dateFormat = "dd-MM-yyyy";*/

// Create category axis
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "year";
categoryAxis.renderer.opposite = true;
//categoryAxis.fontSize = 10;

/*categoryAxis.tooltip.getFillFromObject = false; 
categoryAxis.tooltip.label.fill = "#ff0000"
categoryAxis.tooltip.label.fontFamily = "Courier New"
categoryAxis.tooltip.label.fontSize = 7;*/

// Create value axis
var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.inversed = false;
valueAxis.title.text = "Nilai";
valueAxis.renderer.minLabelPosition = 0.01;
  valueAxis.min = <?= $min_laporan_tabel ?>;
  valueAxis.max = <?= $max_laporan_tabel ?>;
//valueAxis.fontSize = 10;;
       // valueAxis.min = ?php echo $min_standar; ?>;
        // valueAxis.max = ?php echo $max_standar; ?>;


/*            var categoryAxis = chart.xAxes.push(new am4charts.DateAxis());
            categoryAxis.renderer.grid.template.location = 0;
            categoryAxis.renderer.minGridDistance = 30;

            var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
            dateAxis.renderer.minGridDistance = 30;
            dateAxis.periodChangeDateFormats.setKey("month", "[bold]yyyy");*/
/*valueAxis.min = 0;
valueAxis.max = 1000;*/

let range0 = valueAxis.axisRanges.create();
range0.value = <?= round($min_laporan_tabel,2) ?>;
range0.label.text = "Batas Min = <?= round($min_laporan_tabel,2) ?>";;
range0.grid.stroke = am4core.color("#ff0000");
range0.grid.strokeWidth = 2;
range0.grid.strokeOpacity = 1;
range0.label.inside = true;
range0.label.fill = range0.grid.stroke;
range0.label.verticalCenter = "bottom";

let range500 = valueAxis.axisRanges.create();
range500.value = <?= round($max_laporan_tabel,2) ?>;
range500.label.text = "Batas Max = <?= round($max_laporan_tabel,2) ?>";;
range500.grid.stroke = am4core.color("#ff0000");
range500.grid.strokeWidth = 2;
range500.grid.strokeOpacity = 1;
range500.label.inside = true;
range500.label.fill = range500.grid.stroke;
range500.label.verticalCenter = "bottom";

<?php
foreach($ambil_limbah_grafik as $row1x){
//  $jsonxx = $this->m_umum->ambil_data('dsr_kredensial','id_dsr_kredensial',$nox);
?>
// Create series
var series<?php echo $row1x['id_lhu']; ?> = chart.series.push(new am4charts.LineSeries());
series<?php echo $row1x['id_lhu']; ?>.dataFields.valueY = <?php echo '"'.$row1x['id_lhu'].'"'; ?>;
series<?php echo $row1x['id_lhu']; ?>.dataFields.categoryX = "year";
series<?php echo $row1x['id_lhu']; ?>.name = <?php echo '"'.$row1x['nama_lhu'].'"'; ?>;
series<?php echo $row1x['id_lhu']; ?>.bullets.push(new am4charts.CircleBullet());
//series<?php echo $row1x['id_lhu']; ?>.tooltipText = "{valueY}";
//series<?php echo $row1x['id_lhu']; ?>.legendSettings.valueText = "[bold {color}]{name}:{valueY}[/]";
series<?php echo $row1x['id_lhu']; ?>.visible  = false;

let hs<?php echo $row1x['id_lhu']; ?> = series<?php echo $row1x['id_lhu']; ?>.segments.template.states.create("hover")
hs<?php echo $row1x['id_lhu']; ?>.properties.strokeWidth = 5;
series<?php echo $row1x['id_lhu']; ?>.segments.template.strokeWidth = 1;

var circleBullet<?php echo $row1x['id_lhu']; ?> = series<?php echo $row1x['id_lhu']; ?>.bullets.push(new am4charts.CircleBullet());
circleBullet<?php echo $row1x['id_lhu']; ?>.circle.stroke = am4core.color("#fff");
circleBullet<?php echo $row1x['id_lhu']; ?>.circle.strokeWidth = 2;

var labelBullet<?php echo $row1x['id_lhu']; ?> = series<?php echo $row1x['id_lhu']; ?>.bullets.push(new am4charts.LabelBullet());
labelBullet<?php echo $row1x['id_lhu']; ?>.label.text = "[bold {color}]{valueY}[/]";
labelBullet<?php echo $row1x['id_lhu']; ?>.label.dy = -20;
labelBullet<?php echo $row1x['id_lhu']; ?>.fontSize = 11;

<?php
}
?>

    chart.cursor = new am4charts.XYCursor();
    chart.cursor.lineX.strokeOpacity = 0;
    chart.cursor.lineY.strokeOpacity = 0;

    chart.zoomOutButton.align = "left";
    chart.zoomOutButton.valign = "bottom";
    chart.zoomOutButton.marginLeft = 10;
    chart.zoomOutButton.marginBottom = 10;

    var scrollbar = new am4charts.XYChartScrollbar();

    chart.scrollbarX = scrollbar;
    chart.legend = new am4charts.Legend();
    chart.legend.labels.template.text = "[bold {color}]{name}[/]";

    chart.legend.scrollable = true
    //    chart.leftAxesContainer.layout = "vertical";
    //    chart.rightAxesContainer.layout = "vertical"; 

/*var legendContainer = am4core.create("legenddiv", am4core.Container);
legendContainer.width = am4core.percent(100);
legendContainer.height = am4core.percent(100);
chart.legend.parent = legendContainer;*/
  //  chart.legend = new am4charts.Legend();
  //  chart.legend.labels.template.text = "[bold {color}]{name}[/]";
       chart.legend.labels.template.text = "[bold {color}]{name} : {value} [/]";
    chart.legend.labels.template.maxWidth = 350;
    chart.legend.labels.template.truncate = true;
chart.legend.fontSize = 11;
    chart.legend.scrollable = true
    chart.leftAxesContainer.layout = "vertical";

    chart.exporting.menu = new am4core.ExportMenu();
    chart.exporting.menu.align = "left";
    chart.exporting.menu.verticalAlign = "top";

    var watermark = chart.createChild(am4core.Label);
    watermark.text = "Source: [bold] kredensial.com [/]";
    watermark.align = "left";
    watermark.fillOpacity = 0.5;
    watermark.disabled = true;

    // Enable watermark on export
    chart.exporting.events.on("exportstarted", function(ev) {
      watermark.disabled = true;
    });

    // Disable watermark when export finishes
    chart.exporting.events.on("exportfinished", function(ev) {
      watermark.disabled = true;
    });

    // Add watermark to validated sprites
    chart.exporting.validateSprites.push(watermark);

    var title = chart.titles.create();
    title.text = "<?php echo $judul_laporan_tabel; ?>";
    title.fontSize = 18;
    title.tooltipText = "<?php echo $judul_laporan_tabel; ?>";

}); // end am4core.ready()
<?php
	}
 if($tabel == 6){
?>
    am4core.ready(function() {
    am4core.useTheme(am4themes_animated);
    var chart = am4core.create("chartdiv", am4charts.XYChart);

    chart.data = [
    <?php
    foreach($grafik_garis_opsi as $rowgrafik_garis_opsi){
    ?>
    {
      "year": <?php echo '"'.$rowgrafik_garis_opsi['tgl_lhu'].'"'; ?>,
      <?php
      $no = 0;

    if($lhu == 1){ // 1kompetensi-2bakhp-3reject-4lhu
    	$jsonx = $this->m_member->grafik_garis_hasil_logbook($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_lhu'],$kewenangan,$share_it,$idpeg);
    }
    if($lhu == 2){
    	$jsonx = $this->m_member->grafik_garis_hasil_pasien($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_lhu'],'id_bahan','jml_bahan');
    }
    if($lhu == 3){
    	$jsonx = $this->m_member->grafik_garis_hasil_pasien($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_lhu'],'id_reject','jml_reject');
    }
    if($lhu == 4){
  	    $jsonx = $this->m_member->grafik_garis_hasil_lhu($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_lhu'],$select_jscode,$id);
    }
      foreach($jsonx as $row2){
          $no++;
      ?>
      <?php echo '"'.$row2['id_lhu'].'"'; ?>:<?php echo round($row2['hasil_lhu_detil'],2); ?>
      <?php
      }
      ?>
    },
    <?php
    }
    ?>
    ];

    chart.maskBullets = false;
    chart.dateFormatter.dateFormat = "dd-MM-yyyy";

// Create axes
var categoryAxis = chart.xAxes.push(new am4charts.DateAxis());
//var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 30;

var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
dateAxis.renderer.minGridDistance = 30;

// Set date label formatting
dateAxis.periodChangeDateFormats.setKey("month", "[bold]yyyy");
// Create series
function createSeriesAndAxis(field, name, topMargin, bottomMargin, mutu, renge) {
    // Create value axis
    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.renderer.minLabelPosition = 0.01;
       // valueAxis.min = ?php echo $min_standar; ?>;
        // valueAxis.max = ?php echo $max_standar; ?>;
  
  var series = chart.series.push(new am4charts.LineSeries());
  series.dataFields.valueY = field;
  series.dataFields.dateX = "year";
//  series.dataFields.categoryX = "year";
  series.name = name;
//  series.tooltipText = "{dateX}: [b]{valueY}[/]";
  series.strokeWidth = 2;
  series.yAxis = valueAxis;
//  series.legendSettings.valueText = "{valueY}";

//  series.visible  = false;

  let hs = series.segments.template.states.create("hover")
  hs.properties.strokeWidth = 5;
  series.segments.template.strokeWidth = 1;

  // Add simple bullet
  var circleBullet = series.bullets.push(new am4charts.CircleBullet());
  circleBullet.circle.stroke = am4core.color("#fff");
  circleBullet.circle.strokeWidth = 2;
 // circleBullet.tooltipText = "[bold]{name} : {valueY}[/]";

  var labelBullet = series.bullets.push(new am4charts.LabelBullet());
  labelBullet.label.text = "[bold]{valueY}[/]";
  labelBullet.label.dy = -20;
  labelBullet.fontSize = 11;

			//	labelBullet.tooltip.label.wrap = true;
			//	labelBullet.tooltip.label.width = 300;
  
  valueAxis.renderer.line.strokeOpacity = 1;
  valueAxis.renderer.line.stroke = series.stroke;
  valueAxis.renderer.grid.template.stroke = series.stroke;
  valueAxis.renderer.grid.template.strokeOpacity = 0.1;
  valueAxis.renderer.labels.template.fill = series.stroke;
  valueAxis.renderer.minGridDistance = 25;
  valueAxis.align = "right";
  
  if (topMargin && bottomMargin) {
    valueAxis.marginTop = 10;
    valueAxis.marginBottom = 10;
  }
  else {
    if (topMargin) {
      valueAxis.marginTop = 20;
    }
    if (bottomMargin) {
      valueAxis.marginBottom = 20;
    }
  }
  
    var bullet = series.bullets.push(new am4charts.CircleBullet());
    bullet.circle.stroke = am4core.color("#fff");
    bullet.circle.strokeWidth = 2;
    bullet.adapter.add("dy", function(dy, target) {
      hideBullet(target);
      return dy;
    })

    function hideBullet(bullet) {
      if (bullet.pixelX < 0 || bullet.pixelX > chart.plotContainer.measuredWidth || bullet.pixelY < 0 || bullet.pixelY > chart.plotContainer.measuredHeight) {
        bullet.visible = false;
      }
      else {
        bullet.visible = true;
      }
    }

    var rangest = valueAxis.axisRanges.create();
    rangest.value = mutu;
    rangest.label.text = "Batas Min = <?= $min_laporan_tabel ?>";
    rangest.grid.stroke = am4core.color("#ff0000");
    rangest.grid.strokeWidth = 2;
    rangest.grid.strokeOpacity = 1;
//    rangest.label.location = 0.4;
    rangest.label.inside = true;
    rangest.label.fill = rangest.grid.stroke;
    //rangest.label.align = "right";
    rangest.label.verticalCenter = "bottom";
    //rangest.label.dy = -20;

    var rangerg = valueAxis.axisRanges.create();
    rangerg.value = renge;
    rangerg.label.text = "Batas Max = <?= $max_laporan_tabel ?>"; 
    rangerg.grid.stroke = am4core.color("#ff0000");
    rangerg.grid.strokeWidth = 2;
    rangerg.grid.strokeOpacity = 1;
//    rangerg.label.location = 0.4;
    rangerg.label.inside = true;
    rangerg.label.fill = rangerg.grid.stroke;
    //rangerg.label.align = "right";
    rangerg.label.verticalCenter = "bottom";
    //rangerg.label.dy = -20;
}

    <?php
    foreach($ambil_limbah_grafik as $rowambil_limbah_grafik){
    ?>
    createSeriesAndAxis(<?php echo '"'.$rowambil_limbah_grafik['id_lhu'].'"'; ?>, <?php echo '"'.$rowambil_limbah_grafik['nama_lhu'].'"'; ?>, true, true, <?= round($min_laporan_tabel,2) ?>, <?= round($max_laporan_tabel,2) ?>);
    <?php
    }
    ?>

    // createSeriesAndAxis("value", "Series #1", false, true);
    chart.cursor = new am4charts.XYCursor();
    chart.cursor.lineX.strokeOpacity = 0;
    chart.cursor.lineY.strokeOpacity = 0;

    chart.zoomOutButton.align = "left";
    chart.zoomOutButton.valign = "bottom";
    chart.zoomOutButton.marginLeft = 10;
    chart.zoomOutButton.marginBottom = 10;

    // Add scrollbar
    var scrollbar = new am4charts.XYChartScrollbar();
    //scrollbar.series.push(series)

    chart.scrollbarX = scrollbar;

var legendContainer = am4core.create("legenddiv", am4core.Container);
legendContainer.width = am4core.percent(100);
legendContainer.height = am4core.percent(100);
//chart.legend.parent = legendContainer;
    chart.legend = new am4charts.Legend();
  //  chart.legend.labels.template.text = "[bold {color}]{name}[/]";
       chart.legend.labels.template.text = "[bold {color}]{name} : {value} [/]";
    chart.legend.labels.template.maxWidth = 350;
    chart.legend.labels.template.truncate = true;
chart.legend.fontSize = 11;
    chart.legend.scrollable = true
    chart.leftAxesContainer.layout = "vertical";

    chart.exporting.menu = new am4core.ExportMenu();
    chart.exporting.menu.align = "left";
    chart.exporting.menu.verticalAlign = "top";

    var watermark = chart.createChild(am4core.Label);
    watermark.text = "Source: [bold] kredensial.com [/]";
    watermark.align = "left";
    watermark.fillOpacity = 0.5;
    watermark.disabled = true;

    chart.exporting.events.on("exportstarted", function(ev) {
      watermark.disabled = true;
    });

    chart.exporting.events.on("exportfinished", function(ev) {
      watermark.disabled = true;
    });

    chart.exporting.validateSprites.push(watermark);

    var title = chart.titles.create();
    title.text = "<?php echo $judul_laporan_tabel; ?>";
    title.fontSize = 18;
    title.tooltipText = "<?php echo $judul_laporan_tabel; ?>";

    }); 
<?php  
}
}
else if($page=='lt')
{
?>
$(function(){
	$('.select2').select2()
});

am4core.ready(function() {
am4core.useTheme(am4themes_animated);
var chart = am4core.create("chartdiv", am4charts.XYChart);
chart.data = [
<?php
foreach($json as $row1){
?>
{
  "year": <?php echo '"'.$row1['tgl_logbook'].'"'; ?>,
  <?php
  $no = 0;
  $jsonx = $this->m_member->lt2($row1['tgl_logbook'],$this->session->id_pegawai);
  foreach($jsonx as $row2){
	  $no++;
  ?>
  <?php echo '"'.$row2['id_kompetensi'].'"'; ?>:<?php echo $row2['jml_logbook']; ?>,
  <?php
  }
  ?>
},
<?php
}
?>
];

// Create category axis
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "year";
categoryAxis.renderer.opposite = true;

// Create value axis
var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.inversed = false;
valueAxis.title.text = "Nilai";
valueAxis.renderer.minLabelPosition = 0.01;

<?php
foreach($ambil_kol_golongan_pemeriksaan_graph as $row1x){
//  $jsonxx = $this->m_umum->ambil_data('dsr_kredensial','id_dsr_kredensial',$nox);
?>
// Create series
var series<?php echo $row1x['id_kompetensi']; ?> = chart.series.push(new am4charts.LineSeries());
series<?php echo $row1x['id_kompetensi']; ?>.dataFields.valueY = <?php echo '"'.$row1x['id_kompetensi'].'"'; ?>;
series<?php echo $row1x['id_kompetensi']; ?>.dataFields.categoryX = "year";
series<?php echo $row1x['id_kompetensi']; ?>.name = <?php echo '"'.$row1x['nama_kompetensi'].'"'; ?>;
series<?php echo $row1x['id_kompetensi']; ?>.bullets.push(new am4charts.CircleBullet());
series<?php echo $row1x['id_kompetensi']; ?>.tooltipText = "{name} Thn {categoryX}: {valueY}";
series<?php echo $row1x['id_kompetensi']; ?>.legendSettings.valueText = "{valueY}";
series<?php echo $row1x['id_kompetensi']; ?>.visible  = false;

let hs<?php echo $row1x['id_kompetensi']; ?> = series<?php echo $row1x['id_kompetensi']; ?>.segments.template.states.create("hover")
hs<?php echo $row1x['id_kompetensi']; ?>.properties.strokeWidth = 5;
series<?php echo $row1x['id_kompetensi']; ?>.segments.template.strokeWidth = 1;

var circleBullet<?php echo $row1x['id_kompetensi']; ?> = series<?php echo $row1x['id_kompetensi']; ?>.bullets.push(new am4charts.CircleBullet());
circleBullet<?php echo $row1x['id_kompetensi']; ?>.circle.stroke = am4core.color("#fff");
circleBullet<?php echo $row1x['id_kompetensi']; ?>.circle.strokeWidth = 2;

var labelBullet<?php echo $row1x['id_kompetensi']; ?> = series<?php echo $row1x['id_kompetensi']; ?>.bullets.push(new am4charts.LabelBullet());
labelBullet<?php echo $row1x['id_kompetensi']; ?>.label.text = "{valueY}";
labelBullet<?php echo $row1x['id_kompetensi']; ?>.label.dy = -20;

<?php
}
?>

    chart.cursor = new am4charts.XYCursor();
    chart.cursor.lineX.strokeOpacity = 0;
    chart.cursor.lineY.strokeOpacity = 0;

    chart.zoomOutButton.align = "left";
    chart.zoomOutButton.valign = "bottom";
    chart.zoomOutButton.marginLeft = 10;
    chart.zoomOutButton.marginBottom = 10;

    var scrollbar = new am4charts.XYChartScrollbar();

    chart.scrollbarX = scrollbar;
    chart.legend = new am4charts.Legend();
    chart.legend.labels.template.text = "[bold {color}]{name}[/]";

    chart.legend.scrollable = true
        chart.leftAxesContainer.layout = "vertical";

var legendContainer = am4core.create("legenddiv", am4core.Container);
legendContainer.width = am4core.percent(100);
legendContainer.height = am4core.percent(100);
chart.legend.parent = legendContainer;
chart.responsive.enabled = true;

    chart.exporting.menu = new am4core.ExportMenu();
    chart.exporting.menu.align = "left";
    chart.exporting.menu.verticalAlign = "top";

    var watermark = chart.createChild(am4core.Label);
    watermark.text = "Source: [bold] kredensial.com [/]";
    watermark.align = "left";
    watermark.fillOpacity = 0.5;
    watermark.disabled = true;

    // Enable watermark on export
    chart.exporting.events.on("exportstarted", function(ev) {
      watermark.disabled = true;
    });

    // Disable watermark when export finishes
    chart.exporting.events.on("exportfinished", function(ev) {
      watermark.disabled = true;
    });

    // Add watermark to validated sprites
    chart.exporting.validateSprites.push(watermark);

    var title = chart.titles.create();
    title.text = "GRAFIK KEGIATAN LOGBOOK";
    title.fontSize = 18;
    title.tooltipText = "GRAFIK KEGIATAN LOGBOOK";

}); // end am4core.ready()
<?php
}
else if($page=='lb')
{
?>
$(function(){
	$('.select2').select2()
});

am4core.ready(function() {
am4core.useTheme(am4themes_animated);
var chart = am4core.create("chartdiv", am4charts.XYChart);
chart.data = [
<?php
foreach($json as $row1){
?>
{
  "year": <?php echo '"'.$row1['tgl_logbooke'].'"'; ?>,
  <?php
  $no = 0;
  $jsonx = $this->m_member->lb2($row1['tgl_logbook'],$this->session->id_pegawai);
  foreach($jsonx as $row2){
	  $no++;
  ?>
  <?php echo '"'.$row2['id_kompetensi'].'"'; ?>:<?php echo $row2['jml_logbook']; ?>,
  <?php
  }
  ?>
},
<?php
}
?>
];

// Create category axis
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "year";
categoryAxis.renderer.opposite = true;

// Create value axis
var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.inversed = false;
valueAxis.title.text = "Nilai";
valueAxis.renderer.minLabelPosition = 0.01;

<?php
foreach($ambil_kol_golongan_pemeriksaan_graph as $row1x){
//  $jsonxx = $this->m_umum->ambil_data('dsr_kredensial','id_dsr_kredensial',$nox);
?>
// Create series
var series<?php echo $row1x['id_kompetensi']; ?> = chart.series.push(new am4charts.LineSeries());
series<?php echo $row1x['id_kompetensi']; ?>.dataFields.valueY = <?php echo '"'.$row1x['id_kompetensi'].'"'; ?>;
series<?php echo $row1x['id_kompetensi']; ?>.dataFields.categoryX = "year";
series<?php echo $row1x['id_kompetensi']; ?>.name = <?php echo '"'.$row1x['nama_kompetensi'].'"'; ?>;
series<?php echo $row1x['id_kompetensi']; ?>.bullets.push(new am4charts.CircleBullet());
series<?php echo $row1x['id_kompetensi']; ?>.tooltipText = "{name} : {valueY}";
series<?php echo $row1x['id_kompetensi']; ?>.legendSettings.valueText = "{valueY}";
series<?php echo $row1x['id_kompetensi']; ?>.visible  = false;

let hs<?php echo $row1x['id_kompetensi']; ?> = series<?php echo $row1x['id_kompetensi']; ?>.segments.template.states.create("hover")
hs<?php echo $row1x['id_kompetensi']; ?>.properties.strokeWidth = 5;
series<?php echo $row1x['id_kompetensi']; ?>.segments.template.strokeWidth = 1;

var circleBullet<?php echo $row1x['id_kompetensi']; ?> = series<?php echo $row1x['id_kompetensi']; ?>.bullets.push(new am4charts.CircleBullet());
circleBullet<?php echo $row1x['id_kompetensi']; ?>.circle.stroke = am4core.color("#fff");
circleBullet<?php echo $row1x['id_kompetensi']; ?>.circle.strokeWidth = 2;

var labelBullet<?php echo $row1x['id_kompetensi']; ?> = series<?php echo $row1x['id_kompetensi']; ?>.bullets.push(new am4charts.LabelBullet());
labelBullet<?php echo $row1x['id_kompetensi']; ?>.label.text = "{valueY}";
labelBullet<?php echo $row1x['id_kompetensi']; ?>.label.dy = -20;

<?php
}
?>
    chart.cursor = new am4charts.XYCursor();
    chart.cursor.lineX.strokeOpacity = 0;
    chart.cursor.lineY.strokeOpacity = 0;

    chart.zoomOutButton.align = "left";
    chart.zoomOutButton.valign = "bottom";
    chart.zoomOutButton.marginLeft = 10;
    chart.zoomOutButton.marginBottom = 10;

    var scrollbar = new am4charts.XYChartScrollbar();

    chart.scrollbarX = scrollbar;
    chart.legend = new am4charts.Legend();
    chart.legend.labels.template.text = "[bold {color}]{name}[/]";

    chart.legend.scrollable = true
        chart.leftAxesContainer.layout = "vertical";

var legendContainer = am4core.create("legenddiv", am4core.Container);
legendContainer.width = am4core.percent(100);
legendContainer.height = am4core.percent(100);
chart.legend.parent = legendContainer;
chart.responsive.enabled = true;

    chart.exporting.menu = new am4core.ExportMenu();
    chart.exporting.menu.align = "left";
    chart.exporting.menu.verticalAlign = "top";

    var watermark = chart.createChild(am4core.Label);
    watermark.text = "Source: [bold] kredensial.com [/]";
    watermark.align = "left";
    watermark.fillOpacity = 0.5;
    watermark.disabled = true;

    // Enable watermark on export
    chart.exporting.events.on("exportstarted", function(ev) {
      watermark.disabled = true;
    });

    // Disable watermark when export finishes
    chart.exporting.events.on("exportfinished", function(ev) {
      watermark.disabled = true;
    });

    // Add watermark to validated sprites
    chart.exporting.validateSprites.push(watermark);

    var title = chart.titles.create();
    title.text = "GRAFIK KEGIATAN LOGBOOK";
    title.fontSize = 18;
    title.tooltipText = "GRAFIK KEGIATAN LOGBOOK";
}); // end am4core.ready()
<?php
}
else if($page=='lh')
{
?>

$(function(){
	$('.select2').select2()
});

am4core.ready(function() {
am4core.useTheme(am4themes_animated);
var chart = am4core.create("chartdiv", am4charts.XYChart);
chart.data = [
<?php
foreach($json as $row1){
?>
{
  "year": <?php echo '"'.$row1['tgl_logbook'].'"'; ?>,
  <?php
  $no = 0;
  $jsonx = $this->m_member->lh2($row1['tgl_logbook'],$this->session->id_pegawai);
  foreach($jsonx as $row2){
	  $no++;
  ?>
  <?php echo '"'.$row2['id_kompetensi'].'"'; ?>:<?php echo $row2['jml_logbook']; ?>,
  <?php
  }
  ?>
},
<?php
}
?>
];

// Create category axis
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "year";
categoryAxis.renderer.opposite = true;

// Create value axis
var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.inversed = false;
valueAxis.title.text = "Nilai";
valueAxis.renderer.minLabelPosition = 0.01;

<?php
foreach($ambil_kol_golongan_pemeriksaan_graph as $row1x){
//  $jsonxx = $this->m_umum->ambil_data('dsr_kredensial','id_dsr_kredensial',$nox);
?>
// Create series
var series<?php echo $row1x['id_kompetensi']; ?> = chart.series.push(new am4charts.LineSeries());
series<?php echo $row1x['id_kompetensi']; ?>.dataFields.valueY = <?php echo '"'.$row1x['id_kompetensi'].'"'; ?>;
series<?php echo $row1x['id_kompetensi']; ?>.dataFields.categoryX = "year";
series<?php echo $row1x['id_kompetensi']; ?>.name = <?php echo '"'.$row1x['nama_kompetensi'].'"'; ?>;
series<?php echo $row1x['id_kompetensi']; ?>.bullets.push(new am4charts.CircleBullet());
series<?php echo $row1x['id_kompetensi']; ?>.tooltipText = "{name} Tgl {categoryX} : {valueY}";
series<?php echo $row1x['id_kompetensi']; ?>.legendSettings.valueText = "{valueY}";
series<?php echo $row1x['id_kompetensi']; ?>.visible  = false;

let hs<?php echo $row1x['id_kompetensi']; ?> = series<?php echo $row1x['id_kompetensi']; ?>.segments.template.states.create("hover")
hs<?php echo $row1x['id_kompetensi']; ?>.properties.strokeWidth = 5;
series<?php echo $row1x['id_kompetensi']; ?>.segments.template.strokeWidth = 1;

var circleBullet<?php echo $row1x['id_kompetensi']; ?> = series<?php echo $row1x['id_kompetensi']; ?>.bullets.push(new am4charts.CircleBullet());
circleBullet<?php echo $row1x['id_kompetensi']; ?>.circle.stroke = am4core.color("#fff");
circleBullet<?php echo $row1x['id_kompetensi']; ?>.circle.strokeWidth = 2;

var labelBullet<?php echo $row1x['id_kompetensi']; ?> = series<?php echo $row1x['id_kompetensi']; ?>.bullets.push(new am4charts.LabelBullet());
labelBullet<?php echo $row1x['id_kompetensi']; ?>.label.text = "{valueY}";
labelBullet<?php echo $row1x['id_kompetensi']; ?>.label.dy = -20;

<?php
}
?>
    chart.cursor = new am4charts.XYCursor();
    chart.cursor.lineX.strokeOpacity = 0;
    chart.cursor.lineY.strokeOpacity = 0;

    chart.zoomOutButton.align = "left";
    chart.zoomOutButton.valign = "bottom";
    chart.zoomOutButton.marginLeft = 10;
    chart.zoomOutButton.marginBottom = 10;

    var scrollbar = new am4charts.XYChartScrollbar();

    chart.scrollbarX = scrollbar;
    chart.legend = new am4charts.Legend();
    chart.legend.labels.template.text = "[bold {color}]{name}[/]";

    chart.legend.scrollable = true
        chart.leftAxesContainer.layout = "vertical";

var legendContainer = am4core.create("legenddiv", am4core.Container);
legendContainer.width = am4core.percent(100);
legendContainer.height = am4core.percent(100);
chart.legend.parent = legendContainer;
chart.responsive.enabled = true;

    chart.exporting.menu = new am4core.ExportMenu();
    chart.exporting.menu.align = "left";
    chart.exporting.menu.verticalAlign = "top";

    var watermark = chart.createChild(am4core.Label);
    watermark.text = "Source: [bold] kredensial.com [/]";
    watermark.align = "left";
    watermark.fillOpacity = 0.5;
    watermark.disabled = true;

    // Enable watermark on export
    chart.exporting.events.on("exportstarted", function(ev) {
      watermark.disabled = true;
    });

    // Disable watermark when export finishes
    chart.exporting.events.on("exportfinished", function(ev) {
      watermark.disabled = true;
    });

    // Add watermark to validated sprites
    chart.exporting.validateSprites.push(watermark);

    var title = chart.titles.create();
    title.text = "GRAFIK KEGIATAN LOGBOOK";
    title.fontSize = 18;
    title.tooltipText = "GRAFIK KEGIATAN LOGBOOK";
}); // end am4core.ready()
<?php
}
elseif ($page=="clone_i_mutu")
{
?>
$('#id').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#id").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#id2').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#id2").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
    $(document).ready(function() {
        $('.select2').select2()
  $.fn.dataTable.moment( 'DD-MM-YYYY' );
  $.fn.dataTable.moment( 'HH:mm' );
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
            "url"  : "<?php echo base_url();?>member/<?php echo $page;?>/data/<?php echo $id;?>/<?php echo $id2;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "tgl_sort", "visible":false, "searchable":false, className:"text-center" },
                      { "data": "tgl_lhu", "searchable":false, "orderable":false, className:"text-center" },
                      { "data": "nama_lhu", "orderable":false, className:"text-center" },
                      { "data": "nama_pegawai", "orderable":false, className:"text-center" }
            ],
            "order": [[0, 'desc']] ,
            "columnDefs" : [{"targets":0, "type":"date-eu"}],
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
              {
                text: "<i class='fa fa-search'></i> Lihat Hasil QC",
                extend: "selected",
                className: "btnolive",
                  action: function ( e, dt, node, config ) { 
                          data = dt.rows( { selected: true } ).data()[0]['id_lhu'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/lihat/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
                 {
                     text: "<i class='fa fa-clone'></i> Copy Hasil QC",
                     extend: "selected",
                     className: "btnred",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_lhu']; 
                     swal({
                       title: "Yakin ?",
                       text: "Yakin akan mengclonning Hasil ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('member/'.$page.'/copy_user/'); ?>'+data; //[Modif Disini]
                       } 
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
elseif ($page=="time_respon")
{
?>
$('#id').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#id").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#id2').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#id2").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
    $(document).ready(function() {
        $('.select2').select2()
  $.fn.dataTable.moment( 'DD-MM-YYYY' );
  $.fn.dataTable.moment( 'HH:mm' );
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
            "url"  : "<?php echo base_url();?>member/<?php echo $page;?>/data/<?php echo $id;?>/<?php echo $id2;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "tgl_sort", "visible":false, "searchable":false, className:"text-center" },
                      { "data": "tgl_tr", "searchable":false, "orderable":false, className:"text-center" },
                      { "data": "nama_time_respon", "searchable":false, "orderable":false, className:"text-center" },
                      { "data": "waktu_tunggu", "searchable":false, "orderable":false, className:"text-center" },
                      { "data": "nama_kewenangan", "orderable":false, className:"text-center" }
            ],
            "order": [[0, 'desc']] ,
            "columnDefs" : [{"targets":0, "type":"date-eu"}],
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus-square'></i> Tambah Time Respon",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('member/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
              {
                text: "<i class='fa fa-pencil'></i> Rubah Time Respon",
                extend: "selected",
                className: "btnolive",
                  action: function ( e, dt, node, config ) { 
                          data = dt.rows( { selected: true } ).data()[0]['id_tr'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/edit/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
              {
                text: "<i class='fa fa-clone'></i> Clonning Hasil Time Respon",
                extend: "selected",
                className: "btnteal",
                  action: function ( e, dt, node, config ) { 
                          data = dt.rows( { selected: true } ).data()[0]['id_tr'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/copy_qc/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
                {
                    text: "<i class='fa fa-trash'></i> Hapus",
                    extend: "selected",
                    className: "btnred",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0];
                    swal({
                      title: "Yakin ?",
                      text: "Yakin akan menghapus?",     //[Modif Disini]
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
                    })
                    .then((willDelete) => {
                      if (willDelete) {
                        location.href = '<?php echo base_url('member/'.$page.'/hapus/'); ?>'+data['id_tr']+'/'+data['barcode_pegawai']; //[Modif Disini]
                      }
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
elseif ($page=="i_mutu")
{
?>
$('#id').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#id").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#id2').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#id2").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
    $(document).ready(function() {
        $('.select2').select2()
  $.fn.dataTable.moment( 'DD-MM-YYYY' );
  $.fn.dataTable.moment( 'HH:mm' );
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
			"url"  : "<?php echo base_url();?>member/<?php echo $page;?>/data/<?php echo $id;?>/<?php echo $id2;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "tgl_sort", "visible":false, "searchable":false, className:"text-center" },
                      { "data": "tgl_lhu", "searchable":false, "orderable":false, className:"text-center" },
                      { "data": "nama_lhu", "orderable":false, className:"text-center" }
            ],
            "order": [[0, 'desc']] ,
            "columnDefs" : [{"targets":0, "type":"date-eu"}],
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
				{
				    text: "<i class='fa fa-plus-square'></i> Tambah QC",
				    className: "btnmaroon",
				    init: function(api, node, config) {
				        $(node).removeClass('btn-default')
				    },
				    action: function ( e, dt, node, config ) {
				        $("#modal-default").modal();
				          $('.modal-body').load('<?php echo base_url('member/'.$page.'/tambah'); ?>',function(){
				            $('#modal-default').modal({show:true});
				          });
				    }
				},
              {
                text: "<i class='fa fa-pencil'></i> Rubah QC",
                extend: "selected",
                className: "btnolive",
                  action: function ( e, dt, node, config ) { 
                          data = dt.rows( { selected: true } ).data()[0]['id_lhu'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/edit/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
                {
                    text: "<i class='fa fa-pencil'></i>&nbsp;<i class='fa fa-plus-square'></i> Sesuaikan QC Detil",
                    extend: "selected",
                    className: "btnlime",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_lhu'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('member/mutu_detil/view/'); ?>'+data;
                    }
                },
                 {
                     text: "<i class='fa fa-clone'></i> Clonning Hasil QC",
                     extend: "selected",
                     className: "btnred",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_lhu']; 
                     swal({
                       title: "Yakin ?",
                       text: "Yakin akan mengclonning Hasil ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('member/'.$page.'/copy_qc/'); ?>'+data; //[Modif Disini]
                       } 
                     });
                    }
                 },
/*                 {
                    text: "<i class='fa fa-clone'></i> &nbsp; / &nbsp;<i class='fa fa-user-plus'></i> Clonning dari user lain",
                    className: "btnblue",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<php echo base_url('member/clone_i_mutu'); ?>';
                    }
                },*/
                {
                    text: "<i class='fa fa-trash'></i> Hapus",
                    extend: "selected",
                    className: "btnred",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0];
                    swal({
                      title: "Yakin ?",
                      text: "Yakin akan menghapus = "+data['nama_lhu'],     //[Modif Disini]
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
                    })
                    .then((willDelete) => {
                      if (willDelete) {
                        location.href = '<?php echo base_url('member/'.$page.'/hapus/'); ?>'+data['id_lhu']+'/'+data['barcode_pegawai']; //[Modif Disini]
                      }
                    });
                   }
                },
/*              {
                text: "<i class='fa fa-recycle'></i> Share QC Ke User Lain?",
                extend: "selected",
                className: "btnorange",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_lhu'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<php echo base_url('member/'.$page.'/share_user/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
                            {
                text: "<i class='fa fa-recycle'></i> Share QC Ke Ruangan / Unit Lain?",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_lhu'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<php echo base_url('member/'.$page.'/share_unit/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
              {
                text: "<i class='fa fa-recycle'></i> Share QC Ke Instansi Lain?",
                extend: "selected",
                className: "btnorange",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_lhu'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<php echo base_url('member/'.$page.'/share_instansi/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },*/
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
elseif ($page=="mutu_detil")
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
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
			"url"  : "<?php echo base_url();?>member/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "nama_equipment", "visible":false },
                      { "data": "nama_item_lhu", "orderable":false, className:"text-center" },
                      { "data": "hasil_lhu_detil", "orderable":false, className:"text-center" },
                      { "data": "ket_lhu_detil", "orderable":false, className:"text-center" },
                      { "data": "nama_pegawai", "orderable":false, className:"text-center" }
            ],
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
				{
				    text: "<i class='fa fa-plus-square'></i> Tambah Mutu Detil",
				    className: "btnmaroon",
				    init: function(api, node, config) {
				        $(node).removeClass('btn-default')
				    },
				    action: function ( e, dt, node, config ) {
				        $("#modal-default").modal();
				          $('.modal-body').load('<?php echo base_url('member/'.$page.'/tambah/'); ?><?php echo $id;?>',function(){
				            $('#modal-default').modal({show:true});
				          });
				    }
				},
              {
                text: "<i class='fa fa-pencil'></i> Rubah Mutu Detil",
                extend: "selected",
                className: "btnolive",
                  action: function ( e, dt, node, config ) { 
                          data = dt.rows( { selected: true } ).data()[0]['id_lhu_detil'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/edit/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
                {
                     text: "<i class='fa fa-close'></i> Hapus",
                     extend: "selected",
                     className: "btnred",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_lhu_detil'];
                     swal({
                       title: "HAPUS DATA ?",
                       // text: "Yakin akan menghapus = "+data['nama_item_lhu'],
                       text: "Yakin Hapus Data ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('member/'.$page.'/hapus/'); ?>'+data; //[Modif Disini]
                       }
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
elseif ($page=="i_mutu_copy_qc" || $page=="clone_i_mutu_copy_user")
{
?>
$('#tgl_lhu').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_lhu").inputmask("datetime", {
	mask: "1-2-y",
	placeholder: "dd-mm-yyyy",
	leapday: "-02-29",
	separator: "-",
	alias: "dd/mm/yyyy"
});
<?php  
}
elseif ($page=="item_mutu")
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
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
			"url"  : "<?php echo base_url();?>member/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_item_lhu", "visible":false },
                      { "data": "nama_item_lhu", "orderable":false, className:"text-center" },
                      { "data": "nama_equipment", "orderable":false, className:"text-center" },
					  { "data": "status_item_lhu", "searchable":false, className:"text-center",
						"render": function(data, type, row){
							if (row.status_item_lhu === '0') {
							   return '<button class="btn btn-xs btn-danger"> NON AKTIF</button>';
						  	 } else {
							    return '<button class="btn btn-xs btn-success"> AKTIF</button>';
						   	 } 
						 }
					   },
            ],
            "order": [[0, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
				{
				    text: "<i class='fa fa-plus-square'></i> Tambah Item Mutu",
				    className: "btnmaroon",
				    init: function(api, node, config) {
				        $(node).removeClass('btn-default')
				    },
				    action: function ( e, dt, node, config ) {
				        $("#modal-default").modal();
				          $('.modal-body').load('<?php echo base_url('member/'.$page.'/tambah'); ?>',function(){
				            $('#modal-default').modal({show:true});
				          });
				    }
				},
              {
                text: "<i class='fa fa-pencil'></i> Rubah Item Mutu",
                extend: "selected",
                className: "btnolive",
                  action: function ( e, dt, node, config ) { 
                          data = dt.rows( { selected: true } ).data()[0]['id_item_lhu'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/edit/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
                {
                     text: "<i class='fa fa-close'></i> Hapus",
                     extend: "selected",
                     className: "btnred",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_item_lhu'];
                     swal({
                       title: "HAPUS DATA ?",
                       // text: "Yakin akan menghapus = "+data['nama_item_lhu'],
                       text: "Yakin Hapus Data ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('member/'.$page.'/hapus/'); ?>'+data; //[Modif Disini]
                       }
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
elseif ($page=="even")
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
      '<tr> <td>Pembuat:</td><td>'+d.nama_pegawai+'</td> <td></td><td>Alamat:</td><td>'+d.alamat+'</td> </tr>'+
      '</table>';
  }
    $(document).ready(function() {
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
                "url"  : "<?php echo base_url();?>member/<?php echo $page;?>/data",
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
  { "data": "tgl_sort","searchable":false,"visible":false },
  { "data": "tgl_even","searchable":false, "orderable":false },
  { "data": "nama_even" },
  { "data": "alamat_even","searchable":false, "orderable":false },                 
  { "data": "include_radius","searchable":false, "orderable":false },                  
  { "data": "status_even","searchable":false, "orderable":false }                
            ],
            "order": [[1, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-search'></i> Lihat Acara",
                    extend: "selected",
                    className: "btnorange",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_even'];                       
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('member/'.$page.'/detil/'); ?>'+data;
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
        $(".btnReload").removeClass("dt-button").addClass("btn btn-success btn-sm");
        // Add event listener for opening and closing details
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
elseif ($page=="acara")
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
      '<tr> <td>Tanggal Even:</td><td>'+d.tgl_even+'</td> <td></td><td>Nama Even:</td><td>'+d.nama_even+'</td> </tr>'+
      '<tr> <td>Pembuat:</td><td>'+d.nama_pegawai+'</td> <td></td><td>Alamat:</td><td>'+d.alamat+'</td> </tr>'+
      '<tr> <td>Alamat:</td><td>'+d.alamat_event+'</td> <td></td><td>Status:</td><td>'+d.status_even+'</td> </tr>'+
      '<tr> <td>Radius:</td><td>'+d.include_radius+'</td> <td></td><td>Pembuat:</td><td>'+d.nama_pegawai+'</td> </tr>'+
      '<tr> <td>Hasil:</td><td>'+d.hasil_even_detil+'</td> <td></td><td>Kesimpulan:</td><td>'+d.kesimpulan_even_detil+'</td> </tr>'+
      '</table>';
  }
    $(document).ready(function() {
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
                "url"  : "<?php echo base_url();?>member/<?php echo $page;?>/data",
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
  { "data": "tgl_sort","searchable":false,"visible":false },
  { "data": "tgl_even_detil","searchable":false, "orderable":false },
  { "data": "nama_even_detil" },
  { "data": "speaker_even_detil","searchable":false, "orderable":false }                
            ],
            "order": [[1, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                  text: "<i class='fa fa-clock-o'></i> Absen",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_even_detil'];
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('member/'.$page.'/absen/'); ?>'+data,function(){
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
        $(".btnReload").removeClass("dt-button").addClass("btn btn-success btn-sm");
        // Add event listener for opening and closing details
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
//============================================ IM / QC
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
        $('.select2').select2()
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
                "url"  : "<?php echo base_url();?>member/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "coun_per_imqc", "searchable":false , "visible":false },
                      { "data": "nama_per_imqc" },
                      { "data": "nama_unit" },
                      { "data": "status_per_imqc", "searchable":false,
                            "render": function(data, type, row){
                                if (row.status_equipment === '0') {
                                   return '<button class="btn btn-xs btn-danger">NON AKTIF</button>';
                               } else {
                                   return '<button class="btn btn-xs btn-success">AKTIF</button>';
                               }
                            }
                       }
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
                          $('.modal-body').load('<?php echo base_url('member/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
              {
                text: "<i class='fa fa-edit'></i> Rubah",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_per_imqc'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/edit/'); ?>'+data,function(){
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
elseif ($page=="mutu")
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
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
                "url"  : "<?php echo base_url();?>member/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "coun_per_imqc_detil", "searchable":false , "visible":false },
                      { "data": "nama_per_imqc" },
                      { "data": "nama_per_imqc_detil" },
                      { "data": "nama_unit" },
                      { "data": "status_equipment", "searchable":false,
                            "render": function(data, type, row){
                                if (row.status_equipment === '0') {
                                   return '<button class="btn btn-xs btn-danger">NON AKTIF</button>';
                               } else {
                                   return '<button class="btn btn-xs btn-success">AKTIF</button>';
                               }
                            }
                       }
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
                          $('.modal-body').load('<?php echo base_url('member/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
              {
                text: "<i class='fa fa-edit'></i> Rubah",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_per_imqc_detil'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/edit/'); ?>'+data,function(){
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
elseif ($page=="i_mutup")
{
?>
$('#id').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#id").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#id2').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#id2").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
    $(document).ready(function() {
        $('.select2').select2()
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
      "url"  : "<?php echo base_url();?>member/<?php echo $page;?>/data/<?php echo $id;?>/<?php echo $id2;?>/<?php echo $id3;?>/<?php echo $id4;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "tgl_sort", "visible":false, "searchable":false },
                      { "data": "tgl_per_imqc_hasil", "searchable":false, "orderable":false, className:"text-center" },
                      { "data": "nama_per_imqc" },
                      { "data": "hasil_per_imqc_hasil", className:"text-center" },
                      { "data": "ket_per_imqc_hasil", "searchable":false, "orderable":false, className:"text-center" },
                      { "data": "status_per_imqc_hasil", "searchable":false, className:"text-center",
                            "render": function(data, type, row){
                                if (row.status_per_imqc_hasil === '0') {
                                   return '<button class="btn btn-xs btn-danger">NON AKTIF</button>';
                               } else {
                                   return '<button class="btn btn-xs btn-success">AKTIF</button>';
                               }
                            }
                       },
                      { "data": "nama_pegawai", "searchable":false, className:"text-center" }
            ],
            "order": [[0, 'desc']] ,
            "columnDefs" : [{"targets":0, "type":"date-eu"}],
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
              {
                  text: "<i class='fa fa-plus-square'></i> Tambah",
                  className: "btnmaroon",
                  init: function(api, node, config) {
                      $(node).removeClass('btn-default')
                  },
                  action: function ( e, dt, node, config ) {
                      $("#modal-default").modal();
                        $('.modal-body').load('<?php echo base_url('member/'.$page.'/tambah'); ?>',function(){
                          $('#modal-default').modal({show:true});
                        });
                  }
              },
              {
                text: "<i class='fa fa-pencil'></i> Rubah",
                extend: "selected",
                className: "btnolive",
                  action: function ( e, dt, node, config ) { 
                          data = dt.rows( { selected: true } ).data()[0]['id_per_imqc_hasil'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/edit/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
              {
                   text: "<i class='fa fa-clone'></i> Clonning Hasil",
                   extend: "selected",
                   className: "btnmaroon",
                  action: function ( e, dt, node, config ) { 
                          data = dt.rows( { selected: true } ).data()[0]['id_per_imqc_hasil'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/clone/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
                {
                    text: "<i class='fa fa-trash'></i> Hapus",
                    extend: "selected",
                    className: "btnred",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0];
                    swal({
                      title: "Yakin ?",
                    //  text: "Yakin akan menghapus = "+data['nama_lhu'],     //[Modif Disini]
                      text: "Yakin akan menghapus Data Ini ",     //[Modif Disini]
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
                    })
                    .then((willDelete) => {
                      if (willDelete) {
                        location.href = '<?php echo base_url('member/'.$page.'/hapus/'); ?>'+data['id_per_imqc_hasil']; //[Modif Disini]
                      }
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
//============================================ IM / QC
elseif ($page=="quality")
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
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
                "url"  : "<?php echo base_url();?>member/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "coun_per_imqc", "searchable":false , "visible":false },
                      { "data": "nama_per_imqc" },
                      { "data": "nama_unit" },
                      { "data": "status_per_imqc", "searchable":false,
                            "render": function(data, type, row){
                                if (row.status_equipment === '0') {
                                   return '<button class="btn btn-xs btn-danger">NON AKTIF</button>';
                               } else {
                                   return '<button class="btn btn-xs btn-success">AKTIF</button>';
                               }
                            }
                       }
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
                          $('.modal-body').load('<?php echo base_url('member/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
              {
                text: "<i class='fa fa-edit'></i> Rubah",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_per_imqc'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/edit/'); ?>'+data,function(){
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
elseif ($page=="control")
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
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
                "url"  : "<?php echo base_url();?>member/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "coun_per_imqc_detil", "searchable":false , "visible":false },
                      { "data": "nama_per_imqc" },
                      { "data": "nama_per_imqc_detil" },
                      { "data": "nama_unit" },
                      { "data": "status_equipment", "searchable":false,
                            "render": function(data, type, row){
                                if (row.status_equipment === '0') {
                                   return '<button class="btn btn-xs btn-danger">NON AKTIF</button>';
                               } else {
                                   return '<button class="btn btn-xs btn-success">AKTIF</button>';
                               }
                            }
                       }
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
                          $('.modal-body').load('<?php echo base_url('member/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
              {
                text: "<i class='fa fa-edit'></i> Rubah",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_per_imqc_detil'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/edit/'); ?>'+data,function(){
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
elseif ($page=="q_control")
{
?>
$('#id').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#id").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#id2').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#id2").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
    $(document).ready(function() {
        $('.select2').select2()
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
      "url"  : "<?php echo base_url();?>member/<?php echo $page;?>/data/<?php echo $id;?>/<?php echo $id2;?>/<?php echo $id3;?>/<?php echo $id4;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "tgl_sort", "visible":false, "searchable":false },
                      { "data": "tgl_per_imqc_hasil", "searchable":false, "orderable":false, className:"text-center" },
                      { "data": "nama_per_imqc" },
                      { "data": "hasil_per_imqc_hasil", className:"text-center" },
                      { "data": "ket_per_imqc_hasil", "searchable":false, "orderable":false, className:"text-center" },
                      { "data": "status_per_imqc_hasil", "searchable":false, className:"text-center",
                            "render": function(data, type, row){
                                if (row.status_per_imqc_hasil === '0') {
                                   return '<button class="btn btn-xs btn-danger">NON AKTIF</button>';
                               } else {
                                   return '<button class="btn btn-xs btn-success">AKTIF</button>';
                               }
                            }
                       },
                      { "data": "nama_pegawai", "searchable":false, className:"text-center" }
            ],
            "order": [[0, 'desc']] ,
            "columnDefs" : [{"targets":0, "type":"date-eu"}],
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
              {
                  text: "<i class='fa fa-plus-square'></i> Tambah",
                  className: "btnmaroon",
                  init: function(api, node, config) {
                      $(node).removeClass('btn-default')
                  },
                  action: function ( e, dt, node, config ) {
                      $("#modal-default").modal();
                        $('.modal-body').load('<?php echo base_url('member/'.$page.'/tambah'); ?>',function(){
                          $('#modal-default').modal({show:true});
                        });
                  }
              },
              {
                text: "<i class='fa fa-pencil'></i> Rubah",
                extend: "selected",
                className: "btnolive",
                  action: function ( e, dt, node, config ) { 
                          data = dt.rows( { selected: true } ).data()[0]['id_per_imqc_hasil'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/edit/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
              {
                   text: "<i class='fa fa-clone'></i> Clonning Hasil",
                   extend: "selected",
                   className: "btnmaroon",
                  action: function ( e, dt, node, config ) { 
                          data = dt.rows( { selected: true } ).data()[0]['id_per_imqc_hasil'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/clone/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
                {
                    text: "<i class='fa fa-trash'></i> Hapus",
                    extend: "selected",
                    className: "btnred",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0];
                    swal({
                      title: "Yakin ?",
                    //  text: "Yakin akan menghapus = "+data['nama_lhu'],     //[Modif Disini]
                      text: "Yakin akan menghapus Data Ini ",     //[Modif Disini]
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
                    })
                    .then((willDelete) => {
                      if (willDelete) {
                        location.href = '<?php echo base_url('member/'.$page.'/hapus/'); ?>'+data['id_per_imqc_hasil']; //[Modif Disini]
                      }
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
//============================================ QC
elseif ($page=="report")
{
?>
$('#id').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#id").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#id2').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#id2").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
    $(document).ready(function() {
        $('.select2').select2()
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
                "url"  : "<?php echo base_url();?>member/<?php echo $page;?>/data/<?php echo $id;?>/<?php echo $id2;?>/<?php echo $id3;?>/<?php echo $id4;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "tgl_sort", "visible":false },
                      { "data": "tgl_laporan", "searchable":false, "orderable":false, className : "text-center"},
                      { "data": "tgl_awal", "searchable":false, className : "text-center",  "orderable":false,
                            "render": function ( data, type, row ) {
                                return '(' + row.tgl_awal + ' -' + row.tgl_akhir + ')';
                            }
                      },
                      { "data": "judul_laporan", "orderable":false, className : "text-center"},
                      { "data": "tujuan_laporan", "orderable":false, className : "text-center"},
                      { "data": "nama_unit", "searchable":false, "orderable":false, className : "text-center"},
                      { "data": "nama_pegawai", "searchable":false, "orderable":false, className : "text-center"}
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
                          $('.modal-body').load('<?php echo base_url('member/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
              {
                text: "<i class='fa fa-edit'></i> Rubah",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/'.$page.'/edit/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
                {
                    text: "<i class='fa fa-area-chart'></i> Sesuaikan Data Tabel / Grafik",
                    extend: "selected",
                    className: "btnfuchsia",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_laporan'];
                        location.href = '<?php echo base_url('member/sheet/view/'); ?>'+data;
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
elseif ($page=="sheet"){
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
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
            "url"  : "<?php echo base_url();?>member/<?php echo $page;?>/data/<?php echo $idlap;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "urutan_laporan_detil", "searchable":false, className : "text-center"},
                      { "data": "judul_laporan_detil", "searchable":false },
                      { "data": "periode_laporan_detil", "searchable":false, "orderable":false },
                      { "data": "minimax", "searchable":false },
                      { "data": "nama_tabel", "orderable":false },
                      { "data": "nama_unit", "orderable":false },
                      { "data": "jenis_per_laporan_detil", "orderable":false },
                      { "data": "button", 
                        "render": function(data, type, row){
                            if (row.button === '1') {
                               return '<button class="btn btn-xs btn-success"> Sertakan</button>';
                           }  else {
                               return '<button class="btn btn-xs btn-danger"> Tidak disertakan</button>';
                           }
                        }                          
                      }
            ],
            "order": [[0, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-area-chart'></i>&nbsp;<i class='fa fa-plus-square'></i> Tambah Tabel",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('member/sheet/tambah_tabel/'); ?><?php echo $idlap;?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-area-chart'></i>&nbsp;<i class='fa fa-pencil-square'></i> Rubah Tabel",
                  extend: "selected",
                  className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                            data = dt.rows( { selected: true } ).data()[0]['id_laporan'];
                            data2 = dt.rows( { selected: true } ).data()[0]['id_laporan_detil'];
                            $("#modal-default").modal();
                              $('.modal-body').load('<?php echo base_url('member/sheet/rubah_tabel/'); ?>'+data+'/'+data2,function(){
                                $('#modal-default').modal({show:true});
                              });
                    }
                },
                {
                  text: "<i class='fa fa-gears'></i> Seting Indikator",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                            data = dt.rows( { selected: true } ).data()[0]['id_laporan'];
                            data2 = dt.rows( { selected: true } ).data()[0]['id_laporan_detil'];
                            $("#modal-default").modal();
                              $('.modal-body').load('<?php echo base_url('member/sheet/seting_im/'); ?>'+data+'/'+data2,function(){
                                $('#modal-default').modal({show:true});
                              });
                    }
                },
                {
                  text: "<i class='fa fa-gears'></i> Seting Data Mutu",
                  extend: "selected",
                  className: "btnyellow",
                    action: function ( e, dt, node, config ) {
                            data = dt.rows( { selected: true } ).data()[0]['id_laporan'];
                            data2 = dt.rows( { selected: true } ).data()[0]['id_laporan_detil'];
                            $("#modal-default").modal();
                              $('.modal-body').load('<?php echo base_url('member/sheet/seting/'); ?>'+data+'/'+data2,function(){
                                $('#modal-default').modal({show:true});
                              });
                    }
                },
                {
                  text: "<i class='fa fa-send'></i> &nbsp; <i class='fa fa-link'></i>&nbsp; Tampilkan Laporan",
                  extend: "selected",
                  className: "btnlightblue",
                    action: function ( e, dt, node, config ) {
                    //    data = dt.rows( { selected: true } ).data()[0]['id_pendaftaran_unit'];
                        laporan = dt.rows( { selected: true } ).data()[0]['id_laporan'];              
                        tabel = dt.rows( { selected: true } ).data()[0]['id_laporan_detil'];              
                          window.open('<?php echo base_url('external/personal/view/'); ?>'+laporan+'/'+tabel);
                        }
                },
                {
                text: "<i class='fa fa-copy'></i> Clone Data",
                extend: "selected",
                className: "btnolive",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan'];
                          data2 = dt.rows( { selected: true } ).data()[0]['id_laporan_detil'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('member/sheet/clone/'); ?>'+data+'/'+data2,function(){
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
//============================================ LAPORAN
elseif ($page=="pendaftaran")
{
?>
    function confirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href'); //use currentTarget because the click may be on the nested i tag and not a tag causing the href to be empty
        console.log(urlToRedirect); // verify if this is the right URL
        swal({
            title: "Apakah Anda Yakin",
            text: "Data Akan Di Hapus!",
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
    }
  function format ( d ) {        // `d` is the original data object for the row
    return '<table class="table table-striped text-muted style="padding-left:50px; ">'+
      '<tr><td>Biaya:</td><td>'+d.harga_transaksi+'</td> <td></td><td>RM:</td><td>'+d.rm+'</td> </tr>'+
      '<tr><td>Umur:</td><td>'+d.umur+'</td> <td></td><td>Alamat:</td><td>'+d.alamat+'</td> </tr>'+
      '<tr><td>No:</td><td>'+d.no_transaksi+'</td> <td></td><td>Admin:</td><td>'+d.nama_pegawai+'</td> </tr>'+
      '<tr><td>Data Penunjang :</td><td colspan="4">'+d.data_transaksi+'</td> </tr>'+
      '</table>';
  }
    $(document).ready(function() {
//      load_pmr();
      $('.select2').select2()
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
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
                "url"  : "<?php echo base_url();?>member/<?= $page ?>/data",
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
              { "data": "tgl_sortir","searchable":false,"visible":false },
              { "data": "tgl_transaksi","searchable":false },
              { "data": "nama_pasien","orderable":false },
              { "data": "nama_tindakan","orderable":false, className: "bolded" },
              { "data": "nama_unit","orderable":false },
              { "data": "status_transaksi","orderable":false }
            ],
            "order": [[1, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
/*      rowCallback: function(row, data, index){
        if(data[3]> 11.7){
          $(row).find('td:eq(3)').css('color', 'red');
        }
        if(data[2].toUpperCase() == 'EE'){
          $(row).find('td:eq(2)').css('color', 'blue');
        }
      },*/
/*            rowCallback: function(row, data, index){
                if(data['status_pembelian']=="Done"){                
                    $(row).find('td:eq(6)').css('color', 'green');
                }
                else {
                    $(row).find('td:eq(6)').css('color', 'red');
                }
              }, */
            rowCallback: function(row, data, index){
                if(data['status_transaksi'] == "Pendaftaran"){                
                    $(row).find('td:eq(2)').css('background-color','#F99');
                }
                else {
                    $(row).find('td:eq(2)').css('background-color','green');
                    $(row).find('td:eq(2)').css('color', 'white');
                }
        
    //    $(row).find('td:eq(3)').css('background-color','#F99');
      //  $(row).find('td:eq(7)').css('color', 'green');
      //  $(row).find('td:eq(8)').css('color', 'green');
              },
            "buttons": [
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
  });
  $('.SimpanKw').on('click',function(){
        var id = $(this).data('id');    
      $('.modal-body').load('<?php echo base_url('member/pendaftaran/tambah_kewenangan/'); ?>'+id,function(){
          $('#modal-default').modal({show:true});
      });
  });
  $('.EditKw').on('click',function(){
        var id = $(this).data('id');      
      $('.modal-body').load('<?php echo base_url('member/pendaftaran/edit_kewenangan/'); ?>'+id,function(){
          $('#modal-default').modal({show:true});
      });
  });
<?php
}
?>
</script>
		</div>
	</body>
</html>
