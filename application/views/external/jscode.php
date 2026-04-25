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
let mybutton = document.getElementById("myBtn");
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
<?php
//================================================= H O M E =================================================
if ($page=="home")
{
	//	Agar saat home tidak ke universal
?>

<?php
} 
elseif ($page=="imut" || $page=="personal")
{
  if($iddet){
    if($tabel == 1 || $tabel == 14 || $jenis_per_laporan_detil == 5){
?>
/*    $(document).ready(function() {
   	var example1 = $('#example1').DataTable({
      'paging'      	: false,
      'lengthChange'	: false,
      'searching'   	: false,
      'ordering'    	: false,
      'info'        	: true,
	  'scrollX'			: true,
	  'scrollY'			: '500px',
	  'scrollCollapse'	: true,
	  'fixedColumns'	: true
    });new $.fn.dataTable.FixedColumns(example1, { leftColumns: 1 }); 
	});*/
<?php        
    }
    if($tabel == 3){
      //============================================================================= GRAFIK 3 Grafik Pie
?>
      am4core.ready(function() {
          // Tabel 3
      am4core.useTheme(am4themes_dataviz);
      am4core.useTheme(am4themes_animated);
      var chart = am4core.create("chartdiv", am4charts.PieChart);

      chart.data = [
          <?php
              foreach($grafikpie as $row1){
          ?>
              {
                "country":  <?php echo '"'.$row1[$nama_kat_lv2].'"'; ?>,
                "total": <?php echo round($row1[$jml_item],2); ?>
              },
          <?php
              }
          ?>
      ];

      var pieSeries = chart.series.push(new am4charts.PieSeries());
      pieSeries.dataFields.value = "total";
      pieSeries.dataFields.category = "country";
      pieSeries.innerRadius = am4core.percent(50);
      pieSeries.ticks.template.disabled = true;
      pieSeries.labels.template.disabled = true;

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
      //    chart.legend.labels.template.maxWidth = 150;
      chart.legend.labels.template.truncate = true;   
      chart.legend.scrollable = true;
      chart.legend.parent = legendContainer;

      chart.exporting.menu = new am4core.ExportMenu();
      chart.exporting.menu.align = "left";
      chart.exporting.menu.verticalAlign = "top";

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

      chart.responsive.enabled = true;

      var title = chart.titles.create();
      title.text = "<?php echo $judul_laporan_detil; ?>";
      title.fontSize = 18;
      title.tooltipText = "<?php echo $judul_laporan_detil; ?>";
      });
<?php
      //============================================================================= !GRAFIK 3 Grafik Pie
    }
    if($tabel == 5){
      //============================================================================= GRAFIK 5 Grafik Garis Combine
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
      chart.data = [
      <?php
      foreach($grafik5 as $row1){
      ?>
      {

      "year": <?php echo '"'.$row1[$viewgraphic].'"'; ?>,
      <?php
      $no = 0;
      $slcgrafikgaris = (" ".$Kat_lv2." as ".$id_kat_lv2.",SUM(".$jml_item.") as ".$jml_item.",".$coun_kat_lv1.",".$coun_kat_lv2." ");
      if($periode_laporan_detil == 1){
        $kndsgrafikgaris = array($tgl_item=>$row1[$tgl_item],$ins=>$idinst);
      }
      if($periode_laporan_detil == 2){
        $kndsgrafikgaris = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$idinst);
      }
      if($periode_laporan_detil == 3){
        $kndsgrafikgaris = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],$ins=>$idinst);
      }
      if($page == 'imut'){
        $grafikgaris = $this->m_external->ambil_isi($iddet,$tabel_item,$slcgrafikgaris,$kndsgrafikgaris,$Kat_lv2);
      }else{
        $grafikgaris = $this->m_external->ambil_isi_personal($iddet,$tabel_item,$slcgrafikgaris,$kndsgrafikgaris,$Kat_lv2);
      }        
      foreach($grafikgaris as $row2){
          $no++;
      ?>
      <?php echo '"'.$row2[$id_kat_lv2].'"'; ?>:<?php echo $row2[$jml_item]; ?>,
      <?php
      }
      ?>
      },
      <?php
      }
      ?>
      ];

      var categoryAxis1 = chart.xAxes.push(new am4charts.CategoryAxis());
      categoryAxis1.dataFields.category = "year";
      categoryAxis1.renderer.grid.template.location = 0;

      // Create series
      function createAxisAndSeries(field, name, opposite, bullet) {
      var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
      if(chart.yAxes.indexOf(valueAxis) != 0){
      valueAxis.syncWithAxis = chart.yAxes.getIndex(0);
      }

      var series = chart.series.push(new am4charts.LineSeries());
      series.dataFields.valueY = field;
      series.dataFields.categoryX = "year";
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

      <?php
      foreach($legendgrafik5 as $rowambil_limbah_grafik){
      $arrfaltru = array('false','true');
      $rndarrfaltru = array_rand($arrfaltru);
      $txtrfaltru = $arrfaltru[$rndarrfaltru];  

      $arrbangun = array('circle','triangle','rectangle');
      $rndarrbangun = array_rand($arrbangun);
      $txtrbangun = $arrbangun[$rndarrbangun];  

      ?>
      createAxisAndSeries(<?php echo '"'.$rowambil_limbah_grafik[$id_kat_lv2].'"'; ?>, <?php echo '"'.$rowambil_limbah_grafik[$nama_kat_lv2].'"'; ?>, <?php echo $txtrfaltru; ?>, <?php echo '"'.$txtrbangun.'"'; ?>);
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

      var legendContainer = am4core.create("legenddiv", am4core.Container);
      legendContainer.width = am4core.percent(100);
      legendContainer.height = am4core.percent(100);
      //chart.legend.parent = legendContainer;
      chart.legend = new am4charts.Legend();
      chart.legend.markers.template.disabled = true;
      chart.legend.labels.template.text = "[bold {color}]{name} : {valueY}[/]";
      //        chart.legend.itemContainers.template.tooltipText = "[bold {color}]{name}[/]";
      chart.legend.labels.template.maxWidth = 350;
      chart.legend.labels.template.truncate = true;
      chart.legend.fontSize = 11;
      chart.legend.scrollable = true
      //    chart.leftAxesContainer.layout = "vertical";
      chart.rightAxesContainer.layout = "vertical";
      chart.legend.labels.template.wrap = false;

      chart.exporting.menu = new am4core.ExportMenu();
      chart.exporting.menu.align = "left";
      chart.exporting.menu.verticalAlign = "top";

      var watermark = chart.createChild(am4core.Label);
      watermark.text = "Source: [bold] kredensial.web.id [/]";
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
      title.text = "<?php echo $judul_laporan_detil; ?>";
      title.fontSize = 18;
      title.tooltipText = "<?php echo $judul_laporan_detil; ?>";

      }); // end am4core.ready()
<?php 
      //============================================================================= !GRAFIK 5 Grafik Garis Combine
    }
    if($tabel == 6){
      //============================================================================= GRAFIK 6 Grafik Garis Range separate
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
      chart.data = [
      <?php
      foreach($grafik5 as $row1){
      ?>
      {

      "year": <?php echo '"'.$row1[$viewgraphic].'"'; ?>,
      <?php
      $no = 0;
      $slcgrafikgaris = (" ".$Kat_lv2." as ".$id_kat_lv2.",SUM(".$jml_item.") as ".$jml_item.",".$coun_kat_lv1.",".$coun_kat_lv2." ");
      if($periode_laporan_detil == 1){
        $kndsgrafikgaris = array($tgl_item=>$row1[$tgl_item],$ins=>$idinst);
      }
      if($periode_laporan_detil == 2){
        $kndsgrafikgaris = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$idinst);
      }
      if($periode_laporan_detil == 3){
        $kndsgrafikgaris = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],$ins=>$idinst);
      }
      if($page == 'imut'){
        $grafikgaris = $this->m_external->ambil_isi($iddet,$tabel_item,$slcgrafikgaris,$kndsgrafikgaris,$Kat_lv2);
      }else{
        $grafikgaris = $this->m_external->ambil_isi_personal($iddet,$tabel_item,$slcgrafikgaris,$kndsgrafikgaris,$Kat_lv2);
      }
      foreach($grafikgaris as $row2){
          $no++;
      ?>
      <?php echo '"'.$row2[$id_kat_lv2].'"'; ?>:<?php echo $row2[$jml_item]; ?>,
      <?php
      }
      ?>
      },
      <?php
      }
      ?>
      ];

      var categoryAxis1 = chart.xAxes.push(new am4charts.CategoryAxis());
      categoryAxis1.dataFields.category = "year";
      categoryAxis1.renderer.grid.template.location = 0;

      var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
      valueAxis.renderer.inversed = false;
      valueAxis.title.text = "Nilai";
      valueAxis.renderer.minLabelPosition = 0.01;
      <?php  
      if($ambil_data_min > $min_laporan_detil){
      $plusmin = $min_laporan_detil - 1;
      }else{
      $plusmin = $ambil_data_min - 1;
      }
      if($ambil_data_max < $max_laporan_detil){
       $plusmax = $max_laporan_detil + 1;
      }else{
       $plusmax = $ambil_data_max + 1;
      }
      ?>
      valueAxis.min = <?= $plusmin ?>;
      valueAxis.max = <?= $plusmax ?>;

      let range0 = valueAxis.axisRanges.create();
      range0.value = <?= round($min_laporan_detil,2) ?>;
      range0.label.text = "Batas Min = <?= round($min_laporan_detil,2) ?>";
      range0.grid.stroke = am4core.color("#ff0000");
      range0.grid.strokeWidth = 2;
      range0.grid.strokeOpacity = 1;
      range0.label.inside = true;
      range0.label.fill = range0.grid.stroke;
      range0.label.verticalCenter = "bottom";

      let range500 = valueAxis.axisRanges.create();
      range500.value = <?= round($max_laporan_detil,2) ?>;
      range500.label.text = "Batas Max = <?= round($max_laporan_detil,2) ?>";
      range500.grid.stroke = am4core.color("#ff0000");
      range500.grid.strokeWidth = 2;
      range500.grid.strokeOpacity = 1;
      range500.label.inside = true;
      range500.label.fill = range500.grid.stroke;
      range500.label.verticalCenter = "bottom";

      // Create series
      function createAxisAndSeries(field, name, bullet) {
      var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
      if(chart.yAxes.indexOf(valueAxis) != 0){
      valueAxis.syncWithAxis = chart.yAxes.getIndex(0);
      }

      var series = chart.series.push(new am4charts.LineSeries());
      series.dataFields.valueY = field;
      series.dataFields.categoryX = "year";
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
    //  valueAxis.renderer.opposite = opposite;
      valueAxis.renderer.minLabelPosition = 0.01;
      valueAxis.renderer.minGridDistance = 25;
      }

      <?php
      foreach($legendgrafik5 as $rowambil_limbah_grafik){
      $arrfaltru = array('false','true');
      $rndarrfaltru = array_rand($arrfaltru);
      $txtrfaltru = $arrfaltru[$rndarrfaltru];  

      $arrbangun = array('circle','triangle','rectangle');
      $rndarrbangun = array_rand($arrbangun);
      $txtrbangun = $arrbangun[$rndarrbangun];  

      ?>
      createAxisAndSeries(<?php echo '"'.$rowambil_limbah_grafik[$id_kat_lv2].'"'; ?>, <?php echo '"'.$rowambil_limbah_grafik[$nama_kat_lv2].'"'; ?>, <?php echo '"'.$txtrbangun.'"'; ?>);
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

      var legendContainer = am4core.create("legenddiv", am4core.Container);
      legendContainer.width = am4core.percent(100);
      legendContainer.height = am4core.percent(100);
      //chart.legend.parent = legendContainer;
      chart.legend = new am4charts.Legend();
      chart.legend.markers.template.disabled = true;
      chart.legend.labels.template.text = "[bold {color}]{name} : {valueY}[/]";
      //        chart.legend.itemContainers.template.tooltipText = "[bold {color}]{name}[/]";
      chart.legend.labels.template.maxWidth = 350;
      chart.legend.labels.template.truncate = true;
      chart.legend.fontSize = 11;
      chart.legend.scrollable = true
      chart.leftAxesContainer.layout = "vertical";
     // chart.rightAxesContainer.layout = "vertical";
      chart.legend.labels.template.wrap = false;

      chart.exporting.menu = new am4core.ExportMenu();
      chart.exporting.menu.align = "left";
      chart.exporting.menu.verticalAlign = "top";

      var watermark = chart.createChild(am4core.Label);
      watermark.text = "Source: [bold] kredensial.web.id [/]";
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
      title.text = "<?php echo $judul_laporan_detil; ?>";
      title.fontSize = 18;
      title.tooltipText = "<?php echo $judul_laporan_detil; ?>";

      }); // end am4core.ready()
