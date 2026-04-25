<?php
//=================================== H O M E ================================================
$arraybox = array('warning','success','info','danger');
$resarray = array_rand($arraybox);
$thenarray = $arraybox[$resarray];
$arrayboxBOX = array('aqua','green','yellow','red');
$resarrayBOX = array_rand($arrayboxBOX);
$thenarrayBOX = $arrayboxBOX[$resarrayBOX];
$btnarray = array('green','blue','yellow','red','purple','navy','maroon','olive','aqua','light-blue','teal','lime','orange','fuchsia');
$btnk = array_rand($btnarray);
$btnv = $btnarray[$btnk];
if ($page=="home")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">PERHATIAN</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="laporan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <a href="<?php echo $link_awal;?>"
        class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
      </a>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
      <?php
    //    input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <?php echo form_open_multipart('ol_laporan/'.$page.'/view/'.$id.'/'.$id2.'/'.$id3,' id="signupform" '); ?>
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">RANGE /PERIODE TANGGAL</h3>
        </div>
          <div class="box-body">
          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Tanggal Awal</label>
                    <?php
                      input_calendar("id","id",$id,"Masukkan Tanggal","");
                    ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Tanggal Akhir</label>
                  <?php
                    input_calendar("id2","id2",$id2,"Masukkan Tanggal","");
                  ?>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Opsi Tanggal</label>
                  <?php
                    input_pdselect2("id3",$all_kah,$id3);
                  ?>
                </div>
              </div>
          </div>
          </div>
          <div class="box-footer">
            <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
          </div>
        </div>
        <?php echo form_close(); ?>
      <div class="callout callout-success">
        <h4>LAPORAN INDIKATOR MUTU / QUALITY CONTROL PERSONAL</h4>
          Laporan ini dapat digunakan sebagai indikator mutu / QC personal yang outputnya berupa link dan di dalamnya berisi data yang dapat di print dan di download logbooknya. Link tersebut dapat di copy pastekan ke E-Kinerja BKN / Ujian Kompetensi lainnya. Klik Tabel / Grafik untuk menggenerate link nya.
      </div>
          <div class="box-tools pull-right">
      <?php
        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="display: none;">ID</th>            
            <th style="width:10%;text-align: center;vertical-align: middle;">Tanggal</th>            
            <th style="width:15%;text-align: center;vertical-align: middle;">Range</th>                                                        
            <th style="text-align: center;vertical-align: middle;">Judul</th>                                                        
            <th style="text-align: center;vertical-align: middle;">Tujuan</th>                            
            <th style="text-align: center;vertical-align: middle;">Instansi</th>                                       
            <th style="text-align: center;vertical-align: middle;">Pembuat</th>                                       
          </tr>
        </thead>
      </table>
        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="laporan_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_laporan/laporan/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
          <div class="box-tools pull-right">

          </div>
        </div>
     <div class="box-body">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">TANGGAL LAPORAN DAN PERIODE PENGAMBILAN LAPORAN (SESUAI TANGGAL LOGBOOK)</h3>
        </div>
          <div class="box-body">
            <div class="row">         
              <div class="col-md-4">
                  <label>Tanggal Laporan</label>
                  <?php
                    input_calendar("tgl_laporan","tgl_laporan",$tgl_laporan,"Masukkan Tanggal","");
                  ?>
              </div>
              <div class="col-md-4">
                  <label>Tanggal Awal</label>
                  <?php
                    input_calendar("tgl_awal","tgl_awal",$tgl_awal,"Masukkan Tanggal","");
                  ?>
              </div>
              <div class="col-md-4">
                  <label>Tanggal Akhir</label>
                  <?php
                    input_calendar("tgl_akhir","tgl_akhir",$tgl_akhir,"Masukkan Tanggal","");
                  ?>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
          <div class="row">         
            <div class="col-md-6">
                <label>Header Laporan</label>
                <?php
                  input_text("header_laporan",$header_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-6">
                <label>Sub Header Laporan 1</label>
                <?php
                  input_text("sub_header_laporan",$sub_header_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-6">
                <label>Sub Header Laporan 2</label>
                <?php
                  input_text("sub_sub_header_laporan",$sub_sub_header_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-6">
                <label>Tujuan</label>
                <?php
                  input_text("tujuan_laporan",$tujuan_laporan,"  ","","text");
                ?>
            </div>
            <div class="col-md-12">
                <label>Judul Laporan</label>
                <?php
                  input_text("judul_laporan",$judul_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-4">
                <label>Periode</label>
                <?php
                  input_text("periode_laporan",$periode_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-4">
                <label>Sumber Data</label>
                <?php
                  input_text("sumber_laporan",$sumber_laporan," maxlength='255' ","","text");
                ?>
            </div>     
            <div class="col-md-4">
                <label>Unit</label>
                <?php
                  input_pdselect2("id_working",$ambil_punit_nonull,$id_working);
                ?>
            </div> 
          </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$('#tgl_laporan').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_laporan").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#tgl_awal').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_awal").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#tgl_akhir').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_akhir").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="laporan_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_laporan/laporan/simpan_edit');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan" value="<?= $id; ?>">
            <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
          <div class="box-tools pull-right">

          </div>
        </div>
     <div class="box-body">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">TANGGAL LAPORAN DAN PERIODE PENGAMBILAN LAPORAN (SESUAI TANGGAL LOGBOOK)</h3>
        </div>
          <div class="box-body">
            <div class="row">         
              <div class="col-md-4">
                  <label>Tanggal Laporan</label>
                  <?php
                    input_calendar("tgl_laporan","tgl_laporan",$tgl_laporan,"Masukkan Tanggal","");
                  ?>
              </div>
              <div class="col-md-4">
                  <label>Tanggal Awal</label>
                  <?php
                    input_calendar("tgl_awal","tgl_awal",$tgl_awal,"Masukkan Tanggal","");
                  ?>
              </div>
              <div class="col-md-4">
                  <label>Tanggal Akhir</label>
                  <?php
                    input_calendar("tgl_akhir","tgl_akhir",$tgl_akhir,"Masukkan Tanggal","");
                  ?>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
          <div class="row">         
            <div class="col-md-6">
                <label>Header Laporan</label>
                <?php
                  input_text("header_laporan",$header_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-6">
                <label>Sub Header Laporan 1</label>
                <?php
                  input_text("sub_header_laporan",$sub_header_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-6">
                <label>Sub Header Laporan 2</label>
                <?php
                  input_text("sub_sub_header_laporan",$sub_sub_header_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-6">
                <label>Tujuan</label>
                <?php
                  input_text("tujuan_laporan",$tujuan_laporan,"  ","","text");
                ?>
            </div>
            <div class="col-md-12">
                <label>Judul Laporan</label>
                <?php
                  input_text("judul_laporan",$judul_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-4">
                <label>Periode</label>
                <?php
                  input_text("periode_laporan",$periode_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-4">
                <label>Sumber Data</label>
                <?php
                  input_text("sumber_laporan",$sumber_laporan," maxlength='255' ","","text");
                ?>
            </div>     
            <div class="col-md-4">
                <label>Unit</label>
                <?php
                  input_pdselect2("id_working",$ambil_punit_nonull,$id_working);
                ?>
            </div>    
          </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$('#tgl_laporan').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_laporan").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#tgl_awal').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_awal").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#tgl_akhir').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_akhir").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="tabel_cek")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
#legenddiv {
  max-height: 150px;
  overflow: auto;
}
#chartdiv, #legendwrapper {
  width: 100%;
  height: 1000px;
}
#legenddiv {
  height: 150px;
}

#legendwrapper {
  max-height: 120px;
  overflow-x: none;
  overflow-y: auto;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <a href="<?php echo $link_awal;?>"
        class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
      </a>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?= $title ?> - <?php echo $nama_unit; ?></h3>

          <div class="box-tools pull-right">
      <?php
  //      input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <div class="callout callout-info">
        <h5>Judul Laporan : <?php echo $judul_laporan; ?><?php if($idtab) echo '</h5><h5>Judul Tabel / Grafik : '.$judul_laporan_tabel; ?></h5>
      </div>

            <?php  
      if($idtab){
    // =================================================================
        if($tabel == 1){
      // ============================= $tabel == 1 ====================================
          if($lhu == 1 || $lhu == 4 || $lhu == 5){
          //      if($show_pdf == 1){
              ?>
          <a  href="<?php echo base_url('ol_laporan/tabel/pdf_logbook/'.$idlap.'/'.$idtab); ?>" target="_blank" class="btn btn-sm bg-<?php echo $btnarray[array_rand($btnarray)]; ?>">
            <i class="fa fa-file-pdf-o"></i> PRINT PDF
          </a><br><br>
              <?php
           //     }
            foreach($ambil_bulan as $rowambil_bulan){
            $bln = date('m',strtotime($rowambil_bulan[$tgl_item]));
            $thn = date('Y',strtotime($rowambil_bulan[$tgl_item]));
            $ketbulan = date('Y-m',strtotime($rowambil_bulan[$tgl_item]));
            $awal = $ketbulan.'-01';
            $tglakhir = date('t', strtotime($awal));
            $akhir  = $ketbulan.'-'.$tglakhir;
            ?>
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title">DATA TABEL PERIODE BULAN : <?= $this->m_rancak->getBulan($bln) ?> &nbsp;TAHUN : <?= $thn ?> </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
              <?php  
              if($lhu == 4 && $qc_self == 0){
                $kondisi_groupkat = array('DATE_FORMAT('.$tgl_item.',"%Y-%m")'=>$ketbulan,$ins=>$idinst);
              }elseif($lhu == 5){
                $kondisi_groupkat = array('DATE_FORMAT('.$tgl_item.',"%Y-%m")'=>$ketbulan,$ins=>$idinst);
              }
              else{
                $kondisi_groupkat = array('DATE_FORMAT('.$tgl_item.',"%Y-%m")'=>$ketbulan,$id_peg=>$pegawai,$ins=>$idinst);
              }
          $ambil_lhu_grupkat = $this->m_ol_laporan->ambil_isi($idtab,$tabel_item,$select_all,$kondisi_groupkat,$lhu,$kat_item,'asc',$jml_isi,$arr_isi,$jml_seting,$arr_seting,$kat_item);
              foreach($ambil_lhu_grupkat as $rowkat){            
              ?>
              <h3 class="box-title"><?= $rowkat[$nama_kat] ?></h3>
                <table class="table table-responsive tableFixHead">
                  <thead>
                  <tr class="bg-dark">
                    <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;">No</th>
                    <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;">Nama</th>
                  <?php
                    foreach (range(1, $tglakhir) as $number) {                  
                  ?>
                    <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;"><?php echo $number; ?></th>
                  <?php
                    }
                  ?>
                    <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;">Jml</th>
                  </tr>
                  </thead>
                  <tbody>   
                    <?php
                      $no = 0;
                      if($lhu == 4 && $qc_self == 0){
                        $kondisi_group = array('DATE_FORMAT('.$tgl_item.',"%Y-%m")'=>$ketbulan,$kat_item=>$rowkat[$ins_item],$ins=>$idinst);
                      }elseif($lhu == 5){
                        $kondisi_group = array('DATE_FORMAT('.$tgl_item.',"%Y-%m")'=>$ketbulan,$kat_item=>$rowkat[$ins_item],$ins=>$idinst);
                      }
                      else{
                        $kondisi_group = array('DATE_FORMAT('.$tgl_item.',"%Y-%m")'=>$ketbulan,$kat_item=>$rowkat[$ins_item],$id_peg=>$pegawai,$ins=>$idinst);
                      }
                    $ambil_lhu_grup = $this->m_ol_laporan->ambil_isi($idtab,$tabel_item,$select_all,$kondisi_group,$lhu,$order,'asc',$jml_isi,$arr_isi,$jml_seting,$arr_seting,$grup_item);
                      foreach($ambil_lhu_grup as $row){
                        $no++;
                    ?>
                  <tr>
                    <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?php echo $no; ?></td>
                    <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:left">
                      <?php 
                      if($lhu == 4){
                        echo $row[$nama_item1].' <b>['.$row[$nama_item2].']</b>';
                      }else{
                        echo $row[$nama_item];
                      }
                      ?>                      
                    </td>
                    <?php   $hitung_dewek=0;$jml4=0;
                    foreach (range(1, $tglakhir) as $numbers) {
                      $tglenya  = $ketbulan.'-'.$numbers;
                      if($lhu == 4 && $qc_self == 0){
                        $kondisi_jml = array($tgl_item=>$tglenya,$ins=>$idinst,$grup_item=>$row[$id_item]);
                        $select_jml = $select_all;
                      }else{
                        $kondisi_jml = array($tgl_item=>$tglenya,$id_peg=>$pegawai,$ins=>$idinst,$grup_item=>$row[$id_item]);
                        $select_jml = $selectgrup;
                      }
                    $jml = $this->m_ol_laporan->jumlah_sumber_data($idtab,$tabel_item,$kondisi_jml,$lhu,$jml_isi,$arr_isi,$jml_seting,$arr_seting);
                      if($jml == 0){    
                    ?>
                    <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center">0</td>
                    <?php
                      }else{
                        $q = $this->m_ol_laporan->total_sumber_data($idtab,$tabel_item,$select_jml,$kondisi_jml,$lhu,$jml_isi,$arr_isi,$jml_seting,$arr_seting);
                        foreach($q as $row2){
                      if($lhu == 4){
                        $jml4++;
                        $hitung_dewek = $jml4;
                      }else{
                        $hitung_dewek = $hitung_dewek + $row2[$sumeas];
                      }
                    ?>
                    <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;background-color:grey;color: white;">
                      <?php 
                      if($lhu == 1){
                        echo number_format($row2[$sumeas],0); 
                      }else{
                        echo number_format($row2[$jml_item],0); 
                      }
                      ?>
                    </td>
                    <?php
                        }
                      }
                    }
                    ?>
                    <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;background-color:dimgrey;color: white;"><?php if($hitung_dewek != '-') echo number_format($hitung_dewek,0); ?></td>
                  </tr> 
                    <?php
                      }
                    ?>
                  </tbody>
                </table>  
                <?php  
                  }
                ?>
            </div>
          </div>
        <?php
            //============= !foreach($ambil_bulan as $rowambil_bulan){
            }
            //============= !if($lhu == 1 || $lhu == 4 || $lhu == 5){
          }
          if($lhu == 7){
        ?>
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title"></h3>

              <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
                <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
              <table id="example2" width="100%" class="table table-bordered table-striped">
              <thead>
                <tr>                   
                <th style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;">Nama Berkas</th>
                <th style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;">Keterangan</th>
                </tr>
              </thead>
                <tbody>  
                <?php  
                if($jml_berkas > 0){
                foreach($ambil_berkas as $rowambil_berkas){
                ?>
              <tr>
                <td colspan="3" style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;">BERKAS</td>
              </tr>
              <tr>
                <td><?= $rowambil_berkas['nama_berkas'] ?></td>
                <td style="vertical-align:middle;text-align: center;">
                <?php  
                  if(!empty($rowambil_berkas['no_berkas'])){
                  echo 'No Berkas : '.$rowambil_berkas['no_berkas'];
                  }
                ?>
                <br>
                Kategori : <?= $rowambil_berkas['nama_berkas_kategori'] ?>
                </td>
              </tr>
              <tr>
                <td colspan="2" style="vertical-align:middle;text-align: center;">
        <div class="embed-responsive embed-responsive-16by9">
          <iframe class="embed-responsive-item" src="<?php echo base_url();?>assets/berkas/ol/<?= $rowambil_berkas['link_berkas'] ?>" allowfullscreen></iframe>
        </div>
                </td>
              </tr>
              <?php  
                }
                }
                if($jml_imut > 0){
                foreach($ambil_imut as $rowambil_imut){
                ?>
              <tr>
                <td colspan="3" style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;">BERKAS Quality Control / Indikator Mutu</td>
              </tr>
              <tr>
                <td><?= $rowambil_imut['nama_berkas'] ?></td>
                <td style="vertical-align:middle;text-align: center;">
                <?php  
                  if(!empty($rowambil_imut['no_berkas'])){
                  echo 'No Berkas : '.$rowambil_imut['no_berkas'];
                  }
                ?>
                <br>
                Kategori : <?= $rowambil_imut['nama_berkas_kategori'] ?>
                </td>
              </tr>
              <tr>
                <td colspan="2" style="vertical-align:middle;text-align: center;">
        <div class="embed-responsive embed-responsive-16by9">
          <iframe class="embed-responsive-item" src="<?php echo base_url();?>assets/berkas/ol/<?= $rowambil_imut['link_berkas'] ?>" allowfullscreen></iframe>
        </div>
                </td>
              </tr>
              <?php  
                }
                }
                if($jml_ijasah > 0){
                foreach($ambil_ijasah as $rowambil_ijasah){
                ?>
              <tr>
                <td colspan="3" style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;">BERKAS IJASAH</td>
              </tr>
              <tr>
                <td><?= $rowambil_ijasah['nama_berkas'] ?></td>
                <td style="vertical-align:middle;text-align: center;">
                Kategori : <?= $rowambil_ijasah['nama_berkas_kategori'] ?><br>
                Jenjang Pendidikan : <?= $rowambil_ijasah['nama_pendidikan'] ?><br>
                No Ijasah : <?= $rowambil_ijasah['no_berkas'] ?><br>
                Tanggal Kelulusan : <?= $this->m_rancak->fullBulan($rowambil_ijasah['tgl_b_berkas']) ?><br>
                </td>
              </tr>
              <tr>
                <td colspan="2" style="vertical-align:middle;text-align: center;">
        <div class="embed-responsive embed-responsive-16by9">
          <iframe class="embed-responsive-item" src="<?php echo base_url();?>assets/berkas/ol/<?= $rowambil_ijasah['link_berkas'] ?>" allowfullscreen></iframe>
        </div>
                </td>
              </tr>
              <?php  
                }
                }
                if($jml_pelatihan > 0){
                foreach($ambil_pelatihan as $rowambil_pelatihan){
                ?>
              <tr>
                <td colspan="3" style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;">BERKAS PELATIHAN</td>
              </tr>
              <tr>
                <td><?= $rowambil_pelatihan['nama_berkas'] ?></td>
                <td style="vertical-align:middle;text-align: center;">
        Kategori : <?= $rowambil_pelatihan['nama_berkas_kategori'] ?>
        Jenis Pelatihan : <?= $rowambil_pelatihan['nama_kategori_pelatihan'] ?><br>
        Penyelenggara : <?= $rowambil_pelatihan['penyelenggara'] ?><br>
        No Sertifikat : <?= $rowambil_pelatihan['no_sertifikat'] ?><br>
        Jumlah SKP : <?= number_format($rowambil_pelatihan['kredit'],2) ?><br>
        Tanggal Mulai : <?= $this->m_rancak->fullBulan(date('d-m-Y',strtotime($rowambil_pelatihan['tgl_a_berkas']))) ?> s/d <?= $this->m_rancak->fullBulan(date('d-m-Y',strtotime($rowambil_pelatihan['tgl_b_berkas']))) ?>
                </td>
              </tr>
              <tr>
                <td colspan="2" style="vertical-align:middle;text-align: center;">
        <div class="embed-responsive embed-responsive-16by9">
      <iframe class="embed-responsive-item" src="<?php echo base_url();?>assets/berkas/ol/<?= $rowambil_pelatihan['link_berkas'] ?>" allowfullscreen></iframe>
        </div>
                </td>
              </tr>
              <?php  
                }
                }
                if($jml_str > 0){
                foreach($ambil_str as $rowambil_str){
                ?>
              <tr>
                <td colspan="3" style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;">BERKAS SURAT IJIN</td>
              </tr>
              <tr>
                <td><?= $rowambil_str['nama_berkas'] ?></td>
                <td style="vertical-align:middle;text-align: center;">
                Kategori : <?= $rowambil_str['nama_berkas_kategori'] ?><br>
                No Surat Ijin : <?= $rowambil_str['no_berkas'] ?><br>
                Berlaku Mulai : <?= date('d-m-Y',strtotime($rowambil_str['tgl_a_berkas'])) ?> s/d 
                <?php 
                  if($rowambil_str['lifetime_berkas'] == 1){
                  echo "Seumur Hidup";
                  }else{
                  echo date('d-m-Y',strtotime($rowambil_str['tgl_b_berkas']));
                  }
                ?>
                </td>
              </tr>
              <tr>
                <td colspan="2" style="vertical-align:middle;text-align: center;">
        <div class="embed-responsive embed-responsive-16by9">
          <iframe class="embed-responsive-item" src="<?php echo base_url();?>assets/berkas/ol/<?= $rowambil_str['link_berkas'] ?>" allowfullscreen></iframe>
        </div>
                </td>
              </tr>
              <?php  
                }
                }
              ?>
              </tbody>
              </table> 
            </div>
          </div>
        <?php
        //=========================================================== !lhu = 7
          }
          if($lhu == 8){
        ?>
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title"></h3>

              <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
                <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
              <table id="example2" width="100%" class="table table-bordered table-striped">
                <thead>
                  <tr>                   
                  <th style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;width:2%;">No</th>
                  <th style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;width:15%;">Waktu</th>
                  <th style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;">Nama</th>
                  <th style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;width: 20%;">Hasil</th>
                  <th style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;width: 20%;">Kesimpulan</th>
                  </tr>
                </thead>
                <tbody>  
                  <?php  
                  $no =0;
                  foreach($ambil_lhu as $rowgrup){
                  $no++;
                  ?>
                    <tr>
                      <td style="text-align: center;"><h5><?= $no ?></h5></td>
                      <td colspan="2">
                        <h5>Nama Even : <?= $rowgrup['nama_even'] ?></h5>
                        <h5>Lokasi : <?= $rowgrup['alamat_even'] ?></h5>
                        <h5>Waktu : <?= date('d-m-Y',strtotime($rowgrup['tgl_even']))  ?> <?= $rowgrup['time_even'] ?></h5>
  
                      </td>
                      <td colspan="2">
                        <h5>Peserta :</h5>
                        <ol>
                          <?php 
                            $ambpeserta = $this->m_umum->ambil_data_explode('ol_pegawai','barcode_pegawai',$rowgrup['peserta_even']);
                            foreach($ambpeserta as $rowambpeserta){
                          ?>
                            <li style="margin-left: 27px; float:left;"> &nbsp;&nbsp;<?= $rowambpeserta['nama_pegawai'] ?></li>
                          <?php } ?>
                          <div style="clear:both"></div>
                        </ol>
                      </td>
                    </tr>
                    <tr>
                      <td style="vertical-align:middle;text-align: left;font-weight: bold;">&nbsp;</td>
                      <td colspan="4" style="vertical-align:middle;text-align: left;font-weight: bold;">DETAIL EVEN</td>
                    </tr>
                          <?php 
                            $kondisidet = array('id_even'=>$rowgrup['id_even']);
                            $ambdetail = $this->m_umum->ambil_data_kondisi_result('abs_even_detil',$kondisidet);
                            foreach($ambdetail as $rowambdetail){
                          ?>
                    <tr>
                      <td style="vertical-align:middle;text-align: center;">&nbsp;</td>
                      <td style="vertical-align:middle;text-align: center;vertical-align: middle;"><h5><?= date('d-m-Y',strtotime($rowambdetail['tgl_even_detil']))  ?> <?= $rowambdetail['time_even_detil'] ?></h5></td>
                      <td>
                        <h5>Nama Sub Even : <?= $rowambdetail['nama_even_detil'] ?></h5>
                        <h5>Pembicara : <?= $rowambdetail['speaker_even_detil'] ?></h5>
                      </td>
                      <td><?= $rowambdetail['hasil_even_detil'] ?></td>
                      <td><?= $rowambdetail['kesimpulan_even_detil'] ?></td>
                    </tr>
                <?php  
                            }
                  }
                ?>
                </tbody>
              </table> 
            </div>
          </div>
        <?php
        //=========================================================== !lhu = 8
          }
        ?>
    <?php
        }else
        // ============================= !$tabel == 1 ====================================
        if($tabel == 14){
        // ============================= $tabel == 14 ====================================
          if($lhu == 1 || $lhu == 4 || $lhu == 5 || $lhu == 7){
    ?>
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title"></h3>

              <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
                <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
              <table id="example2" width="100%" class="table table-bordered table-striped">
                <thead>
                  <tr>                   
                  <th style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;width:2%;">No</th>
                  <th style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;">Nama</th>
                  <th style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;">Hasil</th>
                  </tr>
                </thead>
                <tbody>  
                  <?php  
                  $no =0;
                  $jmle =0;
                  foreach($grup_lhu as $rowgrup){
                  $jmle = $jmle + $rowgrup[$jml_item];
                  $no++;
                  ?>
                    <tr>
                      <td style="vertical-align:middle;text-align: center;"><?= $no ?></td>
                      <td><?= $rowgrup[$nama_item1] ?> [<b><?= $rowgrup[$nama_item2] ?></b>]</td>
                      <td style="vertical-align:middle;text-align: center;"><?= round($rowgrup[$jml_item],3) ?></td>
                    </tr>
                <?php  
                  }
                ?>
                </tbody>
              </table> 
            </div>
          </div>
    <?php
        // ============================= !if($lhu == 1 || $lhu == 4 || $lhu == 5 || $lhu == 7) ====================================
          }
        // ============================= !$tabel == 14 ====================================
        }else{
        //============================================================================ ELSE GRAFIK ============================= 
    ?>
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title">GRAFIK</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
               <div id="chartdiv"></div>
                <div id="legenddiv"></div>
            </div>
          </div> 
        <?php //============================================================================ ! ELSE GRAFIK ============================= 
            } 
          }
        ?>
        </div>       
      </div>
    </section>
</div>
<?php
}
elseif ($page=="tabel")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
#legenddiv {
  max-height: 150px;
  overflow: auto;
}
#chartdiv, #legendwrapper {
  width: 100%;
  height: 1000px;
}
#legenddiv {
  height: 150px;
}

#legendwrapper {
  max-height: 120px;
  overflow-x: none;
  overflow-y: auto;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <a href="<?php echo $link_awal;?>"
        class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
      </a>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?= $title ?> - <?php echo $nama_unit; ?></h3>

          <div class="box-tools pull-right">
      <?php
  //      input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <div class="callout callout-info">
        <h5>Judul Laporan : <?php echo $judul_laporan; ?><?php if($idtab) echo '</h5><h5>Judul Tabel / Grafik : '.$judul_laporan_tabel; ?></h5>
      </div>

      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?= $text ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
            <thead>
              <tr>
                <th style="width:5%;vertical-align: middle;text-align: center;">Urutan</th>            
                <th style="vertical-align: middle;">Judul</th>            
                <th style="width:7%;vertical-align: middle;">Range</th>            
                <th style="width:10%;vertical-align: middle;">Sumber Data</th>            
                <th style="width:15%;vertical-align: middle;">Tabel</th>                                                                                
                <th style="width:15%;vertical-align: middle;">Instansi</th>                                                                             
                <th style="width:7%;vertical-align: middle;">Berkas</th>                        
                <th style="width:10%;vertical-align: middle;">Sub Tombol</th>               
              </tr>
            </thead>
          </table>

        </div>
      </div>
        </div>       
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="baru_tambah_tabel")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_laporan/baru/simpan_tambah_tabel');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">MASUKKAN DATA TABEL / GRAFIK MINIMAL JUDUL</h3>
      </div>
        <div class="box-body">
          <div class="row">         
          <div class="col-md-12">
            <label>Judul</label>
            <?php
              input_text("judul_laporan_tabel",$judul_laporan_tabel," maxlength='255' required ","","text");
            ?>  
          </div>                   
          <div class="col-md-12">
            <label>Analisa</label>
            <?php
              input_textareacustom("analisa_laporan_tabel",$analisa_laporan_tabel," id='editor1' rows='5' cols='50' class='form-control' ","");
            ?>  
          </div>  
          <div class="col-md-12">
            <label>Hasil / Rekomendasi</label>
            <?php
      input_textareacustom("rekomendasi_laporan_tabel",$rekomendasi_laporan_tabel," id='editor2' rows='5' cols='50' class='form-control' ","");
            ?>  
          </div>     
          </div>
        </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
        CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
        CKEDITOR.replace('editor2', {enterMode: CKEDITOR.ENTER_BR});
});
</script>
<?php
}
elseif ($page=="baru_rubah_tabel")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_laporan/baru/simpan_rubah_tabel');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan_tabel" value="<?= $id_laporan_tabel; ?>">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
            <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">PILIH TABEL DAN GRAFIK</h3>
      </div>
        <div class="box-body">
          <div class="row">         
          <div class="col-md-12">
            <label>Judul</label>
            <?php
              input_text("judul_laporan_tabel",$judul_laporan_tabel," maxlength='255' required ","","text");
            ?>  
          </div>                   
          <div class="col-md-12">
            <label>Analisa</label>
            <?php
              input_textareacustom("analisa_laporan_tabel",$analisa_laporan_tabel," id='editor1' rows='5' cols='50' class='form-control' ","");
            ?>  
          </div>  
          <div class="col-md-12">
            <label>Hasil / Rekomendasi</label>
            <?php
      input_textareacustom("rekomendasi_laporan_tabel",$rekomendasi_laporan_tabel," id='editor2' rows='5' cols='50' class='form-control' ","");
            ?>  
          </div>                        
          </div>
        </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
        CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
        CKEDITOR.replace('editor2', {enterMode: CKEDITOR.ENTER_BR});
});
</script>
<?php
}
elseif ($page=="baru_rubah_urutan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_laporan/baru/simpan_rubah_urutan');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan_tabel" value="<?= $id_laporan_tabel; ?>">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
            <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">KETIK ANGKA</h3>
      </div>
        <div class="box-body">
          <div class="row">         
          <div class="col-md-12">
            <label>Urutan</label>
            <?php
          input_textcustom("urutan_laporan_tabel",$urutan_laporan_tabel,"maxlength='3' required autofocus class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58' " ,"Masukkan Angka","text"); 
            ?>  
          </div>                        
          </div>
        </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="baru_modif")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_laporan/baru/simpan_modif');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan_tabel" value="<?= $id_laporan_tabel; ?>">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
            <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">PILIH TABEL DAN GRAFIK</h3>
      </div>
        <div class="box-body">
          <div class="row">         
          <div class="col-md-12">
            <label>Grafik</label>
            <?php
            //  input_pdselect2("tabel",$ambil_tabel,$tabel);
