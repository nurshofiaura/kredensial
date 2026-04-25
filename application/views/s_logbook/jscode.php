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
$('#pop1,#pop2,#pop3').popover({ trigger: "hover" });
<?php
//================================================= H O M E =================================================
if ($page=="home")
{
	//	Agar saat home tidak ke universal
?>

<?php
}
elseif ($page=="logbook")
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
                "url"  : "<?php echo base_url();?>s_logbook/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_logbook", "searchable":false, "visible":false },
                      { "data": "tgl_logbook", "searchable":false },
					  { "data": "nama_kode_kewenangan", "searchable":false },
					  { "data": "nama_kewenangan" },
                      { "data": "mandiri",
                        "render": function(data, type, row){
                            if (row.mandiri === '0') {
                               return '<button class="btn btn-xs btn-info"> Supervisi</button>';
                           } else {
                               return '<button class="btn btn-xs btn-success"> Mandiri</button>';
                           }
                        }
                      }
            ],
            "order": [[1, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Isi Log Book",
                    className: "btnfuchsia",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
							location.href = '<?php echo base_url('s_logbook/'.$page.'/tambah'); ?>';
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
elseif($page=='logbook_tambah')
{
?>
$('select[name=id_jabatan]').on('change',function(){
    $.ajax({
        url:'<?php echo base_url();?>s_logbook/jabfung_data/'+$(this).val(),
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
elseif($page=='logbook_isi')
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
	});
<?php
}
?>
</script>
		</div>
	</body>
</html>
