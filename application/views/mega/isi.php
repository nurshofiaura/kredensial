<?php
//=================================== H O M E ================================================
$arraybox = array('warning','success','info','default','danger');
$resarray = array_rand($arraybox);
$thenarray = $arraybox[$resarray];	
$resarray2 = array_rand($arraybox);
$thenarray2 = $arraybox[$resarray2];	
$resarray3 = array_rand($arraybox);
$thenarray3 = $arraybox[$resarray3];
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
          echo '<pre>'; print_r($this->session->all_userdata());
		?>
        </div>
        <div class="box-footer">
          Footer
        </div>
      </div>
    </section>
</div>
<?php
}