input_pdselect2fleksibel("tabel","tabel",$ambil_tabel,"id_tabel","nama_tabel",$tabel,"Tanpa Tabel dan Grafik");
            ?>  
          </div>                        
          </div>
        </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="baru_seting_range")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_laporan/baru/simpan_seting_range');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan_tabel" value="<?= $id_laporan_tabel; ?>">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
            <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">RANGE VALUE</h3>
      </div>
        <div class="box-body">
          <div class="row">         
          <div class="col-md-6">
            <label>Mininal Value (Kalau tidak ada isi 0)</label>
            <?php
          input_textcustom("min_laporan_tabel",$min_laporan_tabel,"maxlength='3' required autofocus class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58' " ,"Masukkan Angka","text"); 
            ?>  
          </div>  
          <div class="col-md-6">
            <label>Maximal Value (Kalau tidak ada isi 0)</label>
            <?php
          input_textcustom("max_laporan_tabel",$max_laporan_tabel,"maxlength='3' required autofocus class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58' " ,"Masukkan Angka","text"); 
            ?>  
          </div>                       
          </div>
        </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="baru_rubah_lhu")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_laporan/baru/simpan_rubah_lhu');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan_tabel" value="<?= $id_laporan_tabel; ?>">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
            <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">PILIH SUMBER DATA</h3>
      </div>
        <div class="box-body">
          <div class="row">         
          <div class="col-md-12">
            <label>Sumber Data</label>
            <?php
              input_pdselect2("lhu",$cmd_lhu_personal,$lhu);
            ?>  
          </div>                        
          </div>
        </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="baru_rubah_qc")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_laporan/baru/simpan_rubah_qc');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan_tabel" value="<?= $id_laporan_tabel; ?>">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
            <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">PILIH IM / QC Personal / Ruangan</h3>
      </div>
        <div class="box-body">
          <div class="row">         
          <div class="col-md-12">
            <label>Sumber Data</label>
            <?php
              input_pdselect2("qc_self",$cmd_qcim,$qc_self);
            ?>  
          </div>                        
          </div>
        </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="tabel_seting_kompetensi")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
      <div class="row">
        <div class="col-md-12">
    <FORM method="POST" class="form-horizontal" action="<?php echo base_url('ol_laporan/tabel/simpan_seting_kompetensi');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan_tabel" value="<?= $id_laporan_tabel; ?>">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
            <input type="hidden" name="tabel_source" value="<?= $tabel_seting; ?>">
            <input type="hidden" name="nama_source" value="<?= $nama_seting; ?>">
            <input type="hidden" name="ket_source" value="<?= $ket_seting; ?>">
            <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title" style="font-weight:bold;">SILAHKAN PILIH DATA YANG DIINGINKAN</h3>
            </div>
              <div class="box-body">           
                <table id="example1" width="100%" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 10%;text-align: center;">
                      <input name="select_all" class="checkall" type="checkbox" />
                    </th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 10%;">No</th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama Kompetensi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no=0;
                    $arr = array();
                    foreach($arr_seting as $val){
                        $arr[] = $val['id_source'];
                    }
                    $eimplo = implode(",", $arr);
                    foreach($chk_seting as $row){
                     $no++;
                    ?>
                  <tr>
                    <td style="vertical-align:middle;text-align: center;">
                      <div class="checkbox">
                      <label>
<input type="checkbox" class="child" name="chk[]" value="<?php echo $row[$nama_seting];?>" <?php if(in_array($row[$nama_seting],explode(",", $eimplo))) echo 'checked="checked"'; ?>> 
                      </label>
                      </div>
                    </td>
                    <td style="vertical-align:middle;"><?= $no ?></td>
                    <td style="vertical-align:middle;"><?= $row[$nama_item1] ?> [<b><?= $row[$nama_item2] ?></b>]</td>
                  </tr>
                    <?php
                      }
                    ?>
                  </tbody>
                </table>
              </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
          </div>
    </div>  
    </FORM>
    </div>
