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
elseif ($page=="pabrik")
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
					  <th style="display:none;width: 5%;">ID</th>
					  <th>Nama</th>
					  <th>Kontak</th>
					  <th>Alamat</th>
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
elseif ($page=="pabrik_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_apotek/pabrik/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">     
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title"><?= $title ?></h3>
			</div>
			  <div class="box-body">
						<div class="row">
							<div class="col-md-6">
								  <label>Nama Pabrik</label>
									<?php
										input_text("nama_pabrik",$nama_pabrik,"maxlength='255' required autofocus","Masukkan Nama","text");
									?>	
							</div>		
							<div class="col-md-6">
								  <label>Kode Rekening</label>
									<?php
										input_text("kode_rekening",$kode_rekening,"maxlength='5' ","Masukkan Nama","text");
									?>	
							</div>
							<div class="col-md-6">
								  <label>Kontak Pabrik</label>
									<?php
										input_text("kontak_pabrik",$kontak_pabrik,"maxlength='255' ","Masukkan Nama","text");
									?>	
							</div>
							<div class="col-md-6">
								  <label>Status</label>
										<?php
											input_pdselect2("status_pabrik",$cmd_status,$status_pabrik);
										?>					
							</div>							
							<div class="col-md-12">
								  <label>Alamat Pabrik</label>
									<?php
										input_text("alamat_pabrik",$alamat_pabrik,"maxlength='255' ","Masukkan Nama","text");
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
elseif ($page=="pabrik_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_apotek/pabrik/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_pabrik" value="<?= $id; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">     
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title"><?= $title ?></h3>
			</div>
			  <div class="box-body">
						<div class="row">
							<div class="col-md-6">
								  <label>Nama Pabrik</label>
									<?php
										input_text("nama_pabrik",$nama_pabrik,"maxlength='255' required autofocus","Masukkan Nama","text");
									?>	
							</div>		
							<div class="col-md-6">
								  <label>Kode Rekening</label>
									<?php
										input_text("kode_rekening",$kode_rekening,"maxlength='5' ","Masukkan Nama","text");
									?>	
							</div>
							<div class="col-md-6">
								  <label>Kontak Pabrik</label>
									<?php
										input_text("kontak_pabrik",$kontak_pabrik,"maxlength='255' ","Masukkan Nama","text");
									?>	
							</div>
							<div class="col-md-6">
								  <label>Status</label>
										<?php
											input_pdselect2("status_pabrik",$cmd_status,$status_pabrik);
										?>					
							</div>							
							<div class="col-md-12">
								  <label>Alamat Pabrik</label>
									<?php
										input_text("alamat_pabrik",$alamat_pabrik,"maxlength='255' ","Masukkan Nama","text");
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
elseif ($page=="supplier")
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
					  <th style="display:none;width: 5%;">ID</th>
					  <th>Nama</th>
					  <th>Kontak</th>
					  <th>Alamat</th>
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
elseif ($page=="supplier_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_apotek/supplier/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">     
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title"><?= $title ?></h3>
			</div>
			  <div class="box-body">
						<div class="row">
							<div class="col-md-6">
								  <label>Nama supplier</label>
									<?php
										input_text("nama_supplier",$nama_supplier,"maxlength='255' required autofocus","Masukkan Nama","text");
									?>	
							</div>		
							<div class="col-md-6">
								  <label>Kontak supplier</label>
									<?php
										input_text("kontak_supplier",$kontak_supplier,"maxlength='255' ","Masukkan Nama","text");
									?>	
							</div>
							<div class="col-md-6">
								  <label>Status</label>
										<?php
											input_pdselect2("status_supplier",$cmd_status,$status_supplier);
										?>					
							</div>							
							<div class="col-md-6">
								  <label>Alamat supplier</label>
									<?php
										input_text("alamat_supplier",$alamat_supplier,"maxlength='255' ","Masukkan Nama","text");
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
elseif ($page=="supplier_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_apotek/supplier/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_supplier" value="<?= $id; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">     
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title"><?= $title ?></h3>
			</div>
			  <div class="box-body">
						<div class="row">
							<div class="col-md-6">
								  <label>Nama supplier</label>
									<?php
										input_text("nama_supplier",$nama_supplier,"maxlength='255' required autofocus","Masukkan Nama","text");
									?>	
							</div>		
							<div class="col-md-6">
								  <label>Kontak supplier</label>
									<?php
										input_text("kontak_supplier",$kontak_supplier,"maxlength='255' ","Masukkan Nama","text");
									?>	
							</div>
							<div class="col-md-6">
								  <label>Status</label>
										<?php
											input_pdselect2("status_supplier",$cmd_status,$status_supplier);
										?>					
							</div>							
							<div class="col-md-6">
								  <label>Alamat supplier</label>
									<?php
										input_text("alamat_supplier",$alamat_supplier,"maxlength='255' ","Masukkan Nama","text");
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
elseif ($page=="customer")
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
					  <th style="display:none;width: 5%;">ID</th>
					  <th>Nama</th>
					  <th>Kontak</th>
					  <th>Alamat</th>
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
elseif ($page=="customer_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_apotek/customer/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">     
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title"><?= $title ?></h3>
			</div>
			  <div class="box-body">
						<div class="row">
							<div class="col-md-6">
								  <label>Nama customer</label>
									<?php
										input_text("nama_customer",$nama_customer,"maxlength='255' required autofocus","Masukkan Nama","text");
									?>	
							</div>		
							<div class="col-md-6">
								  <label>Kontak customer</label>
									<?php
										input_text("kontak_customer",$kontak_customer,"maxlength='255' ","Masukkan Nama","text");
									?>	
							</div>
							<div class="col-md-6">
								  <label>Status</label>
										<?php
											input_pdselect2("status_customer",$cmd_status,$status_customer);
										?>					
							</div>							
							<div class="col-md-6">
								  <label>Alamat customer</label>
									<?php
										input_text("alamat_customer",$alamat_customer,"maxlength='255' ","Masukkan Nama","text");
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
elseif ($page=="customer_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_apotek/customer/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_customer" value="<?= $id; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">     
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title"><?= $title ?></h3>
			</div>
			  <div class="box-body">
						<div class="row">
							<div class="col-md-6">
								  <label>Nama customer</label>
									<?php
										input_text("nama_customer",$nama_customer,"maxlength='255' required autofocus","Masukkan Nama","text");
									?>	
							</div>		
							<div class="col-md-6">
								  <label>Kontak customer</label>
									<?php
										input_text("kontak_customer",$kontak_customer,"maxlength='255' ","Masukkan Nama","text");
									?>	
							</div>
							<div class="col-md-6">
								  <label>Status</label>
										<?php
											input_pdselect2("status_customer",$cmd_status,$status_customer);
										?>					
							</div>							
							<div class="col-md-6">
								  <label>Alamat customer</label>
									<?php
										input_text("alamat_customer",$alamat_customer,"maxlength='255' ","Masukkan Nama","text");
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
elseif ($page=="barang")
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
					  <th style="display:none;width: 5%;">ID</th>
					  <th>Nama</th>
					  <th>Kategori</th>
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
elseif ($page=="barang_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_apotek/barang/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">     
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title"><?= $title ?></h3>
			</div>
			  <div class="box-body">
						<div class="row">
							<div class="col-md-12">
								  <label>Nama Barang</label>
									<?php
										input_text("nama_barang",$nama_barang,"maxlength='255' required autofocus","Masukkan Nama","text");
									?>	
							</div>		
							<div class="col-md-6">
								  <label>Kategori</label>
										<?php
											input_pdselect2("id_item_kategori",$item_kategori,$id_item_kategori);
										?>					
							</div>
							<div class="col-md-6">
								  <label>Status</label>
										<?php
											input_pdselect2("status_barang",$cmd_status,$status_barang);
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
elseif ($page=="barang_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_apotek/barang/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_barang" value="<?= $id; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">     
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title"><?= $title ?></h3>
			</div>
			  <div class="box-body">
						<div class="row">
							<div class="col-md-12">
								  <label>Nama Barang</label>
									<?php
										input_text("nama_barang",$nama_barang,"maxlength='255' required autofocus","Masukkan Nama","text");
									?>	
							</div>		
							<div class="col-md-6">
								  <label>Kategori</label>
										<?php
											input_pdselect2("id_item_kategori",$item_kategori,$id_item_kategori);
										?>					
							</div>
							<div class="col-md-6">
								  <label>Status</label>
										<?php
											input_pdselect2("status_barang",$cmd_status,$status_barang);
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
elseif ($page=="termin")
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
					  <th style="display:none;width: 5%;">ID</th>
					  <th>Nama</th>
					  <th>Tempo</th>
					  <th>Keterangan</th>
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
elseif ($page=="termin_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_apotek/termin/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">     
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title"><?= $title ?></h3>
			</div>
			  <div class="box-body">
						<div class="row">
							<div class="col-md-6">
								  <label>Nama Termin</label>
									<?php
										input_text("nama_termin",$nama_termin,"maxlength='255' required autofocus","Masukkan Nama","text");
									?>	
							</div>		
							<div class="col-md-6">
								  <label>Tempo</label>
									<?php
									input_textcustom("tempo_termin",$tempo_termin," required
												onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
														"Ketikkan No HP format kode negara","text");
									?>	
							</div>
							<div class="col-md-6">
								  <label>Status</label>
										<?php
											input_pdselect2("status_termin",$cmd_status,$status_termin);
										?>					
							</div>							
							<div class="col-md-6">
								  <label>Keterangan</label>
									<?php
										input_text("ket_termin",$ket_termin,"maxlength='255' ","Masukkan Keterangan","text");
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
elseif ($page=="termin_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_apotek/termin/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_termin" value="<?= $id; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">     
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title"><?= $title ?></h3>
			</div>
			  <div class="box-body">
						<div class="row">
							<div class="col-md-6">
								  <label>Nama Termin</label>
									<?php
										input_text("nama_termin",$nama_termin,"maxlength='255' required autofocus","Masukkan Nama","text");
									?>	
							</div>		
							<div class="col-md-6">
								  <label>Tempo</label>
									<?php
									input_textcustom("tempo_termin",$tempo_termin," required
												onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
														"Ketikkan No HP format kode negara","text");
									?>	
							</div>
							<div class="col-md-6">
								  <label>Status</label>
										<?php
											input_pdselect2("status_termin",$cmd_status,$status_termin);
										?>					
							</div>							
							<div class="col-md-6">
								  <label>Keterangan</label>
									<?php
										input_text("ket_termin",$ket_termin,"maxlength='255' ","Masukkan Keterangan","text");
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
elseif ($page=="pembelian")
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
      <h1>
        <?php echo $instance_name; ?> <small></small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">    
			<?php echo form_open_multipart('admin_apotek/pembelian/view/'.$date.'/'.$first_date.'/'.$last_date,' id="signupform" '); ?>
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
			</div>
			  <div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
						  <label>Opsi Pencarian</label>
								<?php
									input_pdselect2("date",$dates,$date);
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
						  <th width="5%"></th>
						  <th style="display:none;width:5%;">ID</th>
						  <th style="width:10%;">Tanggal</th>
						  <th style="width:10%;">No</th>
						  <th>Supplier</th>
						  <th>Termin</th>
						  <th>Status</th>
						</tr>
					</thead>
				</table>
			</div>
			<div class="box-footer">

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
       <?php echo $instance_name; ?>
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
elseif ($page=="pembelian_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_apotek/pembelian/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">     
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title"><?= $title ?></h3>
			</div>
			  <div class="box-body">
						<div class="row">
							<div class="col-md-6">
								  <label>Tanggal Pembelian</label>
									<?php
										input_calendar("tgl_pembelian","tgl_pembelian",$tgl_pembelian,"Masukkan Tanggal Transaksi","required");
									?>	
							</div>		
							<div class="col-md-6">
								  <label>No Faktur</label>
									<?php
										input_text("no_pembelian",$no_pembelian,"maxlength='255' ","Masukkan No Pembelian","text");
									?>	
							</div>					
							<div class="col-md-6">
								  <label>Termin</label>
										<?php
               input_pdselect2fleksibel("id_termin","id_termin",$cmd_termin,"id_termin","nama_termin",$id_termin,"CASH");
										?>					
							</div>		
							<div class="col-md-6">
								  <label>Supplier</label>
										<?php
											input_pdselect2("id_supplier",$cmd_supplier,$id_supplier);
										?>					
							</div>							
							<div class="col-md-6">
								  <label>Kontak Person</label>
									<?php
										input_text("cp",$cp,"maxlength='255' ","Masukkan Kontak Person","text");
									?>	
							</div>
							<div class="col-md-6">
								  <label>Alamat</label>
									<?php
										input_text("alamat_cp",$alamat_cp,"maxlength='255' ","Masukkan Alamat Kontak Person","text");
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
    $('#tgl_pembelian').datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true
    })
	$("#tgl_pembelian").inputmask("datetime", {
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
elseif ($page=="pembelian_editsssss")
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
			class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
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
		  <?php echo form_open_multipart('admin_apotek/pembelian/edit/'.$date,' id="signupform" ');  

		  ?>
		<div class="box-body">     
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">TRANSAKSI</h3>
			</div>
			  <div class="box-body">
				<div class="row">
						<div class="col-md-3">
							<div class="form-group">
							  <label>Tanggal</label>
									<?php
										input_calendar("tgl_pembelian","tgl_pembelian",$tgl_pembelian,"Masukkan Tanggal"," required");
									?>	
							</div>					
						</div>
						<div class="col-md-2">
							<div class="form-group">
							  <label>No Faktur</label>
								<?php
									input_text("no_pembelian",$no_pembelian,"maxlength='25' required autofocus","Masukkan No","text");
								?>	
							</div>				
						</div>
						<div class="col-md-4">
							<div class="form-group">
							  <label>Supplier</label>
								<?php
									input_pdselect2("id_supplier",$cmd_supplier,$id_supplier);
								?>	
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
							  <label>Keterangan</label>
								<?php
									input_text("ket_pembelian",$ket_pembelian,"maxlength='255' ","Ketik Bila Ada Keterangan","text");
								?>	
							</div>				
						</div>
						<div class="col-md-2">
							<div class="form-group">
							  <label>Tunai / Termin</label>
								<?php
									input_pdselect2fleksibel("id_termin","id_termin",$cmd_termin,"id_termin","nama_termin",$id_termin,"CASH");
								?>	
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
							  <label>Pajak</label>
									<?php
										input_pdselect2("pajak",$cmd_pajak,$pajak);
									?>	
							</div>					
						</div>
						<div class="col-md-4">
							<div class="form-group">
							  <label>Kontak Person</label>
								<?php
									input_text("cp",$cp,"maxlength='255' ","Kontak Person","text");
								?>	
							</div>		
						</div>	
						<div class="col-md-4">
							<div class="form-group">
							  <label>Alamat Kontak</label>
								<?php
									input_text("alamat_cp",$alamat_cp,"maxlength='255' ","Alamat Kontak Person","text");
								?>	
							</div>						
						</div>						
				</div>	
			  </div>
		  </div>
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">COA</h3>
			</div>
			  <div class="box-body">
				<div class="row">			
					<div class="table-responsive" tabindex="-1">
					<div class="col-md-12">
					  <table id="item_table" class="table table-hover table-transaksi table-sm">
						<thead class="bg-light">
						  <tr style="background-color: #800000;color: white;">
							<th class="text-sm text-label text-center border-0" style="width: 20%">Nama Barang</th>
							<th class="text-sm text-label text-center border-0" style="width: 10%">Qty</th>
							<th class="text-sm text-label text-center border-0" style="width: 20%">Pabrik</th>
							<th class="text-sm text-label text-center border-0" style="width: 10%">Harga</th>
							<th class="text-sm text-label text-center border-0" style="width: 10%">Diskon</th>
							<th class="text-sm text-label text-center border-0">Disc %</th>
							<th class="text-sm text-label text-center border-0" style="width: 15%">Jumlah</th>
							<th class="text-sm text-label text-center border-0" style="width: 7%">&nbsp;</th>
						  </tr>
						</thead>
						<tbody>
						  <tr>
							<td class="text-sm text-label border-0">
							<?php
							input_pdselect2url("id_barang","id_barang[]","select_barang form-control select2","required='required'","Pilih Barang");
							?>								
							</td>
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("jml_pembelian_detil[]",$jml_pembelian_detil," style='text-align:right;' required
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control jml'",
													"Jumlah","text");					
							?>								
							</td>  
							<td class="text-sm text-label border-0">
							<?php 
								input_pdselect2url("id_pabrik","id_pabrik[]","select_pabrik form-control select2","required='required'","Pilih pabrik");			
							?>							
							</td>                                  
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("harga_pembelian_detil[]",$harga_pembelian_detil," style='text-align:right;' required 
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber harga'",
													"Harga","text");					
							?>								
							</td>     
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("diskon_pembelian_detil[]",$diskon_pembelian_detil," style='text-align:right;' required 
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber diskon'",
													"Kurs Transaksi","text");					
							?>								
							</td> 			
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("persen_pembelian[]",$persen_pembelian," style='text-align:right;' required 
											maxlength='3' onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control persen'",
													"Persen","text");	
							?>								
							</td> 	
							<td class="text-sm text-label border-0">
								<?php 			
									input_textcustom("total_pembelian_detil",$total_pembelian_detil," style='text-align:right;' required readonly
													onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber total'",
															"Total","text");								
								?>	
							</td>
							<td class="text-sm text-label border-0">&nbsp;</td>							
						  </tr>
						  <tr style="background-color: #800000;color: white;">
							<td class="text-sm text-label text-left border-0">Satuan Besar</td>                             
							<td class="text-sm text-label text-left border-0">Konversi</td>      						
							<td class="text-sm text-label text-left border-0">Satuan Kecil</td>
							<td colspan="5" class="text-sm text-label text-left border-0">Keterangan</td>
						  </tr>		
						  <tr>

							<td class="text-sm text-label border-0">
							<?php
								input_pdselect2url("satuan_besar","satuan_besar","select_satuan form-control select2"," ","Satuan Besar");
							?>							
							</td>                               
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("konversi",$konversi," style='text-align:right;' required
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control konversi'",
													"Konversi","text");					
							?>								
							</td>      							
							<td class="text-sm text-label border-0">
							<?php
								input_pdselect2url("satuan_kecil","satuan_kecil","select_satuan form-control select2","","Satuan Kecil");
							?>							
							</td>  
							<td colspan="5" class="text-sm text-label text-left border-0">
								<?php
									input_text("ket_pembelian_detil[]",$ket_pembelian_detil,"maxlength='255' ","Keterangan","text");
								?>
								</td>	
							</tr>
							<tr id="addDepIt">
								<td colspan="4" style="vertical-align:middle;font-weight:bold;text-align:right;">
									Sub Total
								</td>
								<td class="text-sm text-label border-0">
								<?php 			
									input_textcustom("subtotal_pembelian",$subtotal_pembelian," style='text-align:right;' required readonly id='subtotal_pembelian'
													onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
															"% Diskon","text");								
								?>							
								</td>		
								<td class="text-sm text-label border-0">
								<?php 			
									input_textcustom("diskon_pembelian",$diskon_pembelian," style='text-align:right;' required
													onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber dob'",
															"Diskon","text");								
								?>							
								</td>	
								<td colspan="3" style="vertical-align:middle;font-weight:bold;text-align:left;">
									Diskon Rp Keseluruhan
								</td>								
							</tr>
							<tr>
								<td colspan="4" style="vertical-align:middle;font-weight:bold;text-align:right;">
									PPN
								</td>
								<td class="text-sm text-label border-0">
								<?php 			
									input_textcustom("ppn_pembelian",$ppn_pembelian," style='text-align:right;' required readonly
													onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
															"% Diskon","text");								
								?>							
								</td>	
								<td class="text-sm text-label border-0">
								<?php 			
									input_textcustom("persen_pembelian",$persen_pembelian," style='text-align:right;' required maxlength='3' 
													onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control pob'",
															"% Diskon","text");								
								?>							
								</td>		
								<td colspan="3" style="vertical-align:middle;font-weight:bold;text-align:left;">
									Diskon Persen Keseluruhan
								</td>								
							</tr>
							<tr>
								<td colspan="4" style="vertical-align:middle;font-weight:bold;text-align:right;">
									Total
								</td>
								<td class="text-sm text-label border-0">
								<?php 			
									input_textcustom("total_pembelian",$total_pembelian," style='text-align:right;' required readonly 
													onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
															"% Diskon","text");								
								?>							
								</td>	
															<td class="text-sm text-label border-0">&nbsp;</td>								
							</tr>
						</tbody>
					  </table>
					</div>
					<div class="col-md-12">							
						<button type="button" name="add" class="btn btn-success btn-sm add">
							<span class="glyphicon glyphicon-plus"></span>Tambah Data
						</button>
					</div>
					</div>
				</div>	
			  </div>
		  </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
		<?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="pembelian_diskon")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_apotek/pembelian/simpan_diskon');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
          <input type="hidden" name="id_pembelian" value="<?= $id_pembelian; ?>">
          <input type="hidden" name="barcode_pembelian" value="<?= $barcode_pembelian; ?>">
          </div>
        </div>
		<div class="box-body">     
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title"><?= $title ?></h3>
			</div>
			  <div class="box-body">
						<div class="row">		
							<div class="col-md-6">
								  <label>Diskon</label>
									<?php
								input_textcustom("diskon_pembelian",$diskon_pembelian," style='text-align:right;' required id='diskon_pembelian'
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control number'",
													"Harga","text");
									?>	
							</div>					
							<div class="col-md-6">
								  <label>Jenis Diskon</label>
										<?php
								input_pdselect2('persen_pembelian',$persen,$persen_pembelian);
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
$('input.number').keyup(function(event) {

  // skip for arrow keys
 // if(event.which >= 37 && event.which <= 40) return;

  // format number
  $(this).val(function(index, value) {
    return value
    .replace(/\D/g, "")
    .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    ;
  });
});
$('select').on('change', function(){
  //  $('#pricetwo').val($(this).val());
    document.getElementById('diskon_pembelian').value = 0;
});
</script>
<?php
}
elseif ($page=="pembelian_jual")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_apotek/pembelian/simpan_jual');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
          <input type="hidden" name="barcode_pembelian_detil" value="<?= $date; ?>">
          <input type="hidden" name="barcode_pembelian" value="<?= $first_date; ?>">
          </div>
        </div>
		<div class="box-body">     
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title"><?= $title ?></h3>
			</div>
			  <div class="box-body">
						<div class="row">		
							<div class="col-md-12">
								  <label>Harga Jual</label>
									<?php
								input_textcustom("harga_jual",$harga_jual," style='text-align:right;' required id='harga_jual'
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control number'",
													"Harga","text");
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
$('input.number').keyup(function(event) {

  // skip for arrow keys
 // if(event.which >= 37 && event.which <= 40) return;

  // format number
  $(this).val(function(index, value) {
    return value
    .replace(/\D/g, "")
    .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    ;
  });
});
$('select').on('change', function(){
  //  $('#pricetwo').val($(this).val());
    document.getElementById('diskon_pembelian').value = 0;
});
</script>
<?php
}
elseif ($page=="pembelian_edit")
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
			class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
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
		  <?php echo form_open_multipart('admin_apotek/pembelian/edit/'.$date,' id="signupform" ');  
		input_text("id_pembelian",$id_pembelian,"","","hidden");
		input_text("persen_pembelian",$persen_pembelian,"","","hidden");
		input_text("status_pembelian",$status_pembelian,"","","hidden");
		input_text("barcode_pembelian",$barcode_pembelian,"","","hidden");
		  ?>
		<div class="box-body">     
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">TRANSAKSI</h3>
			</div>
			  <div class="box-body">
				<div class="row">
						<div class="col-md-3">
							<div class="form-group">
							  <label>Tanggal</label>
									<?php
										input_calendar("tgl_pembelian","tgl_pembelian",$tgl_pembelian,"Masukkan Tanggal"," required");
									?>	
							</div>					
						</div>
						<div class="col-md-2">
							<div class="form-group">
							  <label>No Faktur</label>
								<?php
									input_text("no_pembelian",$no_pembelian,"maxlength='25' required autofocus","Masukkan No","text");
								?>	
							</div>				
						</div>
						<div class="col-md-4">
							<div class="form-group">
							  <label>Supplier</label>
								<?php
									input_pdselect2("id_supplier",$cmd_supplier,$id_supplier);
								?>	
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
							  <label>Keterangan</label>
								<?php
									input_text("ket_pembelian",$ket_pembelian,"maxlength='255' ","Ketik Bila Ada Keterangan","text");
								?>	
							</div>				
						</div>
						<div class="col-md-2">
							<div class="form-group">
							  <label>Tunai / Termin</label>
								<?php
									input_pdselect2fleksibel("id_termin","id_termin",$cmd_termin,"id_termin","nama_termin",$id_termin,"CASH");
								?>	
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
							  <label>Pajak</label>
									<?php
										input_pdselect2("pajak",$cmd_pajak,$pajak);
								//	input_pdnoclassnoid('pajak',$cmd_pajak,'pajak',' ','pajak','form-control select2 pajak');
									?>	
							</div>					
						</div>
						<div class="col-md-4">
							<div class="form-group">
							  <label>Kontak Person</label>
								<?php
									input_text("cp",$cp,"maxlength='255' ","Kontak Person","text");
								?>	
							</div>		
						</div>	
						<div class="col-md-4">
							<div class="form-group">
							  <label>Alamat Kontak</label>
								<?php
									input_text("alamat_cp",$alamat_cp,"maxlength='255' ","Alamat Kontak Person","text");
								?>	
							</div>						
						</div>						
				</div>	
			  </div>
        <div class="box-footer">
			<button type="submit" name="action" value="BtnSave" class="btn btn-primary pull-left">
				<i class="glyphicon glyphicon-edit"></i> Rubah
			</button>
        </div>
		  </div>
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">COA</h3>
			</div>
			  <div class="box-body">
				<div class="row">			
					<div class="table-responsive" tabindex="-1">
					<div class="col-md-12">
					  <table id="item_table" class="table table-hover table-transaksi table-sm">
						<thead class="bg-light">
						  <tr style="background-color: #800000;color: white;">
							<th class="text-sm text-label text-center border-0" style="width: 20%">Nama Barang</th>
							<th class="text-sm text-label text-center border-0" style="width: 10%">Qty</th>
							<th class="text-sm text-label text-center border-0" style="width: 20%">Pabrik</th>
							<th class="text-sm text-label text-center border-0" style="width: 10%">Harga</th>
							<th class="text-sm text-label text-center border-0" style="width: 10%">Diskon</th>
							<th class="text-sm text-label text-center border-0">Tipe Disc</th>
							<th class="text-sm text-label text-center border-0" style="width: 15%">Jumlah</th>
						  </tr>
						</thead>
						<tbody>
						  <tr>
							<td class="text-sm text-label border-0">
							<?php
							input_pdselect2url("id_barang","id_barang","select_barang form-control select2","required='required'","Pilih Barang");
							?>								
							</td>
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("jml_pembelian_detil",$jml_pembelian_detil," style='text-align:right;' required
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control jml'",
													"Jumlah","text");					
							?>								
							</td>  
							<td class="text-sm text-label border-0">
							<?php 
								input_pdselect2url("id_pabrik","id_pabrik","select_pabrik form-control select2","required='required'","Pilih pabrik");			
							?>							
							</td>                                  
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("harga_pembelian_detil",$harga_pembelian_detil," style='text-align:right;' required 
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber harga'",
													"Harga","text");					
							?>								
							</td>     
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("diskon_pembelian_detil",$diskon_pembelian_detil," style='text-align:right;' required 
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber diskon'",
													"Kurs Transaksi","text");					
							?>								
							</td> 			
							<td class="text-sm text-label border-0">
							<?php 
								input_pdnoclassnoid('persen_pembelian_detil',$persen,'persen_pembelian_detil',' ','persen_pembelian_detil','form-control select2 persen');
							?>								
							</td> 	
							<td class="text-sm text-label border-0">
								<?php 			
									input_textcustom("total_pembelian_detil",$total_pembelian_detil," style='text-align:right;' required readonly
													onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber total'",
															"Total","text");								
								?>	
							</td>					
						  </tr>
						  <tr style="background-color: #800000;color: white;">
							<td class="text-sm text-label text-left border-0">Satuan Besar</td>                             
							<td class="text-sm text-label text-left border-0">Konversi</td>      						
							<td class="text-sm text-label text-left border-0">Satuan Kecil</td>
							<td colspan="2" class="text-sm text-label text-left border-0">Expired</td>
							<td colspan="3" class="text-sm text-label text-left border-0">Keterangan</td>
						  </tr>		
						  <tr>

							<td class="text-sm text-label border-0">
							<?php
								input_pdselect2url("satuan_besar","satuan_besar","select_satuan form-control select2"," required='required' ","Satuan Besar");
							?>							
							</td>                               
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("konversi",$konversi," style='text-align:right;' required
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control konversi'",
													"Konversi","text");					
							?>								
							</td>      							
							<td class="text-sm text-label border-0">
							<?php
								input_pdselect2url("satuan_kecil","satuan_kecil","select_satuan form-control select2"," required='required' ","Satuan Kecil");
							?>							
							</td> 
							<td colspan="2" class="text-sm text-label border-0">
							<?php
								input_calendar("tgl_expired","tgl_expired",$tgl_expired,"Masukkan Tanggal"," required");
							?>							
							</td> 
							<td colspan="3" class="text-sm text-label text-left border-0">
								<?php
									input_text("ket_pembelian_detil",$ket_pembelian_detil,"maxlength='255' ","Keterangan","text");
								?>
								</td>	
							</tr>
						</tbody>
						<tfoot>
						  <tr>
							<td colspan="8" class="text-sm text-label text-left border-0">
								<button type="submit" name="action" value="BtnTambah" class="btn btn-success pull-left">
									<i class="glyphicon glyphicon-plus"></i> Tambah
								</button>							
							</td>
							</tr>	
						</tfoot>
					  </table>
				<table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
					<thead>
						<tr>
						  <th width="5%"></th>
						  <th style="display: none;"></th>
						  <th width="20%">Nama Barang</th>
						  <th width="20%">Pabrik</th>
						  <th width="5%">Qty</th>
						  <th>Harga</th>
						  <th width="5%">Diskon</th>
						  <th>Jumlah</th>
						  <th>Expired</th>
						  <th>Stok</th>
						  <th>Harga Jual</th>
						</tr>
					</thead>
					<tfoot>
				<tr id="addDepIt">
					<td colspan="3" style="vertical-align:middle;font-weight:bold;text-align:center;">
						Sub Total
					</td>					
					<td colspan="2" style="vertical-align:middle;font-weight:bold;text-align:left;" class="text-sm text-label border-0">
					<?php 			
						input_textcustom("subtotal_pembelian",$subtotal_pembelian," style='text-align:right;' required readonly id='subtotal_pembelian'
										onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
												"% Diskon","text");								
					?>							
					</td>		
					<td colspan="2" style="vertical-align:middle;font-weight:bold;text-align:center;" class="text-sm text-label border-0">
						Diskon Seluruhnya <?php if($persen_pembelian == 0){ echo 'Rp.'; } ?>
					</td>	
					<td style="vertical-align:middle;font-weight:bold;text-align:left;" class="text-sm text-label border-0">
					<?php 			
						input_textcustom("diskon_pembelian",$diskon_pembelian," style='text-align:right;' required readonly id='diskon_pembelian'
										onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
												"% Diskon","text");								
					?>							
					</td>	
					<td style="vertical-align:middle;font-weight:bold;text-align:center;" class="text-sm text-label border-0">
					<?php 			
						if($persen_pembelian == 1){ echo '%'; }							
					?>							
					</td>	
					<td colspan="2" style="vertical-align:middle;font-weight:bold;text-align:left;">
					<?php 			
						input_textcustom("sub_total",$sub_total," style='text-align:right;' required readonly id='sub_total'
										onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
												"% Diskon","text");								
					?>					
					</td>														
				</tr>
				<tr>
					<td colspan="3" style="vertical-align:middle;font-weight:bold;text-align:center;">
						PPN
					</td>					
					<td colspan="2" class="text-sm text-label border-0">
					<?php 			
						input_textcustom("ppn_pembelian",$ppn_pembelian," style='text-align:right;' required readonly id='ppn_pembelian'
										onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
												"% Diskon","text");								
					?>							
					</td>	
					<td colspan="2" style="vertical-align:middle;font-weight:bold;text-align:center;" class="text-sm text-label border-0">
							<i class="fa fa-money"></i>
					</td>		
					<td style="vertical-align:middle;font-weight:bold;text-align:left;"  class="text-sm text-label border-0">
					<?php 			
						input_textcustom("total_pembelian",$total_pembelian," style='text-align:right;' required readonly id='total_pembelian'
										onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
												"% Diskon","text");							
					?>							
					</td>	
					<td style="vertical-align:middle;font-weight:bold;text-align:center;" class="text-sm text-label border-0">
							TOTAL PEMBAYARAN
					</td>	
					<td colspan="2" style="vertical-align:middle;font-weight:bold;text-align:left;">
					<?php 			
						input_textcustom("ttotal",$ttotal," style='text-align:right;' required readonly id='ttotal'
										onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
												"% Diskon","text");								
					?>					
					</td>												
				</tr>						
					</tfoot>
				</table>
					</div>
					</div>
				</div>	
			  </div>
		  </div>
        </div>
		<?php echo form_close(); ?>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
       <?php echo $instance_name; ?>
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