<?php
      //============================================================================= !GRAFIK 6 Grafik Garis Range separate
    }
    if($tabel == 7){
      //============================================================================= GRAFIK 7 Grafik Garis Range Combine
?>
          am4core.ready(function() {
            // Tabel 9
          am4core.useTheme(am4themes_animated);
          var chart = am4core.create("chartdiv", am4charts.XYChart);
          chart.data = [
          <?php
          foreach($grafik5 as $row1){
          ?>
          {

          "year": <?php echo '"'.$row1[$viewgraphic].'"'; ?>,
          <?php
          $no = 0;
          $slcgrafikgaris = (" ".$Kat_lv2." as ".$id_kat_lv2.",SUM(".$jml_item.") as ".$jml_item." ");
          if($periode_laporan_detil == 1){
            $kndsgrafikgaris = array($tgl_item=>$row1[$tgl_item],$ins=>$idinst);
          }
          if($periode_laporan_detil == 2){
            $kndsgrafikgaris = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$idinst);
          }
          if($periode_laporan_detil == 3){
            $kndsgrafikgaris = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],$ins=>$idinst);
          }
      if($page == 'imut'){
        $grafikgaris = $this->m_external->ambil_isi($iddet,$tabel_item,$slcgrafikgaris,$kndsgrafikgaris,$Kat_lv2);
      }else{
        $grafikgaris = $this->m_external->ambil_isi_personal($iddet,$tabel_item,$slcgrafikgaris,$kndsgrafikgaris,$Kat_lv2);
      }
          foreach($grafikgaris as $row2){
              $no++;
          ?>
          <?php echo '"'.$row2[$id_kat_lv2].'"'; ?>:<?php echo $row2[$jml_item]; ?>,
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

          var axisTooltip = categoryAxis.tooltip;
          axisTooltip.background.fill = am4core.color("#07BEB8");
          axisTooltip.background.strokeWidth = 0;
          axisTooltip.background.cornerRadius = 3;
          axisTooltip.background.pointerLength = 0;
          axisTooltip.dy = 5;

          var dropShadow = new am4core.DropShadowFilter();
          dropShadow.dy = 1;
          dropShadow.dx = 1;
          dropShadow.opacity = 0.5;
          axisTooltip.filters.push(dropShadow);

          // Create value axis
          var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
          valueAxis.renderer.inversed = false;
          valueAxis.title.text = "Nilai";
          valueAxis.renderer.minLabelPosition = 0.01;

      <?php  
      if($ambil_data_min > $min_laporan_detil){
      $plusmin = $min_laporan_detil - 1;
      }else{
      $plusmin = $ambil_data_min - 1;
      }
      if($ambil_data_max < $max_laporan_detil){
       $plusmax = $max_laporan_detil + 1;
      }else{
       $plusmax = $ambil_data_max + 1;
      }
      ?>
  //    valueAxis.min = <?= $plusmin ?>;
  //    valueAxis.max = <?= $plusmax ?>;

      let range0 = valueAxis.axisRanges.create();
      range0.value = <?= round($min_laporan_detil,2) ?>;
      range0.label.text = "Batas Min = <?= round($min_laporan_detil,2) ?>";
      range0.grid.stroke = am4core.color("#ff0000");
      range0.grid.strokeWidth = 2;
      range0.grid.strokeOpacity = 1;
      range0.label.inside = true;
      range0.label.fill = range0.grid.stroke;
      range0.label.verticalCenter = "bottom";

      let range500 = valueAxis.axisRanges.create();
      range500.value = <?= round($max_laporan_detil,2) ?>;
      range500.label.text = "Batas Max = <?= round($max_laporan_detil,2) ?>";
      range500.grid.stroke = am4core.color("#ff0000");
      range500.grid.strokeWidth = 2;
      range500.grid.strokeOpacity = 1;
      range500.label.inside = true;
      range500.label.fill = range500.grid.stroke;
      range500.label.verticalCenter = "bottom";

          <?php
          foreach($legendgrafik5 as $row1x){
          //  $jsonxx = $this->m_umum->ambil_data('dsr_kredensial','id_dsr_kredensial',$nox);
          ?>
          // Create series
          var series<?php echo $row1x[$id_kat_lv2]; ?> = chart.series.push(new am4charts.LineSeries());
          series<?php echo $row1x[$id_kat_lv2]; ?>.dataFields.valueY = <?php echo '"'.$row1x[$id_kat_lv2].'"'; ?>;
          series<?php echo $row1x[$id_kat_lv2]; ?>.dataFields.categoryX = "year";
          series<?php echo $row1x[$id_kat_lv2]; ?>.name = <?php echo '"'.$row1x[$nama_kat_lv2].'"'; ?>;
          series<?php echo $row1x[$id_kat_lv2]; ?>.bullets.push(new am4charts.CircleBullet());
          //    series<php echo $row1x[$id_kat_lv2]; ?>.tooltipText = "{name} Tgl {categoryX} : {valueY}";
          //    series<php echo $row1x[$id_kat_lv2]; ?>.legendSettings.valueText = "{valueY}";
          series<?php echo $row1x[$id_kat_lv2]; ?>.visible  = false;

          series<?php echo $row1x[$id_kat_lv2]; ?>.strokeWidth = 3;
          series<?php echo $row1x[$id_kat_lv2]; ?>.tooltipText = "{name} - {dateX} : [b]{valueY}[/]";
          series<?php echo $row1x[$id_kat_lv2]; ?>.legendSettings.labelText = "[bold {color}]{name}[/]";
          series<?php echo $row1x[$id_kat_lv2]; ?>.legendSettings.valueText = "{valueY.close}";
          series<?php echo $row1x[$id_kat_lv2]; ?>.legendSettings.itemValueText = "[bold]{valueY}[/bold]";  

          let hs<?php echo $row1x[$id_kat_lv2]; ?> = series<?php echo $row1x[$id_kat_lv2]; ?>.segments.template.states.create("hover")
          hs<?php echo $row1x[$id_kat_lv2]; ?>.properties.strokeWidth = 5;
          series<?php echo $row1x[$id_kat_lv2]; ?>.segments.template.strokeWidth = 1;

          var circleBullet<?php echo $row1x[$id_kat_lv2]; ?> = series<?php echo $row1x[$id_kat_lv2]; ?>.bullets.push(new am4charts.CircleBullet());
          circleBullet<?php echo $row1x[$id_kat_lv2]; ?>.circle.stroke = am4core.color("#fff");
          circleBullet<?php echo $row1x[$id_kat_lv2]; ?>.circle.strokeWidth = 2;

          var labelBullet<?php echo $row1x[$id_kat_lv2]; ?> = series<?php echo $row1x[$id_kat_lv2]; ?>.bullets.push(new am4charts.LabelBullet());
          labelBullet<?php echo $row1x[$id_kat_lv2]; ?>.label.text = "{valueY}";
          labelBullet<?php echo $row1x[$id_kat_lv2]; ?>.label.dy = -20;

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
          chart.legend.markers.template.disabled = true;
          chart.legend.labels.template.text = "[bold {color}]{name} : {valueY}[/]";
          chart.legend.labels.maxWidth = 350;
          chart.legend.labels.maxHeight  = 350;
          chart.legend.labels.truncate = true;
          chart.legend.fontSize = 10;
          chart.legend.labels.template.wrap = false;
          //    chart.legend.scrollable = true
          //   chart.leftAxesContainer.layout = "horizontal";
          //   chart.leftAxesContainer.layout = "vertical";
          //   chart.rightAxesContainer.layout = "vertical";

          var legendContainer = am4core.create("legenddiv", am4core.Container);
          legendContainer.width = am4core.percent(100);
          legendContainer.height = am4core.percent(100);
          chart.legend.parent = legendContainer;
          chart.responsive.enabled = true;

          chart.exporting.menu = new am4core.ExportMenu();
          chart.exporting.menu.align = "left";
          chart.exporting.menu.verticalAlign = "top";

          var watermark = chart.createChild(am4core.Label);
          watermark.text = "Source: [bold] kredensial.web.id [/]";
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
          title.text = "<?= $judul_laporan_detil ?>";
          title.fontSize = 18;
          title.tooltipText = "<?= $judul_laporan_detil ?>";

          }); // end am4core.ready()
<?php
      //============================================================================= !GRAFIK 7 Grafik Garis Range Combine
    }
    if($tabel == 8){
      //============================================================================= GRAFIK 8 Grafik Garis separate
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
      chart.data = [
      <?php
      foreach($grafik5 as $row1){
      ?>
      {

      "year": <?php echo '"'.$row1[$viewgraphic].'"'; ?>,
      <?php
      $no = 0;
      $slcgrafikgaris = (" ".$Kat_lv2." as ".$id_kat_lv2.",SUM(".$jml_item.") as ".$jml_item.",".$coun_kat_lv1.",".$coun_kat_lv2." ");
      if($periode_laporan_detil == 1){
        $kndsgrafikgaris = array($tgl_item=>$row1[$tgl_item],$ins=>$idinst);
      }
      if($periode_laporan_detil == 2){
        $kndsgrafikgaris = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$idinst);
      }
      if($periode_laporan_detil == 3){
        $kndsgrafikgaris = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],$ins=>$idinst);
      }
      if($page == 'imut'){
        $grafikgaris = $this->m_external->ambil_isi($iddet,$tabel_item,$slcgrafikgaris,$kndsgrafikgaris,$Kat_lv2);
      }else{
        $grafikgaris = $this->m_external->ambil_isi_personal($iddet,$tabel_item,$slcgrafikgaris,$kndsgrafikgaris,$Kat_lv2);
      }
      foreach($grafikgaris as $row2){
          $no++;
      ?>
      <?php echo '"'.$row2[$id_kat_lv2].'"'; ?>:<?php echo $row2[$jml_item]; ?>,
      <?php
      }
      ?>
      },
      <?php
      }
      ?>
      ];

      var categoryAxis1 = chart.xAxes.push(new am4charts.CategoryAxis());
      categoryAxis1.dataFields.category = "year";
      categoryAxis1.renderer.grid.template.location = 0;

      // Create series
      function createAxisAndSeries(field, name, opposite, bullet) {
      var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
      if(chart.yAxes.indexOf(valueAxis) != 0){
      valueAxis.syncWithAxis = chart.yAxes.getIndex(0);
      }

      var series = chart.series.push(new am4charts.LineSeries());
      series.dataFields.valueY = field;
      series.dataFields.categoryX = "year";
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
    //  valueAxis.renderer.opposite = opposite;
      valueAxis.renderer.minLabelPosition = 0.01;
      valueAxis.renderer.minGridDistance = 25;
      }

      <?php
      foreach($legendgrafik5 as $rowambil_limbah_grafik){
      $arrfaltru = array('false','true');
      $rndarrfaltru = array_rand($arrfaltru);
      $txtrfaltru = $arrfaltru[$rndarrfaltru];  

      $arrbangun = array('circle','triangle','rectangle');
      $rndarrbangun = array_rand($arrbangun);
      $txtrbangun = $arrbangun[$rndarrbangun];  

      ?>
      createAxisAndSeries(<?php echo '"'.$rowambil_limbah_grafik[$id_kat_lv2].'"'; ?>, <?php echo '"'.$rowambil_limbah_grafik[$nama_kat_lv2].'"'; ?>, <?php echo '"'.$txtrbangun.'"'; ?>);
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

      var legendContainer = am4core.create("legenddiv", am4core.Container);
      legendContainer.width = am4core.percent(100);
      legendContainer.height = am4core.percent(100);
      //chart.legend.parent = legendContainer;
      chart.legend = new am4charts.Legend();
      chart.legend.markers.template.disabled = true;
      chart.legend.labels.template.text = "[bold {color}]{name} : {valueY}[/]";
      //        chart.legend.itemContainers.template.tooltipText = "[bold {color}]{name}[/]";
      chart.legend.labels.template.maxWidth = 350;
      chart.legend.labels.template.truncate = true;
      chart.legend.fontSize = 11;
      chart.legend.scrollable = true
          chart.leftAxesContainer.layout = "vertical";
      //   chart.rightAxesContainer.layout = "vertical";
      chart.legend.labels.template.wrap = false;

      chart.exporting.menu = new am4core.ExportMenu();
      chart.exporting.menu.align = "left";
      chart.exporting.menu.verticalAlign = "top";

      var watermark = chart.createChild(am4core.Label);
      watermark.text = "Source: [bold] kredensial.web.id [/]";
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
      title.text = "<?php echo $judul_laporan_detil; ?>";
      title.fontSize = 18;
      title.tooltipText = "<?php echo $judul_laporan_detil; ?>";

      }); // end am4core.ready() 