<script type="text/javascript">
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
  });
</script>
<?php
}
elseif ($page=="tabel_seting_isi_kompetensi")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
      <div class="row">
        <div class="col-md-12">
    <FORM method="POST" class="form-horizontal" action="<?php echo base_url('ol_laporan/tabel/simpan_seting_isi_kompetensi');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan_tabel" value="<?= $id_laporan_tabel; ?>">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
            <input type="hidden" name="tabel_source" value="<?= $tabel_isi; ?>">
            <input type="hidden" name="nama_source" value="<?= $nama_isi; ?>">
            <input type="hidden" name="ket_source" value="<?= $ket_isi; ?>">
            <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title" style="font-weight:bold;">SILAHKAN PILIH DATA YANG DIINGINKAN</h3>
            </div>
              <div class="box-body">           
                <table id="example1" width="100%" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">
                      <input name="select_all" class="checkall" type="checkbox" />
                    </th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 15%;">Tanggal</th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama</th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nilai</th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Pembuat</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no=0;
                    $arr = array();
                    foreach($arr_isi as $val){
                        $arr[] = $val['id_source'];
                    }
                     $eimplo = implode(",", $arr);
                    foreach($chk_isi as $row){
                     $no++;
                    ?>
                  <tr>
                    <td style="vertical-align:middle;">
                      <div class="checkbox">
                      <label>
                        <input type="checkbox" class="child" name="chk[]" value="<?php echo $row[$nama_isi];?>" <?php if(in_array($row[$nama_isi],explode(",", $eimplo))) echo 'checked="checked"'; ?>> 
                      </label>
                      </div>
                    </td>
                    <td style="vertical-align:middle;"><?= date('d-m-Y', strtotime($row[$tgl_item])) ?></td>
                    <td style="vertical-align:middle;">
                      <?php 
                        if($lhu == 7){ ?>
                        <?= $row[$nama_berkas] ?> <br>Penyelenggara : <?= $row[$penyelenggara] ?> - <b>[<?= $row[$nama_item2] ?>]</b>
                      <?php  }else{ ?>
                        <?= $row[$nama_item1] ?> - <b>[<?= $row[$nama_item2] ?>]</b>
                      <?php  }
                      ?>                     
                    </td>
                    <td style="vertical-align:middle;">
                      <?php 
                        if($lhu == 7){ ?>
                        <?= number_format($row[$kredit],1) ?>
                      <?php  }else{ ?>
                        <?= round($row[$jml_item],1) ?>
                      <?php  }
                      ?>
                      </td>
                    <td style="vertical-align:middle;"><?= $row[$nama_pegawai] ?></td>
                  </tr>
                    <?php
                      }
                    ?>
                  </tbody>
                </table>
              </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
          </div>
    </div>  
    </FORM>
    </div>
