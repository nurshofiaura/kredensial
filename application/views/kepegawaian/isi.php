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
elseif ($page=="pendidikan")
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
					  <th width="5%">ID</th>
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
elseif ($page=="pendidikan_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('kepegawaian/pendidikan/simpan_tambah');?>" onClick="return cek();">
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
								<div class="form-group">
								  <label>Nama Pendidikan</label>
									<?php
										input_text("nama_pendidikan",$nama_pendidikan,"maxlength='255' required autofocus","Masukkan Nama","text");
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
elseif ($page=="pendidikan_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('kepegawaian/pendidikan/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_pendidikan" value="<?= $id; ?>">
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
								<div class="form-group">
								  <label>Nama Pendidikan</label>
									<?php
										input_text("nama_pendidikan",$nama_pendidikan,"maxlength='255' required autofocus","Masukkan Nama","text");
									?>	
								</div>
							</div>		
				<div class="col-md-12">
					<div class="form-group">
					  <label>Status</label>
						<?php
							input_pdselect2("status_pendidikan",$cmd_status,$status_pendidikan);
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
elseif ($page=="kategori_berkas")
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
					  <th width="5%">ID</th>
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
elseif ($page=="kategori_berkas_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('kepegawaian/kategori_berkas/simpan_tambah');?>" onClick="return cek();">
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
					<div class="form-group">
					  <label>Nama</label>
						<?php
							input_text("nama_kategori_berkas",$nama_kategori_berkas,"maxlength='255' required autofocus","Masukkan Nama","text");
						?>	
					</div>
				</div>		
				<div class="col-md-12">
					<div class="form-group">
					  <label>Status</label>
						<?php
							input_pdselect2("status_kategori_berkas",$cmd_status,$status_kategori_berkas);
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
elseif ($page=="kategori_berkas_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('kepegawaian/kategori_berkas/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_kategori_berkas" value="<?= $id; ?>">
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
					<div class="form-group">
					  <label>Nama</label>
						<?php
							input_text("nama_kategori_berkas",$nama_kategori_berkas,"maxlength='255' required autofocus","Masukkan Nama","text");
						?>	
					</div>
				</div>		
				<div class="col-md-12">
					<div class="form-group">
					  <label>Status</label>
						<?php
							input_pdselect2("status_kategori_berkas",$cmd_status,$status_kategori_berkas);
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
elseif ($page=="kategori_pelatihan")
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
					  <th width="5%">ID</th>
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
elseif ($page=="kategori_pelatihan_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('kepegawaian/kategori_pelatihan/simpan_tambah');?>" onClick="return cek();">
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
					<div class="form-group">
					  <label>Nama</label>
						<?php
							input_text("nama_kategori_pelatihan",$nama_kategori_pelatihan,"maxlength='255' required autofocus","Masukkan Nama","text");
						?>	
					</div>
				</div>		
				<div class="col-md-12">
					<div class="form-group">
					  <label>Status</label>
						<?php
							input_pdselect2("status_kategori_pelatihan",$cmd_status,$status_kategori_pelatihan);
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
elseif ($page=="kategori_pelatihan_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('kepegawaian/kategori_pelatihan/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_kategori_pelatihan" value="<?= $id; ?>">
		<input type="hidden" name="nama_kategori_pelatihan_lama" value="<?= $nama_kategori_pelatihan; ?>">
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
					<div class="form-group">
					  <label>Nama</label>
						<?php
							input_text("nama_kategori_pelatihan",$nama_kategori_pelatihan,"maxlength='255' required autofocus","Masukkan Nama","text");
						?>	
					</div>
				</div>		
				<div class="col-md-12">
					<div class="form-group">
					  <label>Status</label>
						<?php
							input_pdselect2("status_kategori_pelatihan",$cmd_status,$status_kategori_pelatihan);
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