<?php
      //============================================================================= !GRAFIK 8 Grafik Garis separate
    }
    if($tabel == 9){
      //============================================================================= GRAFIK 9 Grafik Garis
?>
          am4core.ready(function() {
            // Tabel 9
          am4core.useTheme(am4themes_animated);
          var chart = am4core.create("chartdiv", am4charts.XYChart);
          chart.data = [
          <?php
          foreach($grafik5 as $row1){
          ?>
          {

          "year": <?php echo '"'.$row1[$viewgraphic].'"'; ?>,
          <?php
          $no = 0;
          $slcgrafikgaris = (" ".$Kat_lv2." as ".$id_kat_lv2.",SUM(".$jml_item.") as ".$jml_item." ");
          if($periode_laporan_detil == 1){
            $kndsgrafikgaris = array($tgl_item=>$row1[$tgl_item],$ins=>$idinst);
          }
          if($periode_laporan_detil == 2){
            $kndsgrafikgaris = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$idinst);
          }
          if($periode_laporan_detil == 3){
            $kndsgrafikgaris = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],$ins=>$idinst);
          }
      if($page == 'imut'){
        $grafikgaris = $this->m_external->ambil_isi($iddet,$tabel_item,$slcgrafikgaris,$kndsgrafikgaris,$Kat_lv2);
      }else{
        $grafikgaris = $this->m_external->ambil_isi_personal($iddet,$tabel_item,$slcgrafikgaris,$kndsgrafikgaris,$Kat_lv2);
      }
          foreach($grafikgaris as $row2){
              $no++;
          ?>
          <?php echo '"'.$row2[$id_kat_lv2].'"'; ?>:<?php echo $row2[$jml_item]; ?>,
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

          var axisTooltip = categoryAxis.tooltip;
          axisTooltip.background.fill = am4core.color("#07BEB8");
          axisTooltip.background.strokeWidth = 0;
          axisTooltip.background.cornerRadius = 3;
          axisTooltip.background.pointerLength = 0;
          axisTooltip.dy = 5;

          var dropShadow = new am4core.DropShadowFilter();
          dropShadow.dy = 1;
          dropShadow.dx = 1;
          dropShadow.opacity = 0.5;
          axisTooltip.filters.push(dropShadow);

          // Create value axis
          var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
          valueAxis.renderer.inversed = false;
          valueAxis.title.text = "Nilai";
          valueAxis.renderer.minLabelPosition = 0.01;

          <?php
          foreach($legendgrafik5 as $row1x){
          //  $jsonxx = $this->m_umum->ambil_data('dsr_kredensial','id_dsr_kredensial',$nox);
          ?>
          // Create series
          var series<?php echo $row1x[$id_kat_lv2]; ?> = chart.series.push(new am4charts.LineSeries());
          series<?php echo $row1x[$id_kat_lv2]; ?>.dataFields.valueY = <?php echo '"'.$row1x[$id_kat_lv2].'"'; ?>;
          series<?php echo $row1x[$id_kat_lv2]; ?>.dataFields.categoryX = "year";
          series<?php echo $row1x[$id_kat_lv2]; ?>.name = <?php echo '"'.$row1x[$nama_kat_lv2].'"'; ?>;
          series<?php echo $row1x[$id_kat_lv2]; ?>.bullets.push(new am4charts.CircleBullet());
          //    series<php echo $row1x[$id_kat_lv2]; ?>.tooltipText = "{name} Tgl {categoryX} : {valueY}";
          //    series<php echo $row1x[$id_kat_lv2]; ?>.legendSettings.valueText = "{valueY}";
          series<?php echo $row1x[$id_kat_lv2]; ?>.visible  = false;

          series<?php echo $row1x[$id_kat_lv2]; ?>.strokeWidth = 3;
          series<?php echo $row1x[$id_kat_lv2]; ?>.tooltipText = "{name} - {dateX} : [b]{valueY}[/]";
          series<?php echo $row1x[$id_kat_lv2]; ?>.legendSettings.labelText = "[bold {color}]{name}[/]";
          series<?php echo $row1x[$id_kat_lv2]; ?>.legendSettings.valueText = "{valueY.close}";
          series<?php echo $row1x[$id_kat_lv2]; ?>.legendSettings.itemValueText = "[bold]{valueY}[/bold]";  

          let hs<?php echo $row1x[$id_kat_lv2]; ?> = series<?php echo $row1x[$id_kat_lv2]; ?>.segments.template.states.create("hover")
          hs<?php echo $row1x[$id_kat_lv2]; ?>.properties.strokeWidth = 5;
          series<?php echo $row1x[$id_kat_lv2]; ?>.segments.template.strokeWidth = 1;

          var circleBullet<?php echo $row1x[$id_kat_lv2]; ?> = series<?php echo $row1x[$id_kat_lv2]; ?>.bullets.push(new am4charts.CircleBullet());
          circleBullet<?php echo $row1x[$id_kat_lv2]; ?>.circle.stroke = am4core.color("#fff");
          circleBullet<?php echo $row1x[$id_kat_lv2]; ?>.circle.strokeWidth = 2;

          var labelBullet<?php echo $row1x[$id_kat_lv2]; ?> = series<?php echo $row1x[$id_kat_lv2]; ?>.bullets.push(new am4charts.LabelBullet());
          labelBullet<?php echo $row1x[$id_kat_lv2]; ?>.label.text = "{valueY}";
          labelBullet<?php echo $row1x[$id_kat_lv2]; ?>.label.dy = -20;

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
          chart.legend.markers.template.disabled = true;
          chart.legend.labels.template.text = "[bold {color}]{name} : {valueY}[/]";
          chart.legend.labels.maxWidth = 350;
          chart.legend.labels.maxHeight  = 350;
          chart.legend.labels.truncate = true;
          chart.legend.fontSize = 10;
          chart.legend.labels.template.wrap = false;
          //    chart.legend.scrollable = true
          //   chart.leftAxesContainer.layout = "horizontal";
          //   chart.leftAxesContainer.layout = "vertical";
          //   chart.rightAxesContainer.layout = "vertical";

          var legendContainer = am4core.create("legenddiv", am4core.Container);
          legendContainer.width = am4core.percent(100);
          legendContainer.height = am4core.percent(100);
          chart.legend.parent = legendContainer;
          chart.responsive.enabled = true;

          chart.exporting.menu = new am4core.ExportMenu();
          chart.exporting.menu.align = "left";
          chart.exporting.menu.verticalAlign = "top";

          var watermark = chart.createChild(am4core.Label);
          watermark.text = "Source: [bold] kredensial.web.id [/]";
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
          title.text = "<?= $judul_laporan_detil ?>";
          title.fontSize = 18;
          title.tooltipText = "<?= $judul_laporan_detil ?>";

          }); // end am4core.ready()
      <?php
      //============================================================================= !GRAFIK 9 Grafik Garis
    }
    if($tabel == 10){
      //============================================================================= GRAFIK 10 Grafik Batang
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

        categoryAxis.renderer.labels.template.rotation = -65;
        categoryAxis.renderer.minHeight = 110;

        categoryAxis.dataItems.template.text = "{realName}";
        categoryAxis.adapter.add("tooltipText", function(tooltipText, target){
          return categoryAxis.tooltipDataItem.dataContext.realName;
        })

        let label = categoryAxis.renderer.labels.template;
        label.wrap = true;
        label.maxWidth = 120;

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
            foreach($grafikbtg as $row1){        
          ?>
             <?= '"'.$row1[$nama_kat_lv1].'"' ?>: { 
              <?php
                $kndseqdet = array($tgl_item.' >='=>$tgl_awal,$tgl_item.' <='=>$tgl_akhir,$ins=>$idinst,$jml_item.' >'=>0,$Kat_lv1=>$row1[$id_kat_lv1]);
                $slceqdet = ("sum(".$jml_item.") as ".$jml_item.",".$nama_kat_lv2."");
      if($page == 'imut'){
        $tbl_eqdet = $this->m_external->ambil_isi($iddet,$tabel_item,$slceqdet,$kndseqdet,$Kat_lv2);
      }else{
       $tbl_eqdet = $this->m_external->ambil_isi_personal($iddet,$tabel_item,$slceqdet,$kndseqdet,$Kat_lv2);
      }
                
                foreach($tbl_eqdet as $row2){
              ?>
                <?= '"'.$row2[$nama_kat_lv2].'"' ?>: <?php echo $row2[$jml_item]; ?>,
              <?php
                }
              ?>
             },
          <?php
            }
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
          chart.cursor.lineX.strokeOpacity = 0;
          chart.cursor.lineY.strokeOpacity = 0;

          chart.zoomOutButton.align = "left";
          chart.zoomOutButton.valign = "bottom";
          chart.zoomOutButton.marginLeft = 10;
          chart.zoomOutButton.marginBottom = 10;

          var scrollbar = new am4charts.XYChartScrollbar();

          chart.scrollbarX = scrollbar;
          chart.legend = new am4charts.Legend();
          chart.legend.markers.template.disabled = true;
          chart.legend.labels.template.text = "[bold {color}]{realName} : {valueY}[/]";
          chart.legend.labels.maxWidth = 350;
          chart.legend.labels.maxHeight  = 350;
          chart.legend.labels.truncate = true;
          chart.legend.fontSize = 10;
          chart.legend.labels.template.wrap = false;
          //    chart.legend.scrollable = true
          //   chart.leftAxesContainer.layout = "horizontal";
          //   chart.leftAxesContainer.layout = "vertical";
          //   chart.rightAxesContainer.layout = "vertical";

          var legendContainer = am4core.create("legenddiv", am4core.Container);
          legendContainer.width = am4core.percent(100);
          legendContainer.height = am4core.percent(100);
          chart.legend.parent = legendContainer;
          chart.responsive.enabled = true;

          chart.exporting.menu = new am4core.ExportMenu();
          chart.exporting.menu.align = "left";
          chart.exporting.menu.verticalAlign = "top";

          var watermark = chart.createChild(am4core.Label);
          watermark.text = "Source: [bold] kredensial.web.id [/]";
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
          title.text = "<?= $judul_laporan_detil ?>";
          title.fontSize = 18;
          title.tooltipText = "<?= $judul_laporan_detil ?>";

        }); // end am4core.ready()
/*        am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        var chart = am4core.create("chartdiv", am4charts.XYChart);
        chart.scrollbarX = new am4core.Scrollbar();

              chart.data = [
               ?php 
                    $kndskat = array($tgl_item.' >='=>$tgl_awal,$tgl_item.' <='=>$tgl_akhir,$ins=>$idinst);
                    $grafikbtgjs = $this->m_external->ambil_isi_personal($iddet,$tabel_item,$select_semua,$kndskat);
                    foreach($grafik5 as $row1){
                ?>
                    {
                      "country":  ?php echo '"'.$row1[$tgl_item].'"'; ?>,
                      "visits": ?php echo round($row1[$jml_item],2); ?>
                    },
                ?php
                    }
                ?>
            ];

        // Create axes
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "country";
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.minGridDistance = 30;
        categoryAxis.renderer.labels.template.horizontalCenter = "right";
        categoryAxis.renderer.labels.template.verticalCenter = "middle";
        categoryAxis.renderer.labels.template.rotation = -45;
        categoryAxis.tooltip.disabled = true;
        categoryAxis.renderer.minHeight = 110;

        let label = categoryAxis.renderer.labels.template;
        label.wrap = true;
        label.maxWidth = 120;

        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.renderer.minWidth = 50;

        // Create series
        var series = chart.series.push(new am4charts.ColumnSeries());
        series.sequencedInterpolation = true;
        series.dataFields.valueY = "visits";
        series.dataFields.categoryX = "country";
        series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
        series.columns.template.strokeWidth = 0;

        series.tooltip.pointerOrientation = "vertical";

        series.columns.template.column.cornerRadiusTopLeft = 10;
        series.columns.template.column.cornerRadiusTopRight = 10;
        series.columns.template.column.fillOpacity = 0.8;

        // on hover, make corner radiuses bigger
        var hoverState = series.columns.template.column.states.create("hover");
        hoverState.properties.cornerRadiusTopLeft = 0;
        hoverState.properties.cornerRadiusTopRight = 0;
        hoverState.properties.fillOpacity = 1;

        series.columns.template.adapter.add("fill", function(fill, target) {
          return chart.colors.getIndex(target.dataItem.index);
        });

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
          chart.legend.markers.template.disabled = true;
          chart.legend.labels.template.text = "[bold {color}]{categoryX} : {valueY}[/]";
          chart.legend.labels.maxWidth = 350;
          chart.legend.labels.maxHeight  = 350;
          chart.legend.labels.truncate = true;
          chart.legend.fontSize = 10;
          chart.legend.labels.template.wrap = false;
          //    chart.legend.scrollable = true
          //   chart.leftAxesContainer.layout = "horizontal";
          //   chart.leftAxesContainer.layout = "vertical";
          //   chart.rightAxesContainer.layout = "vertical";

          var legendContainer = am4core.create("legenddiv", am4core.Container);
          legendContainer.width = am4core.percent(100);
          legendContainer.height = am4core.percent(100);
          chart.legend.parent = legendContainer;
          chart.responsive.enabled = true;

          chart.exporting.menu = new am4core.ExportMenu();
          chart.exporting.menu.align = "left";
          chart.exporting.menu.verticalAlign = "top";

          var watermark = chart.createChild(am4core.Label);
          watermark.text = "Source: [bold] kredensial.web.id [/]";
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
          title.text = "?= $judul_laporan_detil ?>";
          title.fontSize = 18;
          title.tooltipText = "?= $judul_laporan_detil ?>";

        }); // end am4core.ready()*/
<?php
      //============================================================================= !GRAFIK 10 Grafik Batang
    }
    if($tabel == 11){
      //============================================================================= GRAFIK 11 Grafik Garis Persentase
?>

<?php
      //============================================================================= !GRAFIK 11 Grafik Garis Persentase
    }
  }
}
elseif ($page=="forward")
{
?>
    <?php 
    if($idtab){
        //============================================================================= GRAFIK 3 Grafik Pie
        if($tabel == 3){
    ?>
            am4core.ready(function() {
                // Tabel 3
            am4core.useTheme(am4themes_dataviz);
            am4core.useTheme(am4themes_animated);
            var chart = am4core.create("chartdiv", am4charts.PieChart);

            chart.data = [
                <?php
                    foreach($grafikpie as $row1){
                ?>
                    {
                      "country":  <?php echo '"'.$row1[$nama_item].'"'; ?>,
                      "total": <?php echo round($row1[$jml_item],2); ?>
                    },
                <?php
                    }
                ?>
            ];

            var pieSeries = chart.series.push(new am4charts.PieSeries());
            pieSeries.dataFields.value = "total";
            pieSeries.dataFields.category = "country";
pieSeries.innerRadius = am4core.percent(50);
pieSeries.ticks.template.disabled = true;
pieSeries.labels.template.disabled = true;

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
        //    chart.legend.labels.template.maxWidth = 150;
            chart.legend.labels.template.truncate = true;   
            chart.legend.scrollable = true;
            chart.legend.parent = legendContainer;

            chart.exporting.menu = new am4core.ExportMenu();
            chart.exporting.menu.align = "left";
            chart.exporting.menu.verticalAlign = "top";

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

            chart.responsive.enabled = true;

            var title = chart.titles.create();
            title.text = "<?php echo $judul_laporan_tabel; ?>";
            title.fontSize = 18;
            title.tooltipText = "<?php echo $judul_laporan_tabel; ?>";
            });
    <?php
        }
        //============================================================================= GRAFIK 5 Grafik Garis Combine
        if($tabel == 5){
    ?>
            am4core.ready(function() {
                // Tabel 5
            am4core.useTheme(am4themes_animated);
            var chart = am4core.create("chartdiv", am4charts.XYChart);

            chart.data = [
            <?php
            foreach($grafik5 as $row1){
            ?>
            {
              "year": new Date(<?php echo $row1[$js_thn]; ?>, <?php echo $row1[$js_bln]-1; ?>, <?php echo $row1[$js_hr]; ?>),
              <?php
          if($lhu == 5){
        $subselectgrafik5 = (" ".$grup_item." as ".$id_item.",COUNT(".$sume.") as ".$jml_item." ");    
          }elseif($lhu == 7){
        $subselectgrafik5 = (" ".$id_item." as ".$id_item.",COUNT(".$sume.") as ".$jml_item." ");    
          }elseif($lhu == 8){
        $subselectgrafik5 = (" ".$id_item." as ".$id_item.",SUM(".$jml_item.") as ".$jml_item." ");     
          }else{
       $subselectgrafik5 = (" ".$grup_item." as ".$id_item.",SUM(".$jml_item.") as ".$jml_item." ");     
          }
           if($lhu == 4 || $lhu == 5){
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$id_instansi);    
          }elseif($lhu == 8){
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$idinst);    
          }else{
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$id_peg=>$pegawai,$ins=>$id_instansi);    
          } 
        $subgrafik5 = $this->m_ol_laporan->ambil_isi($idtab,$tabel_item,$subselectgrafik5,$subkondisi5,$lhu,$tgl_item,'asc',$jml_isi,$arr_isi,$jml_seting,$arr_seting,$grup_item);
              foreach($subgrafik5 as $row2){
              ?>
              <?php echo '"'.$row2[$id_item].'"'; ?>:<?php echo round($row2[$jml_item],2); ?>,
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

var axisTooltip = categoryAxis.tooltip;
axisTooltip.background.fill = am4core.color("#07BEB8");
axisTooltip.background.strokeWidth = 0;
axisTooltip.background.cornerRadius = 3;
axisTooltip.background.pointerLength = 0;
axisTooltip.dy = 5;

var dropShadow = new am4core.DropShadowFilter();
dropShadow.dy = 1;
dropShadow.dx = 1;
dropShadow.opacity = 0.5;
axisTooltip.filters.push(dropShadow);

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
series.strokeWidth = 3;
//series.tensionX = 0.7;
series.tooltipText = "{name} - {dateX} : [b]{valueY}[/]";
series.legendSettings.labelText = "[bold {color}]{name}[/]";
series.legendSettings.valueText = "{valueY.close}";
series.legendSettings.itemValueText = "[bold]{valueY}[/bold]";
          series.name = name;
        //  series.tooltipText = "{dateX}: [b]{valueY}[/]";
    //      series.strokeWidth = 2;
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
            foreach($legendgrafik5 as $rowambil_limbah_grafik){
            ?>
            createSeriesAndAxis(<?php echo '"'.$rowambil_limbah_grafik[$id_item].'"'; ?>, <?php echo '"'.$rowambil_limbah_grafik[$nama_item1].' - '.$rowambil_limbah_grafik[$nama_item2].'"'; ?>, true, true);
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
chart.legend.markers.template.disabled = true;
chart.legend.labels.template.text = "[bold {color}]{name} : {valueY}[/]";
   //         chart.legend.labels.template.text = "[bold {color}]{name}[/]";

            chart.legend.scrollable = true
        //    chart.leftAxesContainer.layout = "vertical";
            chart.rightAxesContainer.layout = "vertical"; 

            chart.exporting.menu = new am4core.ExportMenu();
            chart.exporting.menu.align = "left";
            chart.exporting.menu.verticalAlign = "top";

            var watermark = chart.createChild(am4core.Label);
            watermark.text = "Source: [bold] kredensial.web.id [/]";
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
        //============================================================================= GRAFIK 6 Grafik Garis Range separate
        if($tabel == 6){
    ?>
            am4core.ready(function() {
                // Tabel 6
            am4core.useTheme(am4themes_animated);
            var chart = am4core.create("chartdiv", am4charts.XYChart);

            chart.data = [
            <?php
            $jml_hasil_lhu = 0;
            foreach($grafikhr as $row1){
            ?>
            {
              "year": new Date(<?php echo $row1[$js_thn]; ?>, <?php echo $row1[$js_bln]-1; ?>, <?php echo $row1[$js_hr]; ?>),
              <?php
              $no = 0;
          if($lhu == 5){
        $subselectgrafik5 = (" ".$grup_item." as ".$id_item.",COUNT(".$sume.") as ".$jml_item." ");    
          }elseif($lhu == 4){
        $subselectgrafik5 = (" ".$grup_item." as ".$id_item.",".$jml_item." as ".$jml_item." ");     
          }
          elseif($lhu == 7){
        $subselectgrafik5 = (" ".$id_item." as ".$id_item.",COUNT(".$sume.") as ".$jml_item." ");    
          }elseif($lhu == 8){
        $subselectgrafik5 = (" ".$id_item." as ".$id_item.",SUM(".$jml_item.") as ".$jml_item." ");     
          }else{
       $subselectgrafik5 = (" ".$grup_item." as ".$id_item.",SUM(".$jml_item.") as ".$jml_item." ");     
          }
           if($lhu == 4 || $lhu == 5){
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$id_instansi);    
          }elseif($lhu == 8){
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$idinst);    
          }else{
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$id_peg=>$pegawai,$ins=>$id_instansi);    
          } 
        $subgrafik5 = $this->m_ol_laporan->ambil_isi($idtab,$tabel_item,$subselectgrafik5,$subkondisi5,$lhu,$tgl_item,'asc',$jml_isi,$arr_isi,$jml_seting,$arr_seting,$grup_item);
              foreach($subgrafik5 as $row2){
                $jml_hasil_lhu = $jml_hasil_lhu + $row2[$jml_item];
                  $no++;
              ?>
              <?php echo '"'.$row2[$id_item].'"'; ?>:<?php echo round($row2[$jml_item],2); ?>,
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

var axisTooltip = categoryAxis.tooltip;
axisTooltip.background.fill = am4core.color("#07BEB8");
axisTooltip.background.strokeWidth = 0;
axisTooltip.background.cornerRadius = 3;
axisTooltip.background.pointerLength = 0;
axisTooltip.dy = 5;

var dropShadow = new am4core.DropShadowFilter();
dropShadow.dy = 1;
dropShadow.dx = 1;
dropShadow.opacity = 0.5;
axisTooltip.filters.push(dropShadow);

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

series.strokeWidth = 3;
//series.tensionX = 0.7;
series.tooltipText = "{name} - {dateX} : [b]{valueY}[/]";
series.legendSettings.labelText = "[bold {color}]{name}[/]";
series.legendSettings.valueText = "{valueY.close}";
series.legendSettings.itemValueText = "[bold]{valueY}[/bold]";

/*          series.tooltipText = "{name} - {dateX} : [b]{valueY}[/]";
          series.strokeWidth = 2;*/
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

                    //  labelBullet.tooltip.label.wrap = true;
                    //  labelBullet.tooltip.label.width = 300;
          
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
            foreach($legendgrafik5 as $rowambil_limbah_grafik){
            ?>
            createSeriesAndAxis(<?php echo '"'.$rowambil_limbah_grafik[$id_item].'"'; ?>, <?php echo '"'.$rowambil_limbah_grafik[$nama_item1].' - '.$rowambil_limbah_grafik[$nama_item2].'"'; ?>, true, true);
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
chart.legend.markers.template.disabled = true;
chart.legend.labels.template.text = "[bold {color}]{name} : {valueY}[/]";
    //    chart.legend.itemContainers.template.tooltipText = "[bold {color}]{name}[/]";
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
            watermark.text = "Source: [bold] kredensial.web.id [/]";
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
        //============================================================================= GRAFIK 7 Grafik Garis Range Combine
        if($tabel == 7){
    ?>
            am4core.ready(function() {
                // Tabel 7
            am4core.useTheme(am4themes_animated);
            var chart = am4core.create("chartdiv", am4charts.XYChart);

        chart.data = [
        <?php
        foreach($grafikhr as $row1){
        ?>
        {
         "year": <?php echo '"'.$row1[$tgl_hr].'"'; ?>, //harian
          <?php
          if($lhu == 5){
        $subselectgrafik5 = (" ".$grup_item." as ".$id_item.",COUNT(".$sume.") as ".$jml_item." ");    
          }elseif($lhu == 7){
        $subselectgrafik5 = (" ".$id_item." as ".$id_item.",COUNT(".$sume.") as ".$jml_item." ");    
          }elseif($lhu == 8){
        $subselectgrafik5 = (" ".$id_item." as ".$id_item.",SUM(".$jml_item.") as ".$jml_item." ");     
          }else{
       $subselectgrafik5 = (" ".$grup_item." as ".$id_item.",SUM(".$jml_item.") as ".$jml_item." ");     
          }
           if($lhu == 4 || $lhu == 5){
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$id_instansi);    
          }elseif($lhu == 8){
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$idinst);    
          }else{
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$id_peg=>$pegawai,$ins=>$id_instansi);    
          } 
        $subgrafik5 = $this->m_ol_laporan->ambil_isi($idtab,$tabel_item,$subselectgrafik5,$subkondisi5,$lhu,$tgl_item,'asc',$jml_isi,$arr_isi,$jml_seting,$arr_seting,$grup_item);
          foreach($subgrafik5 as $row2){
          ?>
          <?php echo '"'.$row2[$id_item].'"'; ?>:<?php echo $row2[$jml_item]; ?>,
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
            //categoryAxis.fontSize = 10;

var axisTooltip = categoryAxis.tooltip;
axisTooltip.background.fill = am4core.color("#07BEB8");
axisTooltip.background.strokeWidth = 0;
axisTooltip.background.cornerRadius = 3;
axisTooltip.background.pointerLength = 0;
axisTooltip.dy = 5;

var dropShadow = new am4core.DropShadowFilter();
dropShadow.dy = 1;
dropShadow.dx = 1;
dropShadow.opacity = 0.5;
axisTooltip.filters.push(dropShadow);

            // Create value axis
            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.renderer.inversed = false;
            valueAxis.title.text = "Nilai";
            valueAxis.renderer.minLabelPosition = 0.01;
            <?php  
            if($ambil_data_min > $min_laporan_tabel){
                $plusmin = $min_laporan_tabel - 1;
            }else{
                $plusmin = $ambil_data_min - 1;
            }
            if($ambil_data_max < $max_laporan_tabel){
                 $plusmax = $max_laporan_tabel + 1;
            }else{
                 $plusmax = $ambil_data_max + 1;
            }
            ?>
            valueAxis.min = <?= $plusmin ?>;
            valueAxis.max = <?= $plusmax ?>;

            let range0 = valueAxis.axisRanges.create();
            range0.value = <?= round($min_laporan_tabel,2) ?>;
            range0.label.text = "Batas Min = <?= round($min_laporan_tabel,2) ?>";
            range0.grid.stroke = am4core.color("#ff0000");
            range0.grid.strokeWidth = 2;
            range0.grid.strokeOpacity = 1;
            range0.label.inside = true;
            range0.label.fill = range0.grid.stroke;
            range0.label.verticalCenter = "bottom";

            let range500 = valueAxis.axisRanges.create();
            range500.value = <?= round($max_laporan_tabel,2) ?>;
            range500.label.text = "Batas Max = <?= round($max_laporan_tabel,2) ?>";
            range500.grid.stroke = am4core.color("#ff0000");
            range500.grid.strokeWidth = 2;
            range500.grid.strokeOpacity = 1;
            range500.label.inside = true;
            range500.label.fill = range500.grid.stroke;
            range500.label.verticalCenter = "bottom";

            <?php
            foreach($legendgrafik5 as $row1x){
            ?>
            // Create series
            var series<?php echo $row1x[$id_item]; ?> = chart.series.push(new am4charts.LineSeries());
            series<?php echo $row1x[$id_item]; ?>.dataFields.valueY = <?php echo '"'.$row1x[$id_item].'"'; ?>;
            series<?php echo $row1x[$id_item]; ?>.dataFields.categoryX = "year";
            series<?php echo $row1x[$id_item]; ?>.name = <?php echo '"'.$row1x[$nama_item1].' - '.$row1x[$nama_item2].'"'; ?>;
            series<?php echo $row1x[$id_item]; ?>.bullets.push(new am4charts.CircleBullet());
            series<?php echo $row1x[$id_item]; ?>.visible  = false;

series<?php echo $row1x[$id_item]; ?>.strokeWidth = 3;
//     series<?php echo $row1x[$id_item]; ?>.tensionX = 0.7;
series<?php echo $row1x[$id_item]; ?>.tooltipText = "{name} - {dateX} : [b]{valueY}[/]";
series<?php echo $row1x[$id_item]; ?>.legendSettings.labelText = "[bold {color}]{name}[/]";
series<?php echo $row1x[$id_item]; ?>.legendSettings.valueText = "{valueY.close}";
series<?php echo $row1x[$id_item]; ?>.legendSettings.itemValueText = "[bold]{valueY}[/bold]";

            let hs<?php echo $row1x[$id_item]; ?> = series<?php echo $row1x[$id_item]; ?>.segments.template.states.create("hover")
            hs<?php echo $row1x[$id_item]; ?>.properties.strokeWidth = 5;
            series<?php echo $row1x[$id_item]; ?>.segments.template.strokeWidth = 1;

            var circleBullet<?php echo $row1x[$id_item]; ?> = series<?php echo $row1x[$id_item]; ?>.bullets.push(new am4charts.CircleBullet());
            circleBullet<?php echo $row1x[$id_item]; ?>.circle.stroke = am4core.color("#fff");
            circleBullet<?php echo $row1x[$id_item]; ?>.circle.strokeWidth = 2;

            var labelBullet<?php echo $row1x[$id_item]; ?> = series<?php echo $row1x[$id_item]; ?>.bullets.push(new am4charts.LabelBullet());
            labelBullet<?php echo $row1x[$id_item]; ?>.label.text = "[bold {color}]{valueY}[/]";
            labelBullet<?php echo $row1x[$id_item]; ?>.label.dy = -20;
            labelBullet<?php echo $row1x[$id_item]; ?>.fontSize = 11;

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
chart.legend.markers.template.disabled = true;
chart.legend.labels.template.text = "[bold {color}]{name} : {valueY}[/]";
        //        chart.legend.labels.template.text = "[bold {color}]{name}[/]";

                chart.legend.scrollable = true
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
                watermark.text = "Source: [bold] kredensial.web.id [/]";
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
        //============================================================================= GRAFIK 8 Grafik Garis separate
        if($tabel == 8){
    ?>
            am4core.ready(function() {
                // Tabel 8
            am4core.useTheme(am4themes_animated);
            var chart = am4core.create("chartdiv", am4charts.XYChart);

            chart.data = [
            <?php
            $jml_hasil_lhu = 0;
            foreach($grafik5 as $row1){
            ?>
            {
              "year": new Date(<?php echo $row1[$js_thn]; ?>, <?php echo $row1[$js_bln]-1; ?>, <?php echo $row1[$js_hr]; ?>),
              <?php
              $no = 0;
          if($lhu == 5){
        $subselectgrafik5 = (" ".$grup_item." as ".$id_item.",COUNT(".$sume.") as ".$jml_item." ");    
          }elseif($lhu == 7){
        $subselectgrafik5 = (" ".$id_item." as ".$id_item.",COUNT(".$sume.") as ".$jml_item." ");    
          }elseif($lhu == 8){
        $subselectgrafik5 = (" ".$id_item." as ".$id_item.",SUM(".$jml_item.") as ".$jml_item." ");     
          }else{
       $subselectgrafik5 = (" ".$grup_item." as ".$id_item.",SUM(".$jml_item.") as ".$jml_item." ");     
          }
           if($lhu == 4 || $lhu == 5){
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$id_instansi);    
          }elseif($lhu == 8){
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$idinst);    
          }else{
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$id_peg=>$pegawai,$ins=>$id_instansi);    
          }   
        $subgrafik5 = $this->m_ol_laporan->ambil_isi($idtab,$tabel_item,$subselectgrafik5,$subkondisi5,$lhu,$tgl_item,'asc',$jml_isi,$arr_isi,$jml_seting,$arr_seting,$grup_item);
              foreach($subgrafik5 as $row2){
                $jml_hasil_lhu = $jml_hasil_lhu + $row2[$jml_item];
                  $no++;
              ?>
              <?php echo '"'.$row2[$id_item].'"'; ?>:<?php echo round($row2[$jml_item],2); ?>,
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

var axisTooltip = categoryAxis.tooltip;
axisTooltip.background.fill = am4core.color("#07BEB8");
axisTooltip.background.strokeWidth = 0;
axisTooltip.background.cornerRadius = 3;
axisTooltip.background.pointerLength = 0;
axisTooltip.dy = 5;

var dropShadow = new am4core.DropShadowFilter();
dropShadow.dy = 1;
dropShadow.dx = 1;
dropShadow.opacity = 0.5;
axisTooltip.filters.push(dropShadow);

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
        //  series.strokeWidth = 2;
 series.strokeWidth = 3;
//     series.tensionX = 0.7;
series.tooltipText = "{name} - {dateX} : [b]{valueY}[/]";
series.legendSettings.labelText = "[bold {color}]{name}[/]";
series.legendSettings.valueText = "{valueY.close}";
series.legendSettings.itemValueText = "[bold]{valueY}[/bold]";       
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

                    //  labelBullet.tooltip.label.wrap = true;
                    //  labelBullet.tooltip.label.width = 300;
          
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
            foreach($legendgrafik5 as $rowambil_limbah_grafik){
            ?>
            createSeriesAndAxis(<?php echo '"'.$rowambil_limbah_grafik[$id_item].'"'; ?>, <?php echo '"'.$rowambil_limbah_grafik[$nama_item1].' - '.$rowambil_limbah_grafik[$nama_item2].'"'; ?>, true, true);
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
chart.legend.markers.template.disabled = true;
chart.legend.labels.template.text = "[bold {color}]{name} : {valueY}[/]";
//        chart.legend.itemContainers.template.tooltipText = "[bold {color}]{name}[/]";
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
            watermark.text = "Source: [bold] kredensial.web.id [/]";
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
        //============================================================================= GRAFIK 9 Grafik Garis
        if($tabel == 9){
    ?>
        am4core.ready(function() {
            // Tabel 9
        am4core.useTheme(am4themes_animated);
        var chart = am4core.create("chartdiv", am4charts.XYChart);
        chart.data = [
        <?php
        foreach($grafik5 as $row1){
        ?>
        {
    //      "year": <?php echo '"'.$row1[$tgl_hr].'"'; ?>, //harian
          "year": <?php echo '"'.$row1[$tgl_bln].'"'; ?>, //bulanan
    //      "year": <?php echo '"'.$row1[$tgl_thn].'"'; ?>, //tahunan
          <?php
          $no = 0;
          if($lhu == 5){
        $subselectgrafik5 = (" ".$grup_item." as ".$id_item.",COUNT(".$sume.") as ".$jml_item." ");    
          }elseif($lhu == 7){
        $subselectgrafik5 = (" ".$id_item." as ".$id_item.",COUNT(".$sume.") as ".$jml_item." ");    
          }elseif($lhu == 8){
        $subselectgrafik5 = (" ".$id_item." as ".$id_item.",SUM(".$jml_item.") as ".$jml_item." ");     
          }else{
       $subselectgrafik5 = (" ".$grup_item." as ".$id_item.",SUM(".$jml_item.") as ".$jml_item." ");     
          }
           if($lhu == 4 || $lhu == 5){
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$id_instansi);    
          }elseif($lhu == 8){
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$idinst);    
          }else{
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$id_peg=>$pegawai,$ins=>$id_instansi);    
          }       
        $subgrafik5 = $this->m_ol_laporan->ambil_isi($idtab,$tabel_item,$subselectgrafik5,$subkondisi5,$lhu,$tgl_item,'asc',$jml_isi,$arr_isi,$jml_seting,$arr_seting,$grup_item);
          foreach($subgrafik5 as $row2){
              $no++;
          ?>
          <?php echo '"'.$row2[$id_item].'"'; ?>:<?php echo $row2[$jml_item]; ?>,
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

var axisTooltip = categoryAxis.tooltip;
axisTooltip.background.fill = am4core.color("#07BEB8");
axisTooltip.background.strokeWidth = 0;
axisTooltip.background.cornerRadius = 3;
axisTooltip.background.pointerLength = 0;
axisTooltip.dy = 5;

var dropShadow = new am4core.DropShadowFilter();
dropShadow.dy = 1;
dropShadow.dx = 1;
dropShadow.opacity = 0.5;
axisTooltip.filters.push(dropShadow);

        // Create value axis
        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.renderer.inversed = false;
        valueAxis.title.text = "Nilai";
        valueAxis.renderer.minLabelPosition = 0.01;

        <?php
        foreach($legendgrafik5 as $row1x){
        //  $jsonxx = $this->m_umum->ambil_data('dsr_kredensial','id_dsr_kredensial',$nox);
        ?>
        // Create series
        var series<?php echo $row1x[$id_item]; ?> = chart.series.push(new am4charts.LineSeries());
        series<?php echo $row1x[$id_item]; ?>.dataFields.valueY = <?php echo '"'.$row1x[$id_item].'"'; ?>;
        series<?php echo $row1x[$id_item]; ?>.dataFields.categoryX = "year";
        series<?php echo $row1x[$id_item]; ?>.name = <?php echo '"'.$row1x[$nama_item1].' - '.$row1x[$nama_item2].'"'; ?>;
        series<?php echo $row1x[$id_item]; ?>.bullets.push(new am4charts.CircleBullet());
    //    series<?php echo $row1x[$id_item]; ?>.tooltipText = "{name} Tgl {categoryX} : {valueY}";
    //    series<?php echo $row1x[$id_item]; ?>.legendSettings.valueText = "{valueY}";
        series<?php echo $row1x[$id_item]; ?>.visible  = false;

 series<?php echo $row1x[$id_item]; ?>.strokeWidth = 3;
series<?php echo $row1x[$id_item]; ?>.tooltipText = "{name} - {dateX} : [b]{valueY}[/]";
series<?php echo $row1x[$id_item]; ?>.legendSettings.labelText = "[bold {color}]{name}[/]";
series<?php echo $row1x[$id_item]; ?>.legendSettings.valueText = "{valueY.close}";
series<?php echo $row1x[$id_item]; ?>.legendSettings.itemValueText = "[bold]{valueY}[/bold]";  

        let hs<?php echo $row1x[$id_item]; ?> = series<?php echo $row1x[$id_item]; ?>.segments.template.states.create("hover")
        hs<?php echo $row1x[$id_item]; ?>.properties.strokeWidth = 5;
        series<?php echo $row1x[$id_item]; ?>.segments.template.strokeWidth = 1;

        var circleBullet<?php echo $row1x[$id_item]; ?> = series<?php echo $row1x[$id_item]; ?>.bullets.push(new am4charts.CircleBullet());
        circleBullet<?php echo $row1x[$id_item]; ?>.circle.stroke = am4core.color("#fff");
        circleBullet<?php echo $row1x[$id_item]; ?>.circle.strokeWidth = 2;

        var labelBullet<?php echo $row1x[$id_item]; ?> = series<?php echo $row1x[$id_item]; ?>.bullets.push(new am4charts.LabelBullet());
        labelBullet<?php echo $row1x[$id_item]; ?>.label.text = "{valueY}";
        labelBullet<?php echo $row1x[$id_item]; ?>.label.dy = -20;

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
chart.legend.markers.template.disabled = true;
chart.legend.labels.template.text = "[bold {color}]{name} : {valueY}[/]";
    chart.legend.labels.maxWidth = 350;
    chart.legend.labels.maxHeight  = 350;
    chart.legend.labels.truncate = true;
    chart.legend.fontSize = 10;
    chart.legend.labels.template.wrap = false;
//    chart.legend.scrollable = true
//   chart.leftAxesContainer.layout = "horizontal";
 //   chart.leftAxesContainer.layout = "vertical";
 //   chart.rightAxesContainer.layout = "vertical";

    var legendContainer = am4core.create("legenddiv", am4core.Container);
    legendContainer.width = am4core.percent(100);
    legendContainer.height = am4core.percent(100);
    chart.legend.parent = legendContainer;
    chart.responsive.enabled = true;

    chart.exporting.menu = new am4core.ExportMenu();
    chart.exporting.menu.align = "left";
    chart.exporting.menu.verticalAlign = "top";

    var watermark = chart.createChild(am4core.Label);
    watermark.text = "Source: [bold] kredensial.web.id [/]";
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
    title.text = "<?= $judul_laporan_tabel ?>";
    title.fontSize = 18;
    title.tooltipText = "<?= $judul_laporan_tabel ?>";

    }); // end am4core.ready()
    <?php
        }
        //============================================================================= GRAFIK 10 Grafik Batang
        if($tabel == 10){
    ?>
        am4core.ready(function() {

        // Tabel 10
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        var chart = am4core.create("chartdiv", am4charts.XYChart);
        chart.scrollbarX = new am4core.Scrollbar();

            chart.data = [
                <?php
                    foreach($grafikpie as $row1){
                ?>
                    {
                      "country":  <?php echo '"'.$row1[$nama_item].'"'; ?>,
                      "visits": <?php echo round($row1[$jml_item],2); ?>
                    },
                <?php
                    }
                ?>
            ];

        // Create axes
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "country";
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.minGridDistance = 30;
        categoryAxis.renderer.labels.template.horizontalCenter = "right";
        categoryAxis.renderer.labels.template.verticalCenter = "middle";
        categoryAxis.renderer.labels.template.rotation = -45;
        categoryAxis.tooltip.disabled = true;
        categoryAxis.renderer.minHeight = 110;

        let label = categoryAxis.renderer.labels.template;
        label.wrap = true;
        label.maxWidth = 120;

        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.renderer.minWidth = 50;

        // Create series
        var series = chart.series.push(new am4charts.ColumnSeries());
        series.sequencedInterpolation = true;
        series.dataFields.valueY = "visits";
        series.dataFields.categoryX = "country";
        series.tooltipText = "[bold]{categoryX} : {valueY}[/]";
        series.columns.template.strokeWidth = 0;

        series.tooltip.pointerOrientation = "vertical";

        series.columns.template.column.cornerRadiusTopLeft = 10;
        series.columns.template.column.cornerRadiusTopRight = 10;
        series.columns.template.column.fillOpacity = 0.8;

        var bullet = series.bullets.push(new am4charts.LabelBullet())
        bullet.interactionsEnabled = false
        bullet.dy = -10;
        bullet.label.text = '[bold]{valueY}[/]'
        bullet.label.fill = am4core.color('#000000')

        // on hover, make corner radiuses bigger
        var hoverState = series.columns.template.column.states.create("hover");
        hoverState.properties.cornerRadiusTopLeft = 0;
        hoverState.properties.cornerRadiusTopRight = 0;
        hoverState.properties.fillOpacity = 1;

        series.columns.template.adapter.add("fill", function(fill, target) {
          return chart.colors.getIndex(target.dataItem.index);
        });

        // Cursor
        chart.cursor = new am4charts.XYCursor();
    chart.cursor.lineX.strokeOpacity = 0;
    chart.cursor.lineY.strokeOpacity = 0;

    chart.zoomOutButton.align = "left";
    chart.zoomOutButton.valign = "bottom";
    chart.zoomOutButton.marginLeft = 10;
    chart.zoomOutButton.marginBottom = 10;

    var scrollbar = new am4charts.XYChartScrollbar();

    chart.scrollbarX = scrollbar;

    chart.exporting.menu = new am4core.ExportMenu();
    chart.exporting.menu.align = "left";
    chart.exporting.menu.verticalAlign = "top";

    var watermark = chart.createChild(am4core.Label);
    watermark.text = "Source: [bold] kredensial.web.id [/]";
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
    title.text = "<?= $judul_laporan_tabel ?>";
    title.fontSize = 18;
    title.tooltipText = "<?= $judul_laporan_tabel ?>";

        }); // end am4core.ready()
    <?php
        }
        //============================================================================= GRAFIK 11 Grafik Batang Persentase
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
//$group_loro = array("MONTH(tgl_logbook)", $grup2);
//$period = $this->m_member->ambil_grafik_range_new($lhu,$tabel1,$select2,$konbln,$id,$group1); 
        foreach($grafik5 as $row1){                             //==================== FOREACH
            $bulan =  $this->m_rancak->getBulan(date('m',strtotime($row1[$tgl_item])));  
            $bln =  date('Y-m',strtotime($row1[$tgl_item]));
            $tahun =  date('Y',strtotime($row1[$tgl_item]));
            $join = $bulan.'   '.$tahun;
//========================================================== END PHP
?>
  {
    category: <?= '"'.$join.'"' ?>,
<?php  
//========================================================== PHP
          if($lhu == 5){
        $subselectgrafik5 = (" ".$coun_item." as ".$id_item.",COUNT(".$coun_item.") as ".$jml_item." ");    
          }elseif($lhu == 4 || $lhu == 8){
        $subselectgrafik5 = (" ".$coun_item." as ".$id_item.",SUM(".$jml_item.") as ".$jml_item." ");     
          }elseif($lhu == 7){
        $subselectgrafik5 = (" ".$id_item." as ".$id_item.",COUNT(".$sume.") as ".$jml_item." ");    
          }else{
       $subselectgrafik5 = (" ".$grup_item." as ".$id_item.",SUM(".$jml_item.") as ".$jml_item." ");     
          }
           if($lhu == 4){
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$id_instansi);    
          }elseif($lhu == 8 || $lhu == 5){
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$idinst);    
          }else{
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$id_peg=>$pegawai,$ins=>$id_instansi);    
          }       
        $subgrafik5 = $this->m_ol_laporan->ambil_isi($idtab,$tabel_item,$subselectgrafik5,$subkondisi5,$lhu,$tgl_item,'asc',$jml_isi,$arr_isi,$jml_seting,$arr_seting,$grup_item);
//$komp = $this->m_member->ambil_grafik_range_new($lhu,$tabel1,$select2,$skonbln,$id,$grup2);
foreach($subgrafik5 as $rowkomp){                                                     //==================== SUB FOREACH
//========================================================== END PHP
?>
    <?= $rowkomp[$id_item] ?>: <?= $rowkomp[$jml_item] ?>,
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
//$kp = $this->m_member->ambil_grafik_range_new($lhu,$tabel1,$select2,$konbln,$id,$grup2);
    foreach($legendgrafik5 as $rowkp){
        if($lhu == 4 || $lhu == 5 || $lhu == 8){
            $rowkp[$id_item] = $rowkp[$coun_item];
        }
?>

var series<?= $rowkp[$id_item] ?> = chart.series.push(new am4charts.ColumnSeries());
series<?= $rowkp[$id_item] ?>.columns.template.width = am4core.percent(80);
series<?= $rowkp[$id_item] ?>.columns.template.tooltipText = "{name}: {valueY}";
series<?= $rowkp[$id_item] ?>.name = <?php echo '"'.$rowkp[$nama_item1].' - '.$rowkp[$nama_item2].'"'; ?>;
series<?= $rowkp[$id_item] ?>.dataFields.categoryX = "category";
series<?= $rowkp[$id_item] ?>.dataFields.valueY = <?= '"'.$rowkp[$id_item].'"' ?>;
series<?= $rowkp[$id_item] ?>.dataFields.valueYShow = "totalPercent";
series<?= $rowkp[$id_item] ?>.dataItems.template.locations.categoryX = 0.5;
series<?= $rowkp[$id_item] ?>.stacked = true;
series<?= $rowkp[$id_item] ?>.tooltip.pointerOrientation = "vertical";

var bullet<?= $rowkp[$id_item] ?> = series<?= $rowkp[$id_item] ?>.bullets.push(new am4charts.LabelBullet());
bullet<?= $rowkp[$id_item] ?>.interactionsEnabled = false;
bullet<?= $rowkp[$id_item] ?>.label.text = "{valueY} : {valueY.totalPercent.formatNumber('#.00')}%";
//bullet<?= $rowkp[$id_item] ?>.label.truncate = true;
bullet<?= $rowkp[$id_item] ?>.label.text.wrap = true;
bullet<?= $rowkp[$id_item] ?>.label.fill = am4core.color("#ffffff");
bullet<?= $rowkp[$id_item] ?>.locationY = 0.5;


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

chart.legend = new am4charts.Legend();
chart.legend.markers.template.disabled = true;
chart.legend.labels.template.text = "[bold {color}]{name} : {valueY}[/]";
    chart.legend.labels.maxWidth = 350;
    chart.legend.labels.maxHeight  = 350;
    chart.legend.labels.truncate = true;
    chart.legend.fontSize = 10;
    chart.legend.labels.template.wrap = false;

    var legendContainer = am4core.create("legenddiv", am4core.Container);
    legendContainer.width = am4core.percent(100);
    legendContainer.height = am4core.percent(100);
    chart.legend.parent = legendContainer;
    chart.leftAxesContainer.layout = "vertical";

    chart.exporting.menu = new am4core.ExportMenu();
    chart.exporting.menu.align = "left";
    chart.exporting.menu.verticalAlign = "top";

    var watermark = chart.createChild(am4core.Label);
    watermark.text = "Source: [bold] kredensial.web.id [/]";
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
      }
    ?>
<?php
}
elseif ($page=="laporan")
{
?>
    <?php 
        //============================================================================= GRAFIK 3 Grafik Pie
        if($tabel == 3){
    ?>
            am4core.ready(function() {
                // Tabel 3
            am4core.useTheme(am4themes_dataviz);
            am4core.useTheme(am4themes_animated);
            var chart = am4core.create("chartdiv", am4charts.PieChart);

            chart.data = [
                <?php
                    foreach($grafikpie as $row1){
                ?>
                    {
                      "country":  <?php echo '"'.$row1[$nama_item].'"'; ?>,
                      "total": <?php echo round($row1[$jml_item],2); ?>
                    },
                <?php
                    }
                ?>
            ];

            var pieSeries = chart.series.push(new am4charts.PieSeries());
            pieSeries.dataFields.value = "total";
            pieSeries.dataFields.category = "country";
pieSeries.innerRadius = am4core.percent(50);
pieSeries.ticks.template.disabled = true;
pieSeries.labels.template.disabled = true;

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

/*            var legendContainer = am4core.create("legenddiv", am4core.Container);
            legendContainer.width = am4core.percent(100);
            legendContainer.height = am4core.percent(100);*/

            chart.legend = new am4charts.Legend();
            //chart.legend.labels.template.text = "[bold {color}]{category} : {value.percent.formatNumber('#.0')}% [/]";
            chart.legend.paddingTop = 0;
            chart.legend.paddingBottom = 0;
            chart.legend.fontSize = 11;
            chart.legend.wrap = true;
        //    chart.legend.labels.template.maxWidth = 150;
            chart.legend.labels.template.truncate = true;   
            chart.legend.scrollable = true;
    //        chart.legend.parent = legendContainer;

            chart.exporting.menu = new am4core.ExportMenu();
            chart.exporting.menu.align = "left";
            chart.exporting.menu.verticalAlign = "top";

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

            chart.responsive.enabled = true;

            var title = chart.titles.create();
            title.text = "<?php echo $judul_laporan_tabel; ?>";
            title.fontSize = 18;
            title.tooltipText = "<?php echo $judul_laporan_tabel; ?>";
            });
    <?php
        }
        //============================================================================= GRAFIK 5 Grafik Garis Combine
        if($tabel == 5){
    ?>
            am4core.ready(function() {
                // Tabel 5
            am4core.useTheme(am4themes_animated);
            var chart = am4core.create("chartdiv", am4charts.XYChart);

            chart.data = [
            <?php
            foreach($grafik5 as $row1){
            ?>
            {
              "year": new Date(<?php echo $row1[$js_thn]; ?>, <?php echo $row1[$js_bln]-1; ?>, <?php echo $row1[$js_hr]; ?>),
              <?php
          if($lhu == 5){
        $subselectgrafik5 = (" ".$grup_item." as ".$id_item.",COUNT(".$sume.") as ".$jml_item." ");    
          }elseif($lhu == 7){
        $subselectgrafik5 = (" ".$id_item." as ".$id_item.",COUNT(".$sume.") as ".$jml_item." ");    
          }elseif($lhu == 8){
        $subselectgrafik5 = (" ".$id_item." as ".$id_item.",SUM(".$jml_item.") as ".$jml_item." ");     
          }else{
       $subselectgrafik5 = (" ".$grup_item." as ".$id_item.",SUM(".$jml_item.") as ".$jml_item." ");     
          }
           if($lhu == 4 || $lhu == 5){
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$id_instansi);    
          }elseif($lhu == 8){
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$idinst);    
          }else{
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$id_peg=>$pegawai,$ins=>$id_instansi);    
          } 
        $subgrafik5 = $this->m_ol_laporan->ambil_isi($idtab,$tabel_item,$subselectgrafik5,$subkondisi5,$lhu,$tgl_item,'asc',$grup_item);
              foreach($subgrafik5 as $row2){
              ?>
              <?php echo '"'.$row2[$id_item].'"'; ?>:<?php echo round($row2[$jml_item],2); ?>,
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

var axisTooltip = categoryAxis.tooltip;
axisTooltip.background.fill = am4core.color("#07BEB8");
axisTooltip.background.strokeWidth = 0;
axisTooltip.background.cornerRadius = 3;
axisTooltip.background.pointerLength = 0;
axisTooltip.dy = 5;

var dropShadow = new am4core.DropShadowFilter();
dropShadow.dy = 1;
dropShadow.dx = 1;
dropShadow.opacity = 0.5;
axisTooltip.filters.push(dropShadow);

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
series.strokeWidth = 3;
//series.tensionX = 0.7;
series.tooltipText = "{name} - {dateX} : [b]{valueY}[/]";
series.legendSettings.labelText = "[bold {color}]{name}[/]";
series.legendSettings.valueText = "{valueY.close}";
series.legendSettings.itemValueText = "[bold]{valueY}[/bold]";
          series.name = name;
        //  series.tooltipText = "{dateX}: [b]{valueY}[/]";
    //      series.strokeWidth = 2;
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
            foreach($legendgrafik5 as $rowambil_limbah_grafik){
            ?>
            createSeriesAndAxis(<?php echo '"'.$rowambil_limbah_grafik[$id_item].'"'; ?>, <?php echo '"'.$rowambil_limbah_grafik[$nama_item1].' - '.$rowambil_limbah_grafik[$nama_item2].'"'; ?>, true, true);
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
chart.legend.markers.template.disabled = true;
chart.legend.labels.template.text = "[bold {color}]{name} : {valueY}[/]";
   //         chart.legend.labels.template.text = "[bold {color}]{name}[/]";

            chart.legend.scrollable = true
        //    chart.leftAxesContainer.layout = "vertical";
            chart.rightAxesContainer.layout = "vertical"; 

            chart.exporting.menu = new am4core.ExportMenu();
            chart.exporting.menu.align = "left";
            chart.exporting.menu.verticalAlign = "top";

            var watermark = chart.createChild(am4core.Label);
            watermark.text = "Source: [bold] kredensial.web.id [/]";
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
        //============================================================================= GRAFIK 6 Grafik Garis Range separate
        if($tabel == 6){
    ?>
            am4core.ready(function() {
                // Tabel 6
            am4core.useTheme(am4themes_animated);
            var chart = am4core.create("chartdiv", am4charts.XYChart);

            chart.data = [
            <?php
            $jml_hasil_lhu = 0;
            foreach($grafikhr as $row1){
            ?>
            {
              "year": new Date(<?php echo $row1[$js_thn]; ?>, <?php echo $row1[$js_bln]-1; ?>, <?php echo $row1[$js_hr]; ?>),
              <?php
              $no = 0;
          if($lhu == 5){
        $subselectgrafik5 = (" ".$grup_item." as ".$id_item.",COUNT(".$sume.") as ".$jml_item." ");    
          }elseif($lhu == 7){
        $subselectgrafik5 = (" ".$id_item." as ".$id_item.",COUNT(".$sume.") as ".$jml_item." ");    
          }elseif($lhu == 8){
        $subselectgrafik5 = (" ".$id_item." as ".$id_item.",SUM(".$jml_item.") as ".$jml_item." ");     
          }else{
       $subselectgrafik5 = (" ".$grup_item." as ".$id_item.",SUM(".$jml_item.") as ".$jml_item." ");     
          }
           if($lhu == 4 || $lhu == 5){
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$id_instansi);    
          }elseif($lhu == 8){
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$idinst);    
          }else{
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$id_peg=>$pegawai,$ins=>$id_instansi);    
          } 
        $subgrafik5 = $this->m_ol_laporan->ambil_isi($idtab,$tabel_item,$subselectgrafik5,$subkondisi5,$lhu,$tgl_item,'asc',$grup_item);
              foreach($subgrafik5 as $row2){
                $jml_hasil_lhu = $jml_hasil_lhu + $row2[$jml_item];
                  $no++;
              ?>
              <?php echo '"'.$row2[$id_item].'"'; ?>:<?php echo round($row2[$jml_item],2); ?>,
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

var axisTooltip = categoryAxis.tooltip;
axisTooltip.background.fill = am4core.color("#07BEB8");
axisTooltip.background.strokeWidth = 0;
axisTooltip.background.cornerRadius = 3;
axisTooltip.background.pointerLength = 0;
axisTooltip.dy = 5;

var dropShadow = new am4core.DropShadowFilter();
dropShadow.dy = 1;
dropShadow.dx = 1;
dropShadow.opacity = 0.5;
axisTooltip.filters.push(dropShadow);

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

series.strokeWidth = 3;
//series.tensionX = 0.7;
series.tooltipText = "{name} - {dateX} : [b]{valueY}[/]";
series.legendSettings.labelText = "[bold {color}]{name}[/]";
series.legendSettings.valueText = "{valueY.close}";
series.legendSettings.itemValueText = "[bold]{valueY}[/bold]";

/*          series.tooltipText = "{name} - {dateX} : [b]{valueY}[/]";
          series.strokeWidth = 2;*/
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

                    //  labelBullet.tooltip.label.wrap = true;
                    //  labelBullet.tooltip.label.width = 300;
          
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
            foreach($legendgrafik5 as $rowambil_limbah_grafik){
            ?>
            createSeriesAndAxis(<?php echo '"'.$rowambil_limbah_grafik[$id_item].'"'; ?>, <?php echo '"'.$rowambil_limbah_grafik[$nama_item1].' - '.$rowambil_limbah_grafik[$nama_item2].'"'; ?>, true, true);
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

/*        var legendContainer = am4core.create("legenddiv", am4core.Container);
        legendContainer.width = am4core.percent(100);
        legendContainer.height = am4core.percent(100);
        //chart.legend.parent = legendContainer;*/
            chart.legend = new am4charts.Legend();
          //  chart.legend.labels.template.text = "[bold {color}]{name}[/]";
chart.legend.markers.template.disabled = true;
chart.legend.labels.template.text = "[bold {color}]{name} : {valueY}[/]";
    //    chart.legend.itemContainers.template.tooltipText = "[bold {color}]{name}[/]";
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
            watermark.text = "Source: [bold] kredensial.web.id [/]";
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
        //============================================================================= GRAFIK 7 Grafik Garis Range Combine
        if($tabel == 7){
    ?>
            am4core.ready(function() {
                // Tabel 7
            am4core.useTheme(am4themes_animated);
            var chart = am4core.create("chartdiv", am4charts.XYChart);

        chart.data = [
        <?php
        foreach($grafikhr as $row1){
        ?>
        {
         "year": <?php echo '"'.$row1[$tgl_hr].'"'; ?>, //harian
          <?php
          if($lhu == 5){
        $subselectgrafik5 = (" ".$grup_item." as ".$id_item.",COUNT(".$sume.") as ".$jml_item." ");    
          }elseif($lhu == 7){
        $subselectgrafik5 = (" ".$id_item." as ".$id_item.",COUNT(".$sume.") as ".$jml_item." ");    
          }elseif($lhu == 8){
        $subselectgrafik5 = (" ".$id_item." as ".$id_item.",SUM(".$jml_item.") as ".$jml_item." ");     
          }else{
       $subselectgrafik5 = (" ".$grup_item." as ".$id_item.",SUM(".$jml_item.") as ".$jml_item." ");     
          }
           if($lhu == 4 || $lhu == 5){
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$id_instansi);    
          }elseif($lhu == 8){
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$idinst);    
          }else{
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$id_peg=>$pegawai,$ins=>$id_instansi);    
          } 
        $subgrafik5 = $this->m_ol_laporan->ambil_isi($idtab,$tabel_item,$subselectgrafik5,$subkondisi5,$lhu,$tgl_item,'asc',$grup_item);
          foreach($subgrafik5 as $row2){
          ?>
          <?php echo '"'.$row2[$id_item].'"'; ?>:<?php echo $row2[$jml_item]; ?>,
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
            //categoryAxis.fontSize = 10;

var axisTooltip = categoryAxis.tooltip;
axisTooltip.background.fill = am4core.color("#07BEB8");
axisTooltip.background.strokeWidth = 0;
axisTooltip.background.cornerRadius = 3;
axisTooltip.background.pointerLength = 0;
axisTooltip.dy = 5;

var dropShadow = new am4core.DropShadowFilter();
dropShadow.dy = 1;
dropShadow.dx = 1;
dropShadow.opacity = 0.5;
axisTooltip.filters.push(dropShadow);

            // Create value axis
            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.renderer.inversed = false;
            valueAxis.title.text = "Nilai";
            valueAxis.renderer.minLabelPosition = 0.01;
            <?php  
            if($ambil_data_min > $min_laporan_tabel){
                $plusmin = $min_laporan_tabel - 1;
            }else{
                $plusmin = $ambil_data_min - 1;
            }
            if($ambil_data_max < $max_laporan_tabel){
                 $plusmax = $max_laporan_tabel + 1;
            }else{
                 $plusmax = $ambil_data_max + 1;
            }
            ?>
            valueAxis.min = <?= $plusmin ?>;
            valueAxis.max = <?= $plusmax ?>;

            let range0 = valueAxis.axisRanges.create();
            range0.value = <?= round($min_laporan_tabel,2) ?>;
            range0.label.text = "Batas Min = <?= round($min_laporan_tabel,2) ?>";
            range0.grid.stroke = am4core.color("#ff0000");
            range0.grid.strokeWidth = 2;
            range0.grid.strokeOpacity = 1;
            range0.label.inside = true;
            range0.label.fill = range0.grid.stroke;
            range0.label.verticalCenter = "bottom";

            let range500 = valueAxis.axisRanges.create();
            range500.value = <?= round($max_laporan_tabel,2) ?>;
            range500.label.text = "Batas Max = <?= round($max_laporan_tabel,2) ?>";
            range500.grid.stroke = am4core.color("#ff0000");
            range500.grid.strokeWidth = 2;
            range500.grid.strokeOpacity = 1;
            range500.label.inside = true;
            range500.label.fill = range500.grid.stroke;
            range500.label.verticalCenter = "bottom";

            <?php
            foreach($legendgrafik5 as $row1x){
            ?>
            // Create series
            var series<?php echo $row1x[$id_item]; ?> = chart.series.push(new am4charts.LineSeries());
            series<?php echo $row1x[$id_item]; ?>.dataFields.valueY = <?php echo '"'.$row1x[$id_item].'"'; ?>;
            series<?php echo $row1x[$id_item]; ?>.dataFields.categoryX = "year";
            series<?php echo $row1x[$id_item]; ?>.name = <?php echo '"'.$row1x[$nama_item1].' - '.$row1x[$nama_item2].'"'; ?>;
            series<?php echo $row1x[$id_item]; ?>.bullets.push(new am4charts.CircleBullet());
            series<?php echo $row1x[$id_item]; ?>.visible  = false;

series<?php echo $row1x[$id_item]; ?>.strokeWidth = 3;
//     series<?php echo $row1x[$id_item]; ?>.tensionX = 0.7;
series<?php echo $row1x[$id_item]; ?>.tooltipText = "{name} - {dateX} : [b]{valueY}[/]";
series<?php echo $row1x[$id_item]; ?>.legendSettings.labelText = "[bold {color}]{name}[/]";
series<?php echo $row1x[$id_item]; ?>.legendSettings.valueText = "{valueY.close}";
series<?php echo $row1x[$id_item]; ?>.legendSettings.itemValueText = "[bold]{valueY}[/bold]";

            let hs<?php echo $row1x[$id_item]; ?> = series<?php echo $row1x[$id_item]; ?>.segments.template.states.create("hover")
            hs<?php echo $row1x[$id_item]; ?>.properties.strokeWidth = 5;
            series<?php echo $row1x[$id_item]; ?>.segments.template.strokeWidth = 1;

            var circleBullet<?php echo $row1x[$id_item]; ?> = series<?php echo $row1x[$id_item]; ?>.bullets.push(new am4charts.CircleBullet());
            circleBullet<?php echo $row1x[$id_item]; ?>.circle.stroke = am4core.color("#fff");
            circleBullet<?php echo $row1x[$id_item]; ?>.circle.strokeWidth = 2;

            var labelBullet<?php echo $row1x[$id_item]; ?> = series<?php echo $row1x[$id_item]; ?>.bullets.push(new am4charts.LabelBullet());
            labelBullet<?php echo $row1x[$id_item]; ?>.label.text = "[bold {color}]{valueY}[/]";
            labelBullet<?php echo $row1x[$id_item]; ?>.label.dy = -20;
            labelBullet<?php echo $row1x[$id_item]; ?>.fontSize = 11;

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
chart.legend.markers.template.disabled = true;
chart.legend.labels.template.text = "[bold {color}]{name} : {valueY}[/]";
        //        chart.legend.labels.template.text = "[bold {color}]{name}[/]";

                chart.legend.scrollable = true
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
                watermark.text = "Source: [bold] kredensial.web.id [/]";
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
        //============================================================================= GRAFIK 8 Grafik Garis separate
        if($tabel == 8){
    ?>
            am4core.ready(function() {
                // Tabel 8
            am4core.useTheme(am4themes_animated);
            var chart = am4core.create("chartdiv", am4charts.XYChart);

            chart.data = [
            <?php
            $jml_hasil_lhu = 0;
            foreach($grafik5 as $row1){
            ?>
            {
              "year": new Date(<?php echo $row1[$js_thn]; ?>, <?php echo $row1[$js_bln]-1; ?>, <?php echo $row1[$js_hr]; ?>),
              <?php
              $no = 0;
          if($lhu == 5){
        $subselectgrafik5 = (" ".$grup_item." as ".$id_item.",COUNT(".$sume.") as ".$jml_item." ");    
          }elseif($lhu == 7){
        $subselectgrafik5 = (" ".$id_item." as ".$id_item.",COUNT(".$sume.") as ".$jml_item." ");    
          }elseif($lhu == 8){
        $subselectgrafik5 = (" ".$id_item." as ".$id_item.",SUM(".$jml_item.") as ".$jml_item." ");     
          }else{
       $subselectgrafik5 = (" ".$grup_item." as ".$id_item.",SUM(".$jml_item.") as ".$jml_item." ");     
          }
           if($lhu == 4 || $lhu == 5){
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$id_instansi);    
          }elseif($lhu == 8){
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$idinst);    
          }else{
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$id_peg=>$pegawai,$ins=>$id_instansi);    
          }   
        $subgrafik5 = $this->m_ol_laporan->ambil_isi($idtab,$tabel_item,$subselectgrafik5,$subkondisi5,$lhu,$tgl_item,'asc',$grup_item);
              foreach($subgrafik5 as $row2){
                $jml_hasil_lhu = $jml_hasil_lhu + $row2[$jml_item];
                  $no++;
              ?>
              <?php echo '"'.$row2[$id_item].'"'; ?>:<?php echo round($row2[$jml_item],2); ?>,
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

var axisTooltip = categoryAxis.tooltip;
axisTooltip.background.fill = am4core.color("#07BEB8");
axisTooltip.background.strokeWidth = 0;
axisTooltip.background.cornerRadius = 3;
axisTooltip.background.pointerLength = 0;
axisTooltip.dy = 5;

var dropShadow = new am4core.DropShadowFilter();
dropShadow.dy = 1;
dropShadow.dx = 1;
dropShadow.opacity = 0.5;
axisTooltip.filters.push(dropShadow);

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
        //  series.strokeWidth = 2;
 series.strokeWidth = 3;
//     series.tensionX = 0.7;
series.tooltipText = "{name} - {dateX} : [b]{valueY}[/]";
series.legendSettings.labelText = "[bold {color}]{name}[/]";
series.legendSettings.valueText = "{valueY.close}";
series.legendSettings.itemValueText = "[bold]{valueY}[/bold]";       
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

                    //  labelBullet.tooltip.label.wrap = true;
                    //  labelBullet.tooltip.label.width = 300;
          
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
            foreach($legendgrafik5 as $rowambil_limbah_grafik){
            ?>
            createSeriesAndAxis(<?php echo '"'.$rowambil_limbah_grafik[$id_item].'"'; ?>, <?php echo '"'.$rowambil_limbah_grafik[$nama_item1].' - '.$rowambil_limbah_grafik[$nama_item2].'"'; ?>, true, true);
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

/*        var legendContainer = am4core.create("legenddiv", am4core.Container);
        legendContainer.width = am4core.percent(100);
        legendContainer.height = am4core.percent(100);
        //chart.legend.parent = legendContainer;*/
            chart.legend = new am4charts.Legend();
chart.legend.markers.template.disabled = true;
chart.legend.labels.template.text = "[bold {color}]{name} : {valueY}[/]";
//        chart.legend.itemContainers.template.tooltipText = "[bold {color}]{name}[/]";
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
            watermark.text = "Source: [bold] kredensial.web.id [/]";
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
        //============================================================================= GRAFIK 9 Grafik Garis
        if($tabel == 9){
    ?>
        am4core.ready(function() {
            // Tabel 9
        am4core.useTheme(am4themes_animated);
        var chart = am4core.create("chartdiv", am4charts.XYChart);
        chart.data = [
        <?php
        foreach($grafik5 as $row1){
        ?>
        {
    //      "year": <?php echo '"'.$row1[$tgl_hr].'"'; ?>, //harian
          "year": <?php echo '"'.$row1[$tgl_bln].'"'; ?>, //bulanan
    //      "year": <?php echo '"'.$row1[$tgl_thn].'"'; ?>, //tahunan
          <?php
          $no = 0;
          if($lhu == 5){
        $subselectgrafik5 = (" ".$grup_item." as ".$id_item.",COUNT(".$sume.") as ".$jml_item." ");    
          }elseif($lhu == 7){
        $subselectgrafik5 = (" ".$id_item." as ".$id_item.",COUNT(".$sume.") as ".$jml_item." ");    
          }elseif($lhu == 8){
        $subselectgrafik5 = (" ".$id_item." as ".$id_item.",SUM(".$jml_item.") as ".$jml_item." ");     
          }else{
       $subselectgrafik5 = (" ".$grup_item." as ".$id_item.",SUM(".$jml_item.") as ".$jml_item." ");     
          }
           if($lhu == 4 || $lhu == 5){
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$id_instansi);    
          }elseif($lhu == 8){
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$idinst);    
          }else{
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$id_peg=>$pegawai,$ins=>$id_instansi);    
          }       
        $subgrafik5 = $this->m_ol_laporan->ambil_isi($idtab,$tabel_item,$subselectgrafik5,$subkondisi5,$lhu,$tgl_item,'asc',$grup_item);
          foreach($subgrafik5 as $row2){
              $no++;
          ?>
          <?php echo '"'.$row2[$id_item].'"'; ?>:<?php echo $row2[$jml_item]; ?>,
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

var axisTooltip = categoryAxis.tooltip;
axisTooltip.background.fill = am4core.color("#07BEB8");
axisTooltip.background.strokeWidth = 0;
axisTooltip.background.cornerRadius = 3;
axisTooltip.background.pointerLength = 0;
axisTooltip.dy = 5;

var dropShadow = new am4core.DropShadowFilter();
dropShadow.dy = 1;
dropShadow.dx = 1;
dropShadow.opacity = 0.5;
axisTooltip.filters.push(dropShadow);

        // Create value axis
        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.renderer.inversed = false;
        valueAxis.title.text = "Nilai";
        valueAxis.renderer.minLabelPosition = 0.01;

        <?php
        foreach($legendgrafik5 as $row1x){
        //  $jsonxx = $this->m_umum->ambil_data('dsr_kredensial','id_dsr_kredensial',$nox);
        ?>
        // Create series
        var series<?php echo $row1x[$id_item]; ?> = chart.series.push(new am4charts.LineSeries());
        series<?php echo $row1x[$id_item]; ?>.dataFields.valueY = <?php echo '"'.$row1x[$id_item].'"'; ?>;
        series<?php echo $row1x[$id_item]; ?>.dataFields.categoryX = "year";
        series<?php echo $row1x[$id_item]; ?>.name = <?php echo '"'.$row1x[$nama_item1].' - '.$row1x[$nama_item2].'"'; ?>;
        series<?php echo $row1x[$id_item]; ?>.bullets.push(new am4charts.CircleBullet());
    //    series<?php echo $row1x[$id_item]; ?>.tooltipText = "{name} Tgl {categoryX} : {valueY}";
    //    series<?php echo $row1x[$id_item]; ?>.legendSettings.valueText = "{valueY}";
        series<?php echo $row1x[$id_item]; ?>.visible  = false;

 series<?php echo $row1x[$id_item]; ?>.strokeWidth = 3;
series<?php echo $row1x[$id_item]; ?>.tooltipText = "{name} - {dateX} : [b]{valueY}[/]";
series<?php echo $row1x[$id_item]; ?>.legendSettings.labelText = "[bold {color}]{name}[/]";
series<?php echo $row1x[$id_item]; ?>.legendSettings.valueText = "{valueY.close}";
series<?php echo $row1x[$id_item]; ?>.legendSettings.itemValueText = "[bold]{valueY}[/bold]";  

        let hs<?php echo $row1x[$id_item]; ?> = series<?php echo $row1x[$id_item]; ?>.segments.template.states.create("hover")
        hs<?php echo $row1x[$id_item]; ?>.properties.strokeWidth = 5;
        series<?php echo $row1x[$id_item]; ?>.segments.template.strokeWidth = 1;

        var circleBullet<?php echo $row1x[$id_item]; ?> = series<?php echo $row1x[$id_item]; ?>.bullets.push(new am4charts.CircleBullet());
        circleBullet<?php echo $row1x[$id_item]; ?>.circle.stroke = am4core.color("#fff");
        circleBullet<?php echo $row1x[$id_item]; ?>.circle.strokeWidth = 2;

        var labelBullet<?php echo $row1x[$id_item]; ?> = series<?php echo $row1x[$id_item]; ?>.bullets.push(new am4charts.LabelBullet());
        labelBullet<?php echo $row1x[$id_item]; ?>.label.text = "{valueY}";
        labelBullet<?php echo $row1x[$id_item]; ?>.label.dy = -20;

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
chart.legend.markers.template.disabled = true;
chart.legend.labels.template.text = "[bold {color}]{name} : {valueY}[/]";
    chart.legend.labels.maxWidth = 350;
    chart.legend.labels.maxHeight  = 350;
    chart.legend.labels.truncate = true;
    chart.legend.fontSize = 10;
    chart.legend.labels.template.wrap = false;
//    chart.legend.scrollable = true
//   chart.leftAxesContainer.layout = "horizontal";
 //   chart.leftAxesContainer.layout = "vertical";
 //   chart.rightAxesContainer.layout = "vertical";

/*    var legendContainer = am4core.create("legenddiv", am4core.Container);
    legendContainer.width = am4core.percent(100);
    legendContainer.height = am4core.percent(100);
    chart.legend.parent = legendContainer;*/
    chart.responsive.enabled = true;

    chart.exporting.menu = new am4core.ExportMenu();
    chart.exporting.menu.align = "left";
    chart.exporting.menu.verticalAlign = "top";

    var watermark = chart.createChild(am4core.Label);
    watermark.text = "Source: [bold] kredensial.web.id [/]";
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
    title.text = "<?= $judul_laporan_tabel ?>";
    title.fontSize = 18;
    title.tooltipText = "<?= $judul_laporan_tabel ?>";

    }); // end am4core.ready()
    <?php
        }
        //============================================================================= GRAFIK 10 Grafik Batang
        if($tabel == 10){
    ?>
        am4core.ready(function() {

        // Tabel 10
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        var chart = am4core.create("chartdiv", am4charts.XYChart);
        chart.scrollbarX = new am4core.Scrollbar();

            chart.data = [
                <?php
                    foreach($grafikpie as $row1){
                ?>
                    {
                      "country":  <?php echo '"'.$row1[$nama_item].'"'; ?>,
                      "visits": <?php echo round($row1[$jml_item],2); ?>
                    },
                <?php
                    }
                ?>
            ];

        // Create axes
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "country";
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.minGridDistance = 30;
        categoryAxis.renderer.labels.template.horizontalCenter = "right";
        categoryAxis.renderer.labels.template.verticalCenter = "middle";
        categoryAxis.renderer.labels.template.rotation = -45;
        categoryAxis.tooltip.disabled = true;
        categoryAxis.renderer.minHeight = 110;

        let label = categoryAxis.renderer.labels.template;
        label.wrap = true;
        label.maxWidth = 120;

        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.renderer.minWidth = 50;

        // Create series
        var series = chart.series.push(new am4charts.ColumnSeries());
        series.sequencedInterpolation = true;
        series.dataFields.valueY = "visits";
        series.dataFields.categoryX = "country";
        series.tooltipText = "[bold]{categoryX} : {valueY}[/]";
        series.columns.template.strokeWidth = 0;

        series.tooltip.pointerOrientation = "vertical";

        series.columns.template.column.cornerRadiusTopLeft = 10;
        series.columns.template.column.cornerRadiusTopRight = 10;
        series.columns.template.column.fillOpacity = 0.8;

        var bullet = series.bullets.push(new am4charts.LabelBullet())
        bullet.interactionsEnabled = false
        bullet.dy = -10;
        bullet.label.text = '[bold]{valueY}[/]'
        bullet.label.fill = am4core.color('#000000')

        // on hover, make corner radiuses bigger
        var hoverState = series.columns.template.column.states.create("hover");
        hoverState.properties.cornerRadiusTopLeft = 0;
        hoverState.properties.cornerRadiusTopRight = 0;
        hoverState.properties.fillOpacity = 1;

        series.columns.template.adapter.add("fill", function(fill, target) {
          return chart.colors.getIndex(target.dataItem.index);
        });

        // Cursor
        chart.cursor = new am4charts.XYCursor();
    chart.cursor.lineX.strokeOpacity = 0;
    chart.cursor.lineY.strokeOpacity = 0;

    chart.zoomOutButton.align = "left";
    chart.zoomOutButton.valign = "bottom";
    chart.zoomOutButton.marginLeft = 10;
    chart.zoomOutButton.marginBottom = 10;

chart.legend = new am4charts.Legend();
chart.legend.markers.template.disabled = true;
chart.legend.labels.template.text = "[bold {color}]{name} : {valueY}[/]";
    chart.legend.labels.maxWidth = 350;
    chart.legend.labels.maxHeight  = 350;
    chart.legend.labels.truncate = true;
    chart.legend.fontSize = 10;
    chart.legend.labels.template.wrap = false;

    var scrollbar = new am4charts.XYChartScrollbar();

    chart.scrollbarX = scrollbar;

    chart.exporting.menu = new am4core.ExportMenu();
    chart.exporting.menu.align = "left";
    chart.exporting.menu.verticalAlign = "top";

    var watermark = chart.createChild(am4core.Label);
    watermark.text = "Source: [bold] kredensial.web.id [/]";
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
    title.text = "<?= $judul_laporan_tabel ?>";
    title.fontSize = 18;
    title.tooltipText = "<?= $judul_laporan_tabel ?>";

        }); // end am4core.ready()
    <?php
        }
        //============================================================================= GRAFIK 11 Grafik Batang %
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
//$group_loro = array("MONTH(tgl_logbook)", $grup2);
//$period = $this->m_member->ambil_grafik_range_new($lhu,$tabel1,$select2,$konbln,$id,$group1); 
        foreach($grafik5 as $row1){                             //==================== FOREACH
            $bulan =  $this->m_rancak->getBulan(date('m',strtotime($row1[$tgl_item])));  
            $bln =  date('Y-m',strtotime($row1[$tgl_item]));
            $tahun =  date('Y',strtotime($row1[$tgl_item]));
            $join = $bulan.'   '.$tahun;
//========================================================== END PHP
?>
  {
    category: <?= '"'.$join.'"' ?>,
<?php  
//========================================================== PHP
          if($lhu == 5){
        $subselectgrafik5 = (" ".$coun_item." as ".$id_item.",COUNT(".$coun_item.") as ".$jml_item." ");    
          }elseif($lhu == 4 || $lhu == 8){
        $subselectgrafik5 = (" ".$coun_item." as ".$id_item.",SUM(".$jml_item.") as ".$jml_item." ");     
          }elseif($lhu == 7){
        $subselectgrafik5 = (" ".$id_item." as ".$id_item.",COUNT(".$sume.") as ".$jml_item." ");    
          }else{
       $subselectgrafik5 = (" ".$grup_item." as ".$id_item.",SUM(".$jml_item.") as ".$jml_item." ");     
          }
           if($lhu == 4){
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$id_instansi);    
          }elseif($lhu == 8 || $lhu == 5){
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$idinst);    
          }else{
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$id_peg=>$pegawai,$ins=>$id_instansi);    
          }       
        $subgrafik5 = $this->m_ol_laporan->ambil_isi($idtab,$tabel_item,$subselectgrafik5,$subkondisi5,$lhu,$tgl_item,'asc',$grup_item);
//$komp = $this->m_member->ambil_grafik_range_new($lhu,$tabel1,$select2,$skonbln,$id,$grup2);
foreach($subgrafik5 as $rowkomp){                                                     //==================== SUB FOREACH
//========================================================== END PHP
?>
    <?= $rowkomp[$id_item] ?>: <?= $rowkomp[$jml_item] ?>,
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
//$kp = $this->m_member->ambil_grafik_range_new($lhu,$tabel1,$select2,$konbln,$id,$grup2);
    foreach($legendgrafik5 as $rowkp){
        if($lhu == 4 || $lhu == 5 || $lhu == 8){
            $rowkp[$id_item] = $rowkp[$coun_item];
        }
?>

var series<?= $rowkp[$id_item] ?> = chart.series.push(new am4charts.ColumnSeries());
series<?= $rowkp[$id_item] ?>.columns.template.width = am4core.percent(80);
series<?= $rowkp[$id_item] ?>.columns.template.tooltipText = "{name}: {valueY}";
series<?= $rowkp[$id_item] ?>.name = <?php echo '"'.$rowkp[$nama_item1].' - '.$rowkp[$nama_item2].'"'; ?>;
series<?= $rowkp[$id_item] ?>.dataFields.categoryX = "category";
series<?= $rowkp[$id_item] ?>.dataFields.valueY = <?= '"'.$rowkp[$id_item].'"' ?>;
series<?= $rowkp[$id_item] ?>.dataFields.valueYShow = "totalPercent";
series<?= $rowkp[$id_item] ?>.dataItems.template.locations.categoryX = 0.5;
series<?= $rowkp[$id_item] ?>.stacked = true;
series<?= $rowkp[$id_item] ?>.tooltip.pointerOrientation = "vertical";

var bullet<?= $rowkp[$id_item] ?> = series<?= $rowkp[$id_item] ?>.bullets.push(new am4charts.LabelBullet());
bullet<?= $rowkp[$id_item] ?>.interactionsEnabled = false;
bullet<?= $rowkp[$id_item] ?>.label.text = "{valueY} : {valueY.totalPercent.formatNumber('#.00')}%";
//bullet<?= $rowkp[$id_item] ?>.label.truncate = true;
bullet<?= $rowkp[$id_item] ?>.label.text.wrap = true;
bullet<?= $rowkp[$id_item] ?>.label.fill = am4core.color("#ffffff");
bullet<?= $rowkp[$id_item] ?>.locationY = 0.5;


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

chart.legend = new am4charts.Legend();
chart.legend.markers.template.disabled = true;
chart.legend.labels.template.text = "[bold {color}]{name} : {valueY}[/]";
    chart.legend.labels.maxWidth = 350;
    chart.legend.labels.maxHeight  = 350;
    chart.legend.labels.truncate = true;
    chart.legend.fontSize = 10;
    chart.legend.labels.template.wrap = false;

/*    var legendContainer = am4core.create("legenddiv", am4core.Container);
    legendContainer.width = am4core.percent(100);
    legendContainer.height = am4core.percent(100);
    chart.legend.parent = legendContainer;
    chart.leftAxesContainer.layout = "vertical";*/

    chart.exporting.menu = new am4core.ExportMenu();
    chart.exporting.menu.align = "left";
    chart.exporting.menu.verticalAlign = "top";

    var watermark = chart.createChild(am4core.Label);
    watermark.text = "Source: [bold] kredensial.web.id [/]";
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
    ?>
<?php
}
elseif ($page=="lihat")
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
"url"  : "<?php echo base_url();?>instansi_user/<?php echo $page;?>/data/<?php echo $id;?>/<?php echo $id2;?>/<?php echo $id3;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_laporan", "searchable":false , "visible":false },
                      { "data": "nama_standar_mutu" },
                      { "data": "tgl_laporan" },
                      { "data": "judul_laporan" }
/*                      { "data": "cp_lhu",
            "render": function ( data, type, row ) {
                return row.cp_lhu + ' (' + row.no_cp_lhu + ')';
            }
                      },*/
            ],
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-file-text'></i> Profile",
                    extend: "selected",
                    className: "btnfuchsia",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_laporan'];                       
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('instansi_user/'.$page.'/profil/'); ?>'+data;
                    }
                },
                {
                    text: "<i class='fa fa-image'></i> Galeri",
                    extend: "selected",
                    className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_laporan'];                       
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('instansi_user/'.$page.'/galeri/'); ?>'+data;
                    }
                },
                {
                    text: "<i class='fa fa-file-text'></i> Laporan",
                    extend: "selected",
                    className: "btnorange",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_laporan'];                       
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('instansi_user/'.$page.'/laporan/'); ?>'+data;
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
elseif ($page=="lihat_tabel" || $page=="lihat_laporan")
{
    // ---------------------------------- 13 Grafik Pie Semua Item No 2
    if($tabel == 3){
?>
    am4core.ready(function() {
    am4core.useTheme(am4themes_dataviz);
    am4core.useTheme(am4themes_animated);
    var chart = am4core.create("chartdiv", am4charts.PieChart);
    chart.dataSource.url = "<?php echo base_url();?>member/tabel/pie/<?php echo $tbl;?>";
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

    chart.legend = new am4charts.Legend();
    //chart.legend.labels.template.text = "[bold {color}]{category} : {value.percent.formatNumber('#.0')}% [/]";
    chart.legend.paddingTop = 0;
    chart.legend.paddingBottom = 0;
    chart.legend.fontSize = 11;
    chart.legend.wrap = true;
    chart.legend.labels.template.maxWidth = 150;
    chart.legend.labels.template.truncate = true;   
    chart.legend.scrollable = true;

    chart.exporting.menu = new am4core.ExportMenu();
    chart.exporting.menu.align = "left";
    chart.exporting.menu.verticalAlign = "top";

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
$period = $this->m_member->ambil_grafik_range_new($lhu,$tabel1,$select2,$konbln,$tbl,$group1); 
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
    $skonbln = array('barcode_pegawai'=>$barcode_pegawai,'DATE_FORMAT(tgl_lhu,"%Y-%m")'=>$bln,$jumlah=>0,'id_instansi'=>$id_instansi);
}
if($lhu == 5){
    $skonbln = array('DATE_FORMAT(tgl_daftar,"%Y-%m")'=>$bln,'id_instansi'=>$id_instansi);
}
$komp = $this->m_member->ambil_grafik_range_new($lhu,$tabel1,$select2,$skonbln,$tbl,$grup2);
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
$kp = $this->m_member->ambil_grafik_range_new($lhu,$tabel1,$select2,$konbln,$tbl,$grup2);
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

/*    var legendContainer = am4core.create("legenddiv", am4core.Container);
    legendContainer.width = am4core.percent(100);
    legendContainer.height = am4core.percent(100);
    chart.legend.parent = legendContainer;
    chart.leftAxesContainer.layout = "vertical";*/

    chart.exporting.menu = new am4core.ExportMenu();
    chart.exporting.menu.align = "left";
    chart.exporting.menu.verticalAlign = "top";

    var watermark = chart.createChild(am4core.Label);
    watermark.text = "Source: [bold] kredensial.web.id [/]";
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
$period = $this->m_member->ambil_grafik_range_new($lhu,$tabel1,$select2,$konbln,$tbl,$group1);
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
$data_kompetensi = $this->m_member->ambil_grafik_range_new($lhu,$tabel1,$select2,$skonbln,$tbl,$grup2);
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
    watermark.text = "Source: [bold] kredensial.web.id [/]";
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
$period = $this->m_member->ambil_grafik_range_new($lhu,$tabel1,$select2,$konbln,$tbl,$grtgl);
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
$data_kompetensi = $this->m_member->ambil_grafik_range_new($lhu,$tabel1,$select2,$skonbln,$tbl,$grup2);
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
$pseries = $this->m_member->ambil_grafik_range_new($lhu,$tabel1,$select2,$konbln,$tbl,$grup2);
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

/*var legendContainer = am4core.create("legenddiv", am4core.Container);
legendContainer.width = am4core.percent(100);
legendContainer.height = am4core.percent(100);
chart.legend.parent = legendContainer;*/
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
    watermark.text = "Source: [bold] kredensial.web.id [/]";
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
    // range dengan total
 if($tabel == 15){
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
        $jsonx = $this->m_member->grafik_garis_hasil_lhu($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_lhu'],$select_jscode,$tbl);
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

            //  labelBullet.tooltip.label.wrap = true;
            //  labelBullet.tooltip.label.width = 300;
  
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
//latitudeSeries.dataFields.categoryX = "year";
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
//latitudeBullet.circle.propertyFields.radius = "townSize";

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

/*var legendContainer = am4core.create("legenddiv", am4core.Container);
legendContainer.width = am4core.percent(100);
legendContainer.height = am4core.percent(100);
//chart.legend.parent = legendContainer;*/
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
    watermark.text = "Source: [bold] kredensial.web.id [/]";
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
        $jsonx = $this->m_member->grafik_garis_hasil_lhu($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_lhu'],$select_jscode,$tbl);
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
    watermark.text = "Source: [bold] kredensial.web.id [/]";
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
        $jsonx = $this->m_member->grafik_garis_hasil_lhu($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_lhu'],$select_jscode,$tbl);
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
    watermark.text = "Source: [bold] kredensial.web.id [/]";
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
        $jsonx = $this->m_member->grafik_garis_hasil_lhu($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_lhu'],$select_jscode,$tbl);
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

            //  labelBullet.tooltip.label.wrap = true;
            //  labelBullet.tooltip.label.width = 300;
  
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
    watermark.text = "Source: [bold] kredensial.web.id [/]";
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
        $jsonx = $this->m_member->grafik_garis_hasil_lhu($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_lhu'],$select_jscode,$tbl);
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
    watermark.text = "Source: [bold] kredensial.web.id [/]";
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
        $jsonx = $this->m_member->grafik_garis_hasil_lhu($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_lhu'],$select_jscode,$tbl);
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

            //  labelBullet.tooltip.label.wrap = true;
            //  labelBullet.tooltip.label.width = 300;
  
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
    watermark.text = "Source: [bold] kredensial.web.id [/]";
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
?>
</script>
		</div>
	</body>
</html>
