<?php
//=================================== H O M E ================================================
$arraybox = array('warning','success','info','danger');
$resarray = array_rand($arraybox);
$thenarray = $arraybox[$resarray];
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

        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="reject")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
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
					  <th style="width:5%;display:none;" >ID</th>
					  <th>Nama</th>
					  <th>Status</th>
					</tr>
				</thead>
			</table>
        </div>
        <div class="box-footer">

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
elseif ($page=="reject_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_radiologi/reject/simpan_tambah');?>" onClick="return cek();">
      <input type="hidden" name="id_unit" value="">
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
					<div class="container col-md-12">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
								  <label>Nama</label>
									<?php
										input_text("nama_reject",$nama_reject,"maxlength='255' required autofocus","Masukkan Nama","text");
									?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
								  <label>Status</label>
										<?php
											input_pdselect2("status_reject",$cmd_status,$status_reject);
										?>
								</div>
							</div>
						 </div>
					</div>
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
elseif ($page=="reject_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_radiologi/reject/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_reject" value="<?= $id; ?>">
		<input type="hidden" name="pembuat_reject" value="<?= $pembuat_reject; ?>">
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
					<div class="container col-md-12">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
								  <label>Nama</label>
									<?php
										input_text("nama_reject",$nama_reject,"maxlength='255' required autofocus","Masukkan Nama","text");
									?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
								  <label>Status</label>
										<?php
											input_pdselect2("status_reject",$cmd_status,$status_reject);
										?>
								</div>
							</div>
						 </div>
					</div>
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
elseif ($page=="fokus")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
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
					  <th width="5%">ID</th>
					  <th>Nama</th>
					</tr>
				</thead>
			</table>
        </div>
        <div class="box-footer">

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
elseif ($page=="fokus_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_radiologi/fokus/simpan_tambah');?>" onClick="return cek();">
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
					<div class="container col-md-12">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
								  <label>Nama</label>
									<?php
										input_text("nama_field_size",$nama_field_size,"maxlength='255' required autofocus","Masukkan Nama","text");
									?>
								</div>
							</div>
						 </div>
					</div>
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
elseif ($page=="fokus_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_radiologi/fokus/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_field_size" value="<?= $id; ?>">
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
					<div class="container col-md-12">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
								  <label>Nama</label>
									<?php
										input_text("nama_field_size",$nama_field_size,"maxlength='255' required autofocus","Masukkan Nama","text");
									?>
								</div>
							</div>
						 </div>
					</div>
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
elseif ($page=="thickness")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
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
					  <th width="5%">ID</th>
					  <th>Nama</th>
					  <th>Fat</th>
					  <th>Ketebalan</th>
					  <th>Deskripsi</th>
					</tr>
				</thead>
			</table>
        </div>
        <div class="box-footer">

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
elseif ($page=="thickness_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_radiologi/thickness/simpan_tambah');?>" onClick="return cek();">
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
							<div class="col-md-6">
								  <label>Nama</label>
									<?php
										input_text("nama_thickness",$nama_thickness,"maxlength='255' required autofocus","Masukkan Nama","text");
									?>
							</div>
              <div class="col-md-6">
								  <label>Fat</label>
									<?php
                  input_pdselect2("fat",$cmd_fat,$fat);
									?>
							</div>
              <div class="col-md-6">
								  <label>Ketebalan</label>
									<?php
                  input_textcustom("thickness",$thickness," style='text-align:right;' required
  											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber debet'",
  													"Nominal Transaksi","text");
									?>
							</div>
							<div class="col-md-6">
								  <label>Deskripsi</label>
                  <?php
										input_text("deskripsi_thickness",$deskripsi_thickness,"maxlength='255' required autofocus","Masukkan Deskripsi","text");
									?>
							</div>
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
elseif ($page=="thickness_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_radiologi/thickness/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_thickness" value="<?= $id; ?>">
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
          <div class="col-md-6">
              <label>Nama</label>
              <?php
                input_text("nama_thickness",$nama_thickness,"maxlength='255' required autofocus","Masukkan Nama","text");
              ?>
          </div>
          <div class="col-md-6">
              <label>Fat</label>
              <?php
              input_pdselect2("fat",$cmd_fat,$fat);
              ?>
          </div>
          <div class="col-md-6">
              <label>Ketebalan</label>
              <?php
              input_textcustom("thickness",$thickness," style='text-align:right;' required
                    onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber debet'",
                        "Nominal Transaksi","text");
              ?>
          </div>
          <div class="col-md-6">
              <label>Deskripsi</label>
              <?php
                input_text("deskripsi_thickness",$deskripsi_thickness,"maxlength='255' required autofocus","Masukkan Deskripsi","text");
              ?>
          </div>
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
elseif ($page=="fe")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
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
					  <th style="display:none;width: 5%;">ID</th>
					  <th>Tindakan</th>
					  <th>Obyek</th>
					  <th>Fokus</th>
					  <th>Ketebalan</th>
					  <th>Kv - mAs - FPD</th>
					  <th>Grid</th>
					</tr>
				</thead>
			</table>
        </div>
        <div class="box-footer">

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
elseif ($page=="bakhp")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
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
					  <th width="5%">ID</th>
					  <th>Tindakan</th>
					  <th>BAKHP</th>
					  <th>Jumlah</th>
					  <th>Satuan</th>
            <th>Status</th>
					</tr>
				</thead>
			</table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="fe_tambah" || $page=="bakhp_tambah")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
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
					  <th width="5%">ID</th>
					  <th>Tindakan</th>
					  <th>Golongan</th>
					</tr>
				</thead>
			</table>
        </div>
        <div class="box-footer">

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
elseif ($page=="fe_tambah_fe")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_radiologi/fe/simpan_tambah_fe');?>" onClick="return cek();">
		<input type="hidden" name="id_tindakan" value="<?= $id; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title"><?php $nama_tindakan; ?></h3>
			</div>
			  <div class="box-body">
          <?php
					foreach($fat as $rowfat){
            $kondisi_fe=array('id_tindakan'=>$id,'id_proyeksi'=>$rowfat['id_proyeksi']);
          	$jml_fe = $this->m_umum->jumlah_record_filter('radiologi_fe',$kondisi_fe);
            if($jml_fe == 0){
              $kv = 0;
              $mas = 0;
              $fpd = 0;
              $thickness = 0;
              $grid = set_value('grid',$this->input->post("grid"));
              $id_field_size = set_value('id_field_size',$this->input->post("id_field_size"));
              $id_proyeksi = $rowfat['id_proyeksi'];
            }else{
              $fe = $this->m_rancak->fe_fat($id,$rowfat['id_proyeksi']);
              $kv = round($fe['kv'],1);
              $mas = round($fe['mas'],5);
              $fpd = round($fe['fpd'],1);
              $thickness = round($fe['thickness'],1);
              $id_field_size = $fe['id_field_size'];
              $id_proyeksi = $fe['id_proyeksi'];
              $grid = $fe['grid'];
            }

					?>
          <input type="hidden" name="id_proyeksi[]" value="<?= $id_proyeksi; ?>">
          <div class="col-md-12">
            <div class="col-md-3">
                <label>Proyeksi</label>
                <?php
                  input_text("nama_proyeksi",$rowfat['nama_proyeksi'],"maxlength='255' readonly","","text");
                ?>
            </div>
            <div class="col-md-3">
                <label>Fokus</label>
                <?php
                  input_pdselect2("id_field_size[]",$field_size,$id_field_size);
                ?>
            </div>
            <div class="col-md-2">
                <label>kV</label>
                <?php
                input_textcustom("kv[]",$kv," style='text-align:right;' required
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46' class='form-control'",
                          "Nominal Transaksi","text");
                ?>
            </div>
            <div class="col-md-2">
                <label>mAs</label>
                <?php
                input_textcustom("mas[]",$mas," style='text-align:right;' required
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46' class='form-control'",
                          "Nominal Transaksi","text");
                ?>
            </div>
            <div class="col-md-2">
                <label>FPD</label>
                <?php
                input_textcustom("fpd[]",$fpd," style='text-align:right;' required
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46' class='form-control'",
                          "Nominal Transaksi","text");
                ?>
            </div>
            <div class="col-md-2">
                <label>Ketebalan</label>
                <?php
                input_textcustom("thickness[]",$thickness," style='text-align:right;' required
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46' class='form-control'",
                          "Nominal Transaksi","text");
                ?>
            </div>
            <div class="col-md-3">
                <label>Grid</label>
                <?php
                  input_pdselect2("grid[]",$cmd_grid,$grid);
                ?>
            </div>
          </div>
          <?php
          }
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
elseif ($page=="fe_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_radiologi/fe/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_fe" value="<?= $id_fe; ?>">
		<input type="hidden" name="id_tindakan" value="<?= $id_tindakan; ?>">
		<input type="hidden" name="id_proyeksi_lama" value="<?= $id_proyeksi; ?>">
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
            <div class="col-md-3">
                <label>Fokus</label>
                <?php
                  input_pdselect2("id_field_size",$field_size,$id_field_size);
                ?>
            </div>
            <div class="col-md-2">
                <label>kV</label>
                <?php
                input_textcustom("kv",$kv," style='text-align:right;' required
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46' class='form-control'",
                          "Nominal Transaksi","text");
                ?>
            </div>
            <div class="col-md-2">
                <label>mAs</label>
                <?php
                input_textcustom("mas",$mas," style='text-align:right;' required
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46' class='form-control'",
                          "Nominal Transaksi","text");
                ?>
            </div>
            <div class="col-md-2">
                <label>FPD</label>
                <?php
                input_textcustom("fpd",$fpd," style='text-align:right;' required
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46' class='form-control'",
                          "Nominal Transaksi","text");
                ?>
            </div>
            <div class="col-md-2">
                <label>Ketebalan</label>
                <?php
                input_textcustom("thickness",$thickness," style='text-align:right;' required
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46' class='form-control'",
                          "Nominal Transaksi","text");
                ?>
            </div>
            <div class="col-md-3">
                <label>Grid</label>
                <?php
                  input_pdselect2("grid",$cmd_grid,$grid);
                ?>
            </div>
          </div>
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
elseif ($page=="bakhp_tambah_bakhp")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_radiologi/bakhp/simpan_tambah_bakhp');?>" onClick="return cek();">
		<input type="hidden" name="id_tindakan" value="<?= $id; ?>">
		<input type="hidden" name="id_unit" value="<?= $unit_id; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">BAKHP, ISI JIKA RUBAH / TAMBAH</h3>
			</div>
			  <div class="box-body">
          <table id="example1" width="100%" class="table table-bordered table-striped">
    			  <thead>
    				<tr>
    					<th style="background-color:#9b0e27;color:white;text-align: center;vertical-align:middle;">BAKHP</th>
    					<th style="background-color:#9b0e27;color:white;text-align: center;vertical-align:middle;">Jumlah</th>
    					<th style="background-color:#9b0e27;color:white;text-align: center;vertical-align:middle;">Satuan</th>
    					<th style="background-color:#9b0e27;color:white;text-align: center;vertical-align:middle;">Status</th>
    				</tr>
    			  </thead>
    			  <tbody>
    					<?php
    					foreach($bakhp_tindakan as $rowbakhp_tindakan){
    					?>
    				<tr>
    					<td style="vertical-align:middle;"><?php echo $rowbakhp_tindakan['nama_barang']; ?></td>
    					<td style="vertical-align:middle;"><?php echo $rowbakhp_tindakan['jml_pemeriksaan_bakhp']; ?></td>
    					<td style="vertical-align:middle;"><?php echo $rowbakhp_tindakan['nama_satuan']; ?></td>
    					<td style="vertical-align:middle;"><?php echo $rowbakhp_tindakan['status_pemeriksaan_bakhp']; ?></td>
    				</tr>
    					<?php
    					}
    					?>
    			  </tbody>
    		  </table><hr>
          <?php
					foreach($bakhp as $rowbakhp){
					?>
          <input type="hidden" name="id_barang[]" value="<?= $rowbakhp['id_barang']; ?>">
          <div class="col-md-12">
            <div class="col-md-3">
                <label>BAKHP</label>
                <?php
                  input_text("nama_barang",$rowbakhp['nama_barang'],"maxlength='255' readonly","","text");
                ?>
            </div>
            <div class="col-md-3">
                <label>Jumlah</label>
                <?php
                input_textcustom("jml_pemeriksaan_bakhp[]",$jml_pemeriksaan_bakhp," style='text-align:right;' required
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                          "Jumlah Pemakaian","text");
                ?>
            </div>
            <div class="col-md-3">
                <label>Satuan</label>
                <?php
                  input_pdselect2("id_satuan[]",$cmd_satuan_barang,$id_satuan);
                ?>
            </div>
            <div class="col-md-3">
                <label>Status</label>
                <?php
                  input_pdselect2("status_pemeriksaan_bakhp[]",$cmd_status,$status_pemeriksaan_bakhp);
                ?>
            </div>
          </div>
          <?php
          }
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
elseif ($page=="program_tr_tindakan")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
      <?php echo form_open('Admin_radiologi/program_tr/tindakan',' ');
  	  input_text("id_program_tr",$id_program_tr,"","","hidden"); ?>
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
          <table id="example1" width="100%" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th style="background-color:#9b0e27;color:white;vertical-align:middle;">
                <input name="select_all" class="checkall" type="checkbox" />
              </th>
              <th style="background-color:#9b0e27;color:white;vertical-align:middle;">ID</th>
              <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Unit</th>
            </tr>
            </thead>
            <tbody>
              <?php
              $no=0;
              foreach($tindakan_4programtr as $row){
                $no++;
              ?>
            <tr>
              <td style="vertical-align:middle;">
                <div class="checkbox">
                <label>
                  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_tindakan'];?>"
                  <?php if(in_array($row['id_tindakan'],$tindakan)) echo 'checked="checked"'; ?> >
                </label>
                </div>
              </td>
              <td style="vertical-align:middle;"><?php echo $row['id_tindakan'];?></td>
              <td style="vertical-align:middle;"><?php echo $row['nama_tindakan'];?></td>
            </tr>
              <?php
                }
              ?>
            </tbody>
          </table>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
      <?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="program_tr_unit")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
      <?php echo form_open('Admin_radiologi/program_tr/unit',' ');
  	  input_text("id_program_tr",$id_program_tr,"","","hidden"); ?>
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
          <table id="example1" width="100%" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th style="background-color:#9b0e27;color:white;vertical-align:middle;">
                <input name="select_all" class="checkall" type="checkbox" />
              </th>
              <th style="background-color:#9b0e27;color:white;vertical-align:middle;">ID</th>
              <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Unit</th>
            </tr>
            </thead>
            <tbody>
              <?php
              $no=0;
              foreach($unit_4programtr as $row){
                $no++;
              ?>
            <tr>
              <td style="vertical-align:middle;">
                <div class="checkbox">
                <label>
                  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_struktur_jabatan'];?>"
                  <?php if(in_array($row['id_struktur_jabatan'],$struktur_jabatan)) echo 'checked="checked"'; ?> >
                </label>
                </div>
              </td>
              <td style="vertical-align:middle;"><?php echo $row['id_struktur_jabatan'];?></td>
              <td style="vertical-align:middle;"><?php echo $row['nama_struktur_jabatan'];?></td>
            </tr>
              <?php
                }
              ?>
            </tbody>
          </table>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
      <?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="program_tr")
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
			<?php
				input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
			?>
          </div>
        </div>
        <div class="box-body">
			<table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
				<thead>
          <tr>
					  <th>Tindakan</th>
					  <th>Minimal Waktu (Jam)</th>
					  <th>Waktu Awal Efektif</th>
					  <th>Waktu Akhir Efektif</th>
					</tr>
				</thead>
			</table>
        </div>
        <div class="box-footer">

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
elseif ($page=="program_tr_waktu")
{
?>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('Admin_radiologi/program_tr/aksi_waktu');?>" onClick="return cek();">
      <input type="hidden" name="id_program_tr" value="<?= $id_program_tr; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">GOLONGAN</h3>
			</div>
			  <div class="box-body">
          <div class="col-md-12">
  					<div class="form-group">
  					  <label>Waktu Maximal Time Respon</label>
  						<?php
  							input_textcustom("time",$time," class='form-control' id='time' ","","text");
  						?>
  					</div>
  				</div>
  				<div class="col-md-5">
  					<div class="form-group">
  					  <label>Waktu Awal Efektif</label>
  						<?php
  							input_textcustom("begin_time",$begin_time," class='form-control' id='begin_time' ","","text");
  						?>

  					</div>
  				</div>
  				<div class="col-md-1">
  				</div>
  				<div class="col-md-6">
  					<div class="form-group">
  					  <label>Waktu Akhir Efektif</label>
  						<?php
  							input_textcustom("end_time",$end_time," class='form-control' id='end_time' ","","text");
  						?>

  					</div>
  				</div>
			  </div>
		  </div>
        </div>
        <div class="box-footer">
			<button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
	  </FORM>
<script type="text/javascript">
$("#time").inputmask("hh:mm:ss", {
  placeholder: "HH:MM:SS",
  insertMode: false,
  showMaskOnHover: false,
});
$("#begin_time").inputmask("hh:mm:ss", {
  placeholder: "HH:MM:SS",
  insertMode: false,
  showMaskOnHover: false,
});
$("#end_time").inputmask("hh:mm:ss", {
  placeholder: "HH:MM:SS",
  insertMode: false,
  showMaskOnHover: false,
});
</script>
<?php
}
elseif ($page=="program_tr_dayofweek")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
<FORM method="POST" class="form-horizontal" action="<?php echo base_url('Admin_radiologi/program_tr/aksi_dayofweek');?>" onClick="return cek();">
<input type="hidden" name="id_program_tr" value="<?= $id_program_tr; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">TINDAKAN</h3>
			</div>
			  <div class="box-body">
          <div class="col-md-12">
  					<div class="form-group">
  					  <label>Hari Efektif</label>
  						<?php
  							checkboxflatred("id_dayofweek","id_dayofweek[]",$kol_dayofweek,"id_dayofweek","nama_dayofweek",$id_dayofweek,"flat-red","<br>","","array");
  						?>
  					</div>
  				</div>
			  </div>
		  </div>
        </div>
        <div class="box-footer">
			<button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
	  </FORM>
<script type="text/javascript">
$(document).ready(function () {
	$('.select2').select2()
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
	  radioClass   : 'iradio_minimal-blue'
    })
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
	  radioClass   : 'iradio_minimal-red'
    })
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
	  radioClass   : 'iradio_flat-green'
    })
});
</script>
<?php
}
elseif ($page=="pie")
{
?>
<style>
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>
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
          <?php echo form_open('admin_radiologi/pie/view/'.$first_date.'/'.$last_date,' class="form-horizontal"'); ?>
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
              <div class="col-md-6">
      					<label>Tanggal Mulai</label>
      					<?php
      						input_calendar("first_date","first_date",$first_date,"Masukkan Tanggal"," required");
      					?>
      				</div>
      				<div class="col-md-6">
      					<label>Tanggal Akhir</label>
      					<?php
      						input_calendar("last_date","last_date",$last_date,"Masukkan Tanggal"," required");
      					?>
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
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
                <div id="chartdiv"></div>
            </div>
          </div>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="lt" || $page=="lb" || $page=="lh")
{
?>
<style>
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>
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
          <?php echo form_open('admin_radiologi/'.$page.'/view/'.$bln.'/'.$thn,' class="form-horizontal"'); ?>
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
              <div class="col-md-12">
      					<label>Range</label>
      					<?php
      						input_pdselect2("page",$array_page,$page);
      					?>
      				</div>
              <div class="col-md-6">
      					<label>Bulan</label>
      					<?php
      						input_pdselect2("bln",$array_month,$bln);
      					?>
      				</div>
      				<div class="col-md-6">
      					<label>Tanggal Akhir</label>
      					<?php
      						input_pdselect2("thn",$year_logbook,$thn);
      					?>
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
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
                <div id="chartdiv"></div>
            </div>
          </div>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="format_radiologi")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <a href="<?php echo $link_kembali;?>"
				class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
			</a>
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
          <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
    				<thead>
    					<tr>
    					  <th width="5%"></th>
    					  <th>ID</th>
    					  <th>Tindakan</th>
    					  <th>Deskripsi</th>
    					  <th>Radiolog</th>
    					</tr>
    				</thead>
    			</table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="format_radiologi_tambah")
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
      <a href="<?php echo $link_kembali;?>"
				class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
			</a>
    </section>
    <section class="content">
      <?php echo form_open_multipart('normal/format_radiologi/tambah',' ');
      input_text("id_struktur_jabatan",$struktur_jabatan_id,"","","hidden");
       ?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><button type="submit" class="btn btn-xs btn-primary">Submit</button></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="form-group">
            <label>Deskripsi</label>
    <?php
      input_text("nama_normal",$nama_normal,"maxlength='255' autofocus required","Masukkan Deskripsi","text");
    ?>
          </div>
          <div class="form-group">
            <label>Tindakan</label>
    <?php
      input_pdselect2fleksibel("id_tindakan","id_tindakan",$cmd_tindakan,"id_tindakan","nama_tindakan",$id_tindakan,"Silahkan Pilih Tindakan");
    ?>
          </div>
          <div class="form-group">
            <label>Radiolog</label>
    <?php
      input_pdselect2("id_pegawai",$cmd_spesialis,$id_pegawai);
    ?>
          </div>
          <div class="form-group">
            <label>Hasil</label>
    <?php
      input_textareacustom("hasil_normal",$hasil_normal," id='editor1' rows='10' cols='100' class='form-control' ","Masukkan Format Hasil");
    ?>
          </div>
          <div class="form-group">
            <label>Kesimpulan</label>
    <?php
      input_textareacustom("kesimpulan_normal",$kesimpulan_normal," id='editor2' rows='10' cols='100' class='form-control' ","Masukkan Format Kesimpulan");
    ?>
          </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
      <?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="format_radiologi_edit")
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
      <a href="<?php echo $link_kembali;?>"
				class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
			</a>
    </section>
    <section class="content">
      <?php echo form_open_multipart('normal/format_radiologi/edit/'.$id,' ');
      input_text("id_normal",$id,"","","hidden");
      input_text("nama_normal_lama",$nama_normal,"","","hidden");
       ?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><button type="submit" class="btn btn-xs btn-primary">Submit</button></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="form-group">
            <label>Deskripsi</label>
    <?php
      input_text("nama_normal",$nama_normal,"maxlength='255' autofocus required","Masukkan Deskripsi","text");
    ?>
          </div>
          <div class="form-group">
            <label>Tindakan</label>
    <?php
      input_pdselect2fleksibel("id_tindakan","id_tindakan",$cmd_tindakan,"id_tindakan","nama_tindakan",$id_tindakan,"Silahkan Pilih Tindakan");
    ?>
          </div>
          <div class="form-group">
            <label>Radiolog</label>
    <?php
      input_pdselect2("id_pegawai",$cmd_spesialis,$id_pegawai);
    ?>
          </div>
          <div class="form-group">
            <label>Hasil</label>
    <?php
      input_textareacustom("hasil_normal",$hasil_normal," id='editor1' rows='10' cols='100' class='form-control' ","Masukkan Format Hasil");
    ?>
          </div>
          <div class="form-group">
            <label>Kesimpulan</label>
    <?php
      input_textareacustom("kesimpulan_normal",$kesimpulan_normal," id='editor2' rows='10' cols='100' class='form-control' ","Masukkan Format Kesimpulan");
    ?>
          </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
      <?php echo form_close(); ?>
    </section>
</div>
<?php
}