<script type="text/javascript">
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
  });
</script>
<?php
}
elseif ($page=="baru_seting_kewenangan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
      <div class="row">
        <div class="col-md-12">
    <FORM method="POST" class="form-horizontal" action="<?php echo base_url('ol_laporan/baru/simpan_seting_kewenangan');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan_tabel" value="<?= $id_laporan_tabel; ?>">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
            <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title" style="font-weight:bold;">SILAHKAN PILIH DATA YANG DIINGINKAN</h3>
            </div>
              <div class="box-body">           
          <div class="row">         
          <div class="col-md-12">
            <label>Pilih Grafik Pie Kompetensi Berdasarkan Kewenangan / Kompetensi</label>
            <?php
              input_pdselect2("kewenangan",$cmd_komporke,$kewenangan);
            ?>  
          </div>                        
          </div>
              </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
          </div>
    </div>  
    </FORM>
    </div>
<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2()
  });
</script>
<?php
}
elseif ($page=="baru_seting_berkas")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
      <div class="row">
        <div class="col-md-12">
    <FORM method="POST" class="form-horizontal" action="<?php echo base_url('ol_laporan/baru/simpan_seting_berkas');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan_tabel" value="<?= $id_laporan_tabel; ?>">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
            <input type="hidden" name="field" value="<?= $field; ?>">
            <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title" style="font-weight:bold;">SILAHKAN PILIH BERKAS YANG DIINGINKAN SELAIN LAPORAN BERKAS</h3>
            </div>
              <div class="box-body">           
                <table id="example1" width="100%" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;text-align: center;">
                      <input name="select_all" class="checkall" type="checkbox" />
                    </th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Tanggal</th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama Berkas</th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kategori Berkas</th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kategori Pelatihan</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no=0;
   /*                 $arr = array();
                    foreach($kr_jabatan_fungsional as $val){
                        $arr[] = $val['id_kewenangan'];
                    }
                    $eimplo = implode(",", $id_lhu);*/
                    foreach($chk_item as $row){
                     $no++;
                    ?>
                  <tr>
                    <td style="vertical-align:middle;text-align: center;">
                      <div class="checkbox">
                      <label>
                        <input type="checkbox" class="child" name="chk[]" value="<?php echo $row[$id_item];?>" <?php if(in_array($row[$id_item],explode(",", $explo))) echo 'checked="checked"'; ?>> 
                      </label>
                      </div>
                    </td>
                    <td style="vertical-align:middle;text-align: center;"><?php if(!empty($row['tgl_a_berkas'])){ echo date('d-m-Y',strtotime($row['tgl_a_berkas'])); } ?> <?php if(!empty($row['tgl_b_berkas'] && $row['lifetime_berkas'] == 0)){ echo date('d-m-Y',strtotime($row['tgl_b_berkas'])); } ?> <?php if($row['lifetime_berkas'] == 1) echo '<br>Seumur Hidup'; ?></td>
                    <td style="vertical-align:middle;"><?= $row['nama_berkas'] ?></td>
                    <td style="vertical-align:middle;"><?= $row['nama_berkas_kategori'] ?></td>
                    <td style="vertical-align:middle;"><?= $row['nama_kategori_pelatihan'] ?></td>
                  </tr>
                    <?php
                      }
                    ?>
                  </tbody>
                </table>
              </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
          </div>
    </div>  
    </FORM>
    </div>
