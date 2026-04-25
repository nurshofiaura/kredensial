<?php
//=================================== H O M E ================================================
$arraybox = array('warning','success','info','danger');
$resarray = array_rand($arraybox);
$thenarray = $arraybox[$resarray];
$arrayboxBOX = array('aqua','green','yellow','red');
$resarrayBOX = array_rand($arrayboxBOX);
$thenarrayBOX = $arrayboxBOX[$resarrayBOX];
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
      <div class="box box-<?php echo $thenarray; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
    <?php
      //    echo '<pre>'; print_r($this->session->all_userdata());
    ?>

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="etika_profesi")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('ms_etik/'.$page.'/view/'.$first_date.'/'.$last_date.'/'.$id_pegawai,' id="signupform" '); ;
  ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
        <div class="col-md-12">
          <div class="form-group">
            <label>Pegawai</label>
              <?php
                input_pdselect2("id_pegawai",$cmd_pegawai,$id_pegawai);
              ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Tanggal Awal</label>
              <?php
                input_calendar("first_date","first_date",$first_date,"Masukkan Tanggal Transaksi","required");
              ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Tanggal Akhir</label>
            <?php
              input_calendar("last_date","last_date",$last_date,"Masukkan Tanggal Transaksi","required");
            ?>
          </div>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
      </div>
    </div>
  <?php echo form_close(); ?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
      <?php
        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
          <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
            <thead>
              <tr>
                <th style="display:none;">ID</th>
                <th>Tanggal</th>
                <th>Nama</th>
                <th style="text-align:right;">Jumlah Soal</th>
                <th style="text-align:right;">Hasil</th>
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
elseif ($page=="etika_profesi_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ms_etik/etika_profesi/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">    
        <div class="col-md-12">
            <label>Pegawai</label>
            <?php
              input_pdselect2("id_pegawai",$cmd_pegawai,$id_pegawai);
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
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="etika_profesi_input")
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
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
    <?php echo form_open_multipart('ms_etik/etika_profesi/input/'.$first_date,' id="signupform" '); ;
    input_text("id_pegawai",$id_pegawai,"","","hidden");
    if($num_kol_etik_all['count_koletik']==0){
      $disableded = "disabled";
    }else{
      $disableded = "";
    }
    ?>
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;sidth:5%">No</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Etik</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align:center;width:10%;">YA</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align:center;width:10%;">TIDAK</th>
              </tr>
              </thead>
              <tbody>
                <?php
                $no = 0;
                foreach($kol_etik_all as $row){
                  $no++;
                ?>
              <tr>
                <td style="vertical-align:middle;"><?php echo $no;?></td>
                <td style="vertical-align:middle;"><?php input_text("id_etik[]",$row['id_etik'],"","","hidden"); ?><?php echo $row['nama_etik'];?></td>
                <td style="vertical-align:middle;text-align:center;">
                  <div class="radio">
                  <label>
                    <input type="radio" onchange="total_GR()" name="skor_etik<?php echo $row['id_etik']; ?>" value="<?php if($row['answer']=="1") {echo "1";}else{echo "0";}?>" checked="checked">
                  </label>
                  </div>
                </td>
                <td style="vertical-align:middle;text-align:center;">
                  <div class="radio">
                  <label>
                    <input type="radio" onchange="total_GR()" name="skor_etik<?php echo $row['id_etik']; ?>" value="<?php if($row['answer']=="0") {echo "1";}else{echo "0";}?>">
                  </label>
                  </div>
                </td>
              </tr>
                <?php
                  }
                ?>
              </tbody>
            </table>
              <?php
                input_text("sub_total",0,"maxlength='255' onchange='total_GR()' readonly","","hidden");
                input_text("total",$num_kol_etik_all['count_koletik'],"maxlength='255' ","","hidden");
              ?>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary" <?php echo $disableded; ?> >Submit</button>
        </div>
      </div>
    <?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="etika_profesi_edit")
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
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?= $title ?></h3>
            </div>
              <div class="box-body">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">No</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Etik</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align:center;">Jawaban</th>
              </tr>
              </thead>
              <tbody>
                <?php
                $No = 0;
                foreach($ambil_etik_detil as $row){
                  $No++;
                ?>
              <tr>
                <td style="vertical-align:middle;"><?php echo $No; ?></td>
                <td style="vertical-align:middle;"><?php echo $row['nama_etik'];?></td>
                <td style="vertical-align:middle;text-align:center;">
                <?php
                  if($row['choose']=="0") { // NO
                    echo "TIDAK";
                  }else if($row['choose']=="1"){
                    echo "YA";
                  }
                ?>
                </td>
              </tr>
                <?php
                  }
                ?>
              </tbody>
            </table>
              </div>
          </div>
    </div>  
    </FORM>
    </div>
<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2()
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