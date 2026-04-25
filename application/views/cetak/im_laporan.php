<?php 
//	$this->load->view('surat_style');
	$adata = $this->m_umum->ambil_data('a_data','id_data','1');
	$d	= $this->m_umum->ambil_data('sn_laporan','barcode_laporan',$id);
?>
 <!DOCTYPE html>
<html>

<head>
<link rel="icon" href="<?php echo base_url();?>assets/images/favicon.ico">
		<title><?php echo $title; ?> | <?php echo $instance_name; ?></title>
		<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/bower_components/font-awesome/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/bower_components/Ionicons/css/ionicons.min.css">
    <!-- DataTables -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/datatables/datatables.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/datatables/Buttons-1.5.6/css/buttons.dataTables.min.css">
		<!-- AdminLTE Skins. Choose a skin from the css/skins
		   folder instead of downloading all of them to reduce the load. -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/dist/css/skins/_all-skins.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/sa.css">
		  <!-- Select2 -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/bower_components/select2/dist/css/select2.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/bower_components/iCheck/all.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/lightbox.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/dist/css/AdminLTE.min.css">
<style>
body{
	font-family: Times New Roman;
	font-size: 12pt;
	line-height: 2;
    margin: 0;	
    background-color: white;   
}
</style>
</head>
<body>
	    <section class="content-header text-center">
				<h3 style="font-weight:bold;"><?= $d['header_profil'] ?></h3>
				<h3 style="font-weight:bold;"><?= $d['sub_header_profil'] ?></h3>
	    </section>
	    <section class="content">
<?php
if(!empty($d['sejarah']))
 echo '<br style="line-height:1">'. $d['sejarah'];

if(!empty($d['visi_misi']))
 echo '<br style="line-height:1">'.  $d['visi_misi'];

if(!empty($d['tujuan_fungsi']))
 echo '<br style="line-height:1">'.  $d['tujuan_fungsi'];

if(!empty($d['struktur_organisasi'])){
	 echo '<br style="line-height:1">';
?>
	<div class="timeline-item">            
	  <h3 style="font-weight:bold;" class="timeline-header">STRUKTUR ORGANISASI</h3>
  	<div class="timeline-body">
<?php
	$br_struktur = $this->m_sanitasi->ol_berkas_in($d['struktur_organisasi'],'60');
	foreach($br_struktur as $rowbr_struktur){
?>
<a class="example-image-link" href="<?php echo base_url('assets/berkas/im/'.$rowbr_struktur['link_berkas']);?>" 
  data-lightbox="example-set" data-title="<?php echo $rowbr_struktur['no_berkas'].' - '.$rowbr_struktur['nama_berkas']; ?>">
  <img class="margin" src="<?php echo base_url('assets/berkas/resize/'.$rowbr_struktur['link_berkas']);?>" style="width: 150;height: 100;" alt="Photo">
</a>
<?php
	}
?>
  	</div>
	</div>
<?php
}

if(!empty($d['informasi_layanan']))
 echo '<br style="line-height:1">'.  $d['informasi_layanan'];

if(!empty($d['regulasi'])){
	 echo '<br style="line-height:1">';
	$br_regulasi = $this->m_sanitasi->ol_berkas_in($d['regulasi'],'50');
	foreach($br_regulasi as $rowbr_regulasi){
?>
<table class="table table-bordered">
  <tr>
    <th>Nama Berkas</th>
    <th>Keterangan</th>
    <th>Link</th>
  </tr>
 	<tr>
 		 <td><?= $rowbr_regulasi['nama_berkas'] ?></td>
 		 <td><?= $rowbr_regulasi['no_berkas'] ?></td>
 		 <td>
				<a href="<?php echo base_url('assets/berkas/im/'.$rowbr_regulasi['link_berkas']);?>" target="_blank">
				  Link Berkas
				</a> 		 	
 		 </td>
 	</tr>
</table>
<?php
	}
}

if(!empty($d['galeri_laporan'])){
	 echo '<br style="line-height:1">';
?>
	<div class="timeline-item">     
	  <h3 style="font-weight:bold;" class="timeline-header">GALERI</h3>       
  	<div class="timeline-body">
<?php 
	$br_galeri_laporan = $this->m_sanitasi->ol_berkas_in($d['galeri_laporan'],'60');
	foreach($br_galeri_laporan as $rowbr_galeri_laporan){
?>
<a class="example-image-link" href="<?php echo base_url('assets/berkas/im/'.$rowbr_galeri_laporan['link_berkas']);?>" 
  data-lightbox="example-set" data-title="<?php echo $rowbr_galeri_laporan['no_berkas'].' - '.$rowbr_galeri_laporan['nama_berkas']; ?>">
  <img class="margin" src="<?php echo base_url('assets/berkas/resize/'.$rowbr_galeri_laporan['link_berkas']);?>" style="width: 150;height: 100;" alt="Photo">
</a>
<?php
	}
?>
  	</div>
	</div>
<?php
}
?>
	    </section>
<style>
#chartdiv {
  width: 700px;
  height: 500px;
}
</style>
<div id="chartdiv"></div>
<script src="<?php echo base_url();?>assets/admin/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/js/lightbox-plus-jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>assets/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/amcharts/old/amcharts.js"></script>
<script src="<?php echo base_url();?>assets/amcharts/old/serial.js"></script>
<script src="<?php echo base_url();?>assets/amcharts/old/dark.js"></script>
<script src="<?php echo base_url();?>assets/amcharts/old/export.min.js"></script>
<script src="<?php echo base_url();?>assets/amcharts/old/dataloader.js"></script>
<script src="<?php echo base_url();?>assets/amcharts/core.js"></script>
<script src="<?php echo base_url();?>assets/amcharts/charts.js"></script>
<script src="<?php echo base_url();?>assets/amcharts/themes/dataviz.js"></script>
<script src="<?php echo base_url();?>assets/amcharts/themes/animated.js"></script>
<script type="text/javascript">
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
categoryAxis.dataItems.template.text = "{realName}";
categoryAxis.adapter.add("tooltipText", function(tooltipText, target){
  return categoryAxis.tooltipDataItem.dataContext.realName;
})

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
 "Provider 1": {
   "item 1": 10,
   "item 2": 35,
   "item 3": 5,
   "item 4": 20,
   "quantity":430
 },
 "Provider 2": {
   "item 1": 15,
   "item 3": 21,
   "quantity":210
 },
 "Provider 3": {
   "item 2": 25,
   "item 3": 11,
   "item 4": 17,
   "quantity":265
 },
 "Provider 4": {
   "item 3": 12,
   "item 4": 15,
   "quantity":98
 }
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

}); // end am4core.ready()
</script>
</body>
</html>