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
elseif ($page=="jurnal" || $page=="buku_besar" || $page=="neraca")  
{
?>
    $(document).ready(function() {
		$('.select2').select2()
		$('#example1').DataTable({
		  'paging'      : false,
		  'lengthChange': false,
		  'searching'   : false,
		  'ordering'    : false,
		  'info'        : false,
		  'scrollX'		: true ,
		  'scrollX'			: true,
		  'scrollY'			: '350px',
		  'scrollCollapse'	: true,
		})
	});
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
}
else if ($page=="transaksi")  
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
                "url"  : "<?php echo base_url();?>laporan/<?php echo $page;?>/data/<?php echo $date;?>/<?php echo $first_date;?>/<?php echo $last_date;?>",
                "type" : "POST"
            },
            "columns": [                          
                      { "data": "id_transaksi","searchable":false },
                      { "data": "tgl_transaksi","searchable":false },
					  { "data": "no_transaksi" },
					  { "data": "nama_jenis_jurnal" },
					  { "data": "nama_unit","searchable":false },
                      { "data": "nama_dk","searchable":false },
                      { "data": "ket_transaksi","searchable":false,"orderable":false }
            ],
            "order": [[0, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                  text: "<i class='fa fa-search'></i> Lihat",
                  extend: "selected",
                  className: "btnlime",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_transaksi']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('laporan/'.$page.'/lihat/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
                {
                  text: "<i class='fa fa-file-pdf-o'></i> PDF",
                  extend: "selected",
                  className: "btnfuchsia",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_transaksi']; 
						window.open('<?php echo base_url('laporan/'.$page.'/pdf/'); ?>'+data);
                    }
                },
/*                 {
                  text: "<i class='fa fa-file-excel-o'></i> Excell",
                  extend: "selected",
                  className: "btnlightblue",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_transaksi']; 
						window.open('<?php echo base_url('laporan/'.$page.'/xls/'); ?>'+data);
                    }
                }, */
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
}
?>
</script>
		</div>
	</body>
</html>