<script type="text/javascript">
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
  });
</script>
<?php
}
elseif ($page=="tabel_seting_print")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_laporan/tabel/simpan_seting_print');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan_tabel" value="<?= $id_laporan_tabel; ?>">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
            <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">APAKAH DI LINK LAPORAN DI TAMPILKAN PRINT PDF??</h3>
      </div>
        <div class="box-body">
          <div class="row">         
          <div class="col-md-12">
            <label>APAKAH DI LINK LAPORAN DI TAMPILKAN PRINT PDF??</label>
            <?php
              input_pdselect2("show_pdf",$cmd_ya_tidak,$show_pdf);
            ?>  
          </div>                        
          </div>
        </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="baru_seting_sub")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_laporan/baru/simpan_seting_sub');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan_tabel" value="<?= $id_laporan_tabel; ?>">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
            <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Sub Laporan Tampilkan??</h3>
      </div>
        <div class="box-body">
          <div class="row">         
          <div class="col-md-12">
            <label>Sub Laporan Tampilkan??</label>
            <?php
              input_pdselect2("sub",$cmd_ya_tidak,$sub);
            ?>  
          </div>                        
          </div>
        </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="tabel_disabel")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_laporan/tabel/simpan_disabel');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan_tabel" value="<?= $id_laporan_tabel; ?>">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
            <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">APAKAH TABEL INI AKAN DIMASUKKAN LAPORAN ??</h3>
      </div>
        <div class="box-body">
          <div class="row">         
          <div class="col-md-12">
            <label>YA / TIDAK</label>
            <?php
              input_pdselect2("status_urutan_tabel",$cmd_ya_tidak,$status_urutan_tabel);
            ?>  
          </div>                        
          </div>
        </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="baru_clone")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_laporan/baru/simpan_clone');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan_tabel" value="<?= $id_laporan_tabel; ?>">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
            <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">PILIH JUDUL LAPORAN</h3>
      </div>
        <div class="box-body">
          <div class="row">         
          <div class="col-md-12">
            <label>JUDUL LAPORAN</label>
            <?php
              input_pdselect2("id_laporan",$cmd_judul_laporan,$id_laporan);
            ?>  
          </div>                        
          </div>
        </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}