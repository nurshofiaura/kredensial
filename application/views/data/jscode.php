<script src="<?php echo base_url();?>assets/js/sweetalert.min.js"></script>
<script type="text/javascript">
<?php
//================================================= H O M E =================================================
if ($page=="home")
{
	//	Agar saat home tidak ke universal
?>

<?php
}
elseif ($page=="gender" || $page=="pk" || $page=="jabfung" || $page=="pendidikan" || $page=="agama" || $page=="status_perkawinan" || $page=="status_pegawai" || $page=="pelatihan")
{
?>
<?php
if($page=="gender"){
	$cat = 'jk';
}
if($page=="pk"){
	$cat = 'nama_kode_kewenangan';
}
if($page=="jabfung"){
	$cat = 'nama_jabatan_fungsional';
}
if($page=="pendidikan"){
	$cat = 'nama_pendidikan';
}
if($page=="agama"){
	$cat = 'nama_agama';
}
if($page=="status_perkawinan"){
	$cat = 'nama_status_kawin';
}
if($page=="status_pegawai"){
	$cat = 'nama_status_pegawai';
}
if($page=="pelatihan"){
	$cat = 'nama_kategori_pelatihan';
}
?>
	am4core.ready(function() {
	am4core.useTheme(am4themes_dataviz);
	am4core.useTheme(am4themes_animated);
	var chart = am4core.create("chartdiv", am4charts.PieChart);
	chart.dataSource.url = "<?php echo base_url();?>data/<?php echo $page;?>/data/<?php echo $id;?>";
	var pieSeries = chart.series.push(new am4charts.PieSeries());
	pieSeries.dataFields.value = "total";
	pieSeries.dataFields.category = "<?= $cat;?>";
	pieSeries.innerRadius = am4core.percent(0);

//	pieSeries.ticks.template.disabled = true;
//	pieSeries.alignLabels = false;
//	pieSeries.labels.template.text = "{value.percent.formatNumber('#.0')}%";
	pieSeries.labels.template.text = "[bold {color}]{category} :  {value} ({value.percent.formatNumber('#.0')}%) [/]";
//	pieSeries.labels.template.radius = am4core.percent(-80);
//	pieSeries.labels.template.fill = am4core.color("white");
//	pieSeries.labels.template.maxWidth = 130;
	pieSeries.labels.template.paddingTop = 0;
	pieSeries.labels.template.paddingBottom = 0;
	pieSeries.labels.template.fontSize = 10;
	pieSeries.labels.template.wrap = true;
	pieSeries.labels.template.relativeRotation = 90;

	var rgm = new am4core.RadialGradientModifier();
	rgm.brightnesses.push(-0.8, -0.8, -0.5, 0, - 0.5);
	pieSeries.slices.template.fillModifier = rgm;
	pieSeries.slices.template.strokeModifier = rgm;
	pieSeries.slices.template.strokeOpacity = 0.4;
	pieSeries.slices.template.strokeWidth = 0;
	chart.legend = new am4charts.Legend();
	//chart.legend.labels.template.text = "[bold {color}]{category} : {value.percent.formatNumber('#.0')}% [/]";
	chart.legend.paddingTop = 0;
	chart.legend.paddingBottom = 0;
	chart.legend.fontSize = 11;
	chart.legend.wrap = true;
chart.legend.labels.template.maxWidth = 150;
chart.legend.labels.template.truncate = true;	
//	chart.legend.position = "right";
	chart.legend.scrollable = true;


/* Create a separate container to put legend in */
var legendContainer = am4core.create("legenddiv", am4core.Container);
legendContainer.width = am4core.percent(100);
legendContainer.height = am4core.percent(100);
chart.legend.parent = legendContainer;
chart.responsive.enabled = true;

chart.exporting.menu = new am4core.ExportMenu();
chart.exporting.menu.align = "left";
chart.exporting.menu.verticalAlign = "top";
// Add watermark
var watermark = chart.createChild(am4core.Label);
watermark.text = "Source: [bold] kredensial.web.id [/]";
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

var title = chart.titles.create();
title.text = "<?php echo $instance_name; ?>";
title.fontSize = 18;
title.tooltipText = "<?php echo $instance_name; ?>";
	});
<?php
}
elseif ($page=="demografi"){
if($id == 1){
	$cat = 'nama_kab';
}else if($id == 2){
	$cat = 'nama_kec';
}else if($id == 3){
	$cat = 'nama_kel';
}else{
	$cat = 'nama_prov';
}
?>
        function removeOptions(selectbox){
            var i;
            for(i = selectbox.options.length - 1 ; i >= 0 ; i--)
            {
                selectbox.remove(i);
            }
        }
    $('select[name=id_prov]').on('change',function(){
        $.ajax({
            url:'<?php echo base_url();?>data/kab_data/'+$(this).val(),
            type: "POST",
            dataType: 'json'
         }).done(function(data) {
            // alert(data[0]["nama_kab"]);
            // $('select[name=id_kab]').html(data);
               var len = data.length;
// alert("id="+data[1]["id_kab"]+" nama="+data[1]["nama_kab"]);
// $("#id_kab").select2('val', 'All');
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
            url:'<?php echo base_url();?>data/kec_data/'+$(this).val(),
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
            url:'<?php echo base_url();?>data/kel_data/'+$(this).val(),
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
	am4core.ready(function() {
	am4core.useTheme(am4themes_dataviz);
	am4core.useTheme(am4themes_animated);
	var chart = am4core.create("chartdiv", am4charts.PieChart);
	chart.dataSource.url = "<?php echo base_url();?>data/<?php echo $page;?>/data/<?php echo $id;?>/<?php echo $cr;?>/<?php echo $id_prov;?>/<?php echo $id_kab;?>/<?php echo $id_kel;?>/<?php echo $id_kec;?>";
	var pieSeries = chart.series.push(new am4charts.PieSeries());
	pieSeries.dataFields.value = "total";
	pieSeries.dataFields.category = "<?= $cat;?>";
	pieSeries.innerRadius = am4core.percent(0);

//	pieSeries.ticks.template.disabled = true;
//	pieSeries.alignLabels = false;
//	pieSeries.labels.template.text = "{value.percent.formatNumber('#.0')}%";
	pieSeries.labels.template.text = "[bold {color}]{category} :  {value} ({value.percent.formatNumber('#.0')}%) [/]";
//	pieSeries.labels.template.radius = am4core.percent(-80);
//	pieSeries.labels.template.fill = am4core.color("white");
//	pieSeries.labels.template.maxWidth = 130;
	pieSeries.labels.template.paddingTop = 0;
	pieSeries.labels.template.paddingBottom = 0;
	pieSeries.labels.template.fontSize = 10;
	pieSeries.labels.template.wrap = true;
	pieSeries.labels.template.relativeRotation = 90;

	var rgm = new am4core.RadialGradientModifier();
	rgm.brightnesses.push(-0.8, -0.8, -0.5, 0, - 0.5);
	pieSeries.slices.template.fillModifier = rgm;
	pieSeries.slices.template.strokeModifier = rgm;
	pieSeries.slices.template.strokeOpacity = 0.4;
	pieSeries.slices.template.strokeWidth = 0;

	chart.legend = new am4charts.Legend();
	//chart.legend.labels.template.text = "[bold {color}]{category} : {value.percent.formatNumber('#.0')}% [/]";
	chart.legend.paddingTop = 0;
	chart.legend.paddingBottom = 0;
	chart.legend.fontSize = 11;
	chart.legend.wrap = true;
chart.legend.labels.template.maxWidth = 150;
chart.legend.labels.template.truncate = true;	
//	chart.legend.position = "right";
	chart.legend.scrollable = true;


/* Create a separate container to put legend in */
var legendContainer = am4core.create("legenddiv", am4core.Container);
legendContainer.width = am4core.percent(100);
legendContainer.height = am4core.percent(100);
chart.legend.parent = legendContainer;
chart.responsive.enabled = true;

chart.exporting.menu = new am4core.ExportMenu();
chart.exporting.menu.align = "left";
chart.exporting.menu.verticalAlign = "top";
// Add watermark
var watermark = chart.createChild(am4core.Label);
watermark.text = "Source: [bold] kredensial.web.id [/]";
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

var title = chart.titles.create();
title.text = "<?php echo $instance_name; ?>";
title.fontSize = 18;
title.tooltipText = "<?php echo $instance_name; ?>";
	});
<?php 
}
elseif ($page=="registrasi")
{
?>
document.getElementById('username').onkeydown = function (e) {
  var value =  e.target.value;
  //only allow a-z, A-Z, digits 0-9 and comma, with only 1 consecutive comma ...
  if (!e.key.match(/[a-zA-Z0-9]/)) {
    e.preventDefault();  
  }
};
    $("#nik").on("input", function(e) {
			$('#msg2').hide();
			if ($('#nik').val() == null || $('#nik').val() == "") {
				$('#msg2').show();
				$("#msg2").html("NIK Harus Diisi").css("color", "red");
			} else {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url();?>data/check_nik",
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
		$("#username").on("input", function(e) {
			$('#msg').hide();
			if ($('#username').val() == null || $('#username').val() == "") {
				$('#msg').show();
				$("#msg").html("Username Harus Diisi").css("color", "red");
			} else {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url();?>data/check_availability",
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
function toTitleCase(str) {
  return str.replace(/\w\S*/g, function(txt) {
    return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
  });
}
<?php 
}
?>
</script>
	</body>
</html>