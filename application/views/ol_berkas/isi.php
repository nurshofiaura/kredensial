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
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="validasi")
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
    //    input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th width="5%" style="display;none;"></th>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>No Surat</th>
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
elseif ($page=="validasi_validasi")
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
           <h3 class="box-title">
      <?php echo $title; ?> <small style="color:white;font-weight:bold;"></small>
       </h3>
        </div>
        <div class="box-body">
    <?php echo form_open_multipart('ol_validasi/validasi/validasi/'.$id,' ');
    input_text("id_korespodensi",$id_korespodensi,"","","hidden");
    input_text("id_kategori",$id_kategori,"","","hidden");
    if(empty($foto_pengaju)){
      $url_thumbx=base_url().'assets/images/noavatar.jpg';
      $url_picbesarx=base_url().'assets/images/noavatar.jpg';
    }else{
      $cek_filesmall=FCPATH.'assets/foto/ol/'.$foto_pengaju;
      if(file_exists($cek_filesmall)){
        $url_thumbx=base_url().'assets/foto/ol/'.$foto_pengaju;
        $url_picbesarx=base_url().'assets/foto/ol/'.$foto_pengaju;
      }else{
        $url_thumbx=base_url().'assets/images/noavatar.jpg';
        $url_picbesarx=base_url().'assets/images/noavatar.jpg';
      }
    }
$arraywarna = array('red','navy','yellow','maroon','olive','purple','aqua','lightblue','blue','green','teal','lime','orange','fuchsia');
      ?>
      <div class="row">
      <div class="col-md-6">
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title">
              BERKAS <small style="color:white;font-weight:bold;">  </small>
            </h3>
            </div>
            <div class="box-body">
        <div class="box-body no-padding">
          <div class="mailbox-controls">

          </div>
          <div class="table-responsive mailbox-messages">
          <table class="table table-hover table-striped">
            <tbody>
            <tr>
            <td colspan="2" style="background-color:#9b0e27;color:white;text-weight:bold;">IJASAH</td>
            </tr>
              <?php
              if($ijasah!==""){
                foreach($ambil_berkas_data as $row){
                  if (in_array($row['id_berkas'],$id_ijasah)) {
              ?>
                <tr>
                <td width="5%"><input name="id_4_ijasah[]" value="<?php echo $row['id_berkas']; ?>" checked="checked" type="checkbox"></td>
                <td class="mailbox-name">
                  <a href="<?php echo base_url('assets/berkas/ol/'.$row['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
                    <i class="fa fa-file-text"></i> <?php echo $row['nama_berkas']; ?> - <?php echo $row['penyelenggara']; ?>
                  </a>
                </td>
                </tr>
              <?php
                  }
                }
              }
              ?>
            <tr>
            <td colspan="2" style="background-color:#9b0e27;color:white;text-weight:bold;">SURAT IJIN</td>
            </tr>
              <?php
              if($str!==""){
                foreach($ambil_berkas_data as $row2){
                  if (in_array($row2['id_berkas'],$id_str)) {
              ?>
                <tr>
                <td width="5%"><input name="id_4_str[]" value="<?php echo $row2['id_berkas']; ?>" checked="checked" type="checkbox"> </td>
                <td class="mailbox-name">
                  <a href="<?php echo base_url('assets/berkas/ol/'.$row2['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
                    <i class="fa fa-file-text"></i> <?php echo $row2['nama_berkas']; ?>
                  </a>
                </td>
                </tr>
              <?php
                  }
                }
              }
              ?>
            <tr>
            <td colspan="2" style="background-color:#9b0e27;color:white;text-weight:bold;">BERKAS</td>
            </tr>
              <?php
              if($sertifikat!==""){
                foreach($ambil_berkas_data as $row3){
                  if (in_array($row3['id_berkas'],$id_sertifikat)) {
              ?>
                <tr>
                <td width="5%"><input name="id_4_sertifikat[]" value="<?php echo $row3['id_berkas']; ?>" checked="checked" type="checkbox"> </td>
                <td class="mailbox-name">
                  <a href="<?php echo base_url('assets/berkas/ol/'.$row3['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
                    <i class="fa fa-file-text"></i> <?php echo $row3['nama_berkas']; ?>
                  </a>
                </td>
                </tr>
              <?php
                  }
                }
              }
              if($berkas!==""){
                foreach($ambil_berkas_data as $row4){
                  if (in_array($row4['id_berkas'],$id_berkas)) {
              ?>
                <tr>
                <td width="5%"><input name="id_4_berkas[]" value="<?php echo $row4['id_berkas']; ?>" checked="checked" type="checkbox"> </td>
                <td class="mailbox-name">
                  <a href="<?php echo base_url('assets/berkas/ol/'.$row4['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
                    <i class="fa fa-file-text"></i> <?php echo $row4['nama_berkas']; ?>
                  </a>
                </td>
                </tr>
              <?php
                  }
                }
              }
              ?>
            </tbody>
          </table>
          <!-- /.table -->
          </div>
          <!-- /.mail-box-messages -->
        </div>
        <div class="box-footer no-padding">
          <div class="mailbox-controls">
          <!-- Check all button -->
          <div class="pull-right">
           <i class="fa fa-search"></i> KLIK BERKAS UNTUK MELIHAT
          </div>
          <!-- /.pull-right -->
          </div>
        </div>
            </div>
          </div>
            <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
              <div class="box-header with-border">
                 <h3 class="box-title">SYARAT PENGAJUAN</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                          title="Collapse">
                    <i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body">
                <h4><?php echo $syarat_kategori; ?></h4>
              </div>
              <div class="box-footer">

              </div>
            </div>
        </div>
        <div class="col-md-6">
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">
            TIME LINE PENGAJUAN <small style="color:white;font-weight:bold;"></small>
            </h3>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <!-- The time line -->
                  <ul class="timeline">
                    <li class="time-label">
                          <span class="bg-<?php echo $arraywarna[array_rand($arraywarna)]; ?>">
                            <i class="fa fa-envelope"></i> &nbsp;<?= strtoupper($nama_kategori) ?>
                          </span>
                    </li>
                    <li>
                      <i class="fa fa-file-text bg-<?php echo $arraywarna[array_rand($arraywarna)]; ?>"></i>

                      <div class="timeline-item">
                        <span class="time" style="color:black;"></span>

                        <h3 class="timeline-header">DATA SURAT</h3>

                        <div class="timeline-body">
                        <div class="form-group">
                          <h5>No Surat : 
                          <?php
                            echo $no_korespodensi
                          ?></h5>
                        </div>
                        <div class="form-group">
                          <?php
                            if ($sifat_surat === '0') {
                               echo '<button class="btn btn-xs btn-success">SIFAT SURAT : BIASA</button>';
                            } else if($sifat_surat === '1'){
                               echo '<button class="btn btn-xs btn-warning">SIFAT SURAT : PENTING</button>';
                            } else {
                               echo '<button class="btn btn-xs btn-danger">SIFAT SURAT : SANGAT PENTING</button>';
                            }
                          ?>
                        </div>
                        </div>
                      </div>
                    </li>
                    <li>
                      <i class="fa fa-user bg-<?php echo $arraywarna[array_rand($arraywarna)]; ?>"></i>

                      <div class="timeline-item">
                        <span class="time" style="color:black;"><?= $nama_asal; ?></span>

                        <h3 class="timeline-header"><?php echo $nama_pengaju; ?></h3>

                        <div class="timeline-body">
                          <a class="example-image-link" href="<?php echo $url_picbesarx; ?>"
                            data-lightbox="example-set" data-title="<?php echo $nama_pengaju; ?>">
                            <img class="profile-user-img img-responsive img-circle"
                              src="<?php echo $url_thumbx; ?>" style="width:75px" alt="User profile picture">
                          </a>
                        </div>
                      </div>
                    </li>
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    <li>
                      <i class="fa fa-envelope bg-<?php echo $arraywarna[array_rand($arraywarna)]; ?>"></i>

                      <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> <?= $wkt_korespodensi; ?></span>

                        <h3 class="timeline-header">
                          <?php if($id_kategori == 1){ echo 'Tujuan : '. $nama_tujuan; }else{ echo strtoupper($nama_kategori); } ?>
                        </h3>

                        <div class="timeline-body">
                          <?php  
                            if ($status_korespodensi == 0) {
                               echo '<button class="btn btn-xs btn-warning">STATUS : REGISTRASI</button>';
                            } else if($status_korespodensi == 1){
                               echo '<button class="btn btn-xs btn-info">STATUS : PROSES</button>';
                            } else if($status_korespodensi == 2){
                               echo '<button class="btn btn-xs btn-primary">STATUS : Validasi</button>';
                            } else if($status_korespodensi == 3){
                               echo '<button class="btn btn-xs btn-success">STATUS : Selesai</button>';
                            } else {
                               echo '<button class="btn btn-xs btn-danger">STATUS : Ditolak</button>';
                            }
                          ?>
                        </div>
                      </div>
                    </li>
                <?php
                  $ambil_kor_detil_pengcab = $this->m_ol_rancak->ambil_kor_detil_pengcab($id_korespodensi);
                  foreach($ambil_kor_detil_pengcab as $rowambil_kor_detil_pengcab){
                ?>
                    <li class="time-label">
                        <span class="bg-<?php echo $arraywarna[array_rand($arraywarna)]; ?>">
                           <?= $rowambil_kor_detil_pengcab['nama_pengcab']; ?>
                        </span>
                    </li>
                    <li>
                      <i class="fa fa-send bg-<?php echo $arraywarna[array_rand($arraywarna)]; ?>"></i>

                      <div class="timeline-item">
                       <span class="time" style="color:black;"><i class="fa fa-clock-o"></i> <?= date('d-m-Y H:i:s', strtotime($rowambil_kor_detil_pengcab['wkt_kor_detil'])); ?></span>
                        <h3 class="timeline-header"><b><?= $rowambil_kor_detil_pengcab['nama_pengcab']; ?></b></h3>
                      </div>
                    </li> 
                          <?php
                            $ambil_data_pengurus_pengcab = $this->m_ol_rancak->ambil_kor_detil($rowambil_kor_detil_pengcab['id_korespodensi'],$rowambil_kor_detil_pengcab['id_pengcab']);
                            foreach($ambil_data_pengurus_pengcab as $rowambil_data_pengurus_pengcab){
                              if(empty($rowambil_data_pengurus_pengcab['foto'])){
                                $url_thumbxpp=base_url().'assets/images/noavatar.jpg';
                                $url_picbesarxpp=base_url().'assets/images/noavatar.jpg';
                              }else{
                                $cek_filesmall=FCPATH.'assets/foto/ol/'.$rowambil_data_pengurus_pengcab['foto'];
                                if(file_exists($cek_filesmall)){
                                  $url_thumbxpp=base_url().'assets/foto/ol/'.$rowambil_data_pengurus_pengcab['foto'];
                                  $url_picbesarxpp=base_url().'assets/foto/ol/'.$rowambil_data_pengurus_pengcab['foto'];
                                }else{
                                  $url_thumbxpp=base_url().'assets/images/noavatar.jpg';
                                  $url_picbesarxpp=base_url().'assets/images/noavatar.jpg';
                                }
                              }
                          ?>
                    <li>
                      <i class="fa fa-user bg-<?php echo $arraywarna[array_rand($arraywarna)]; ?>"></i>

                      <div class="timeline-item">
                        <span class="time" style="color:black;"><i class="fa fa-clock-o"></i> &nbsp;
                          <?php  
                            if(!empty($rowambil_data_pengurus_pengcab['wkt_terbaca'])){
                              echo date('d-m-Y H:i:s', strtotime($rowambil_kor_detil_pengcab['wkt_kor_detil']));
                            }
                          ?>
                        </span>

                        <h3 class="timeline-header"><b><?= $rowambil_data_pengurus_pengcab['nama_pegawai_pengurus']; ?></b></h3>

                        <div class="timeline-body">
                           <?= $rowambil_data_pengurus_pengcab['disposisi']; ?>
                          <div class="row">
                            <div class="col-md-6">
                          <?php
                          if($rowambil_data_pengurus_pengcab['id_pegawai'] == $this->session->id_pegawai){
                            if($rowambil_data_pengurus_pengcab['acc'] == 0){
                              echo '<button class="btn btn-xs btn-warning">STATUS SEKARANG : Belum ACC</button>';
                            }else if($rowambil_data_pengurus_pengcab['acc'] == 1){
                              echo '<button class="btn btn-xs btn-success">STATUS SEKARANG : ACC</button>';
                            }else{
                              echo '<button class="btn btn-xs btn-danger">STATUS SEKARANG : Di Tolak</button>';
                            }
                          ?>
                          <br /><h5>SILAHKAN PILIH VALIDASI</h5><br />
<a class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="right" 
  href="<?php echo base_url('ol_validasi/validasi/acctolak/0/'.$rowambil_data_pengurus_pengcab['id_kor_detil']);?>">
  Proses
</a> &nbsp||&nbsp;
<a class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="right" 
  href="<?php echo base_url('ol_validasi/validasi/acctolak/1/'.$rowambil_data_pengurus_pengcab['id_kor_detil']);?>">
  ACC
</a> &nbsp||&nbsp;
<a class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="right" 
  href="<?php echo base_url('ol_validasi/validasi/acctolak/2/'.$rowambil_data_pengurus_pengcab['id_kor_detil']);?>">
  Tolak
</a>
                          <?php
                          }else{
                            if($rowambil_data_pengurus_pengcab['acc'] == 0){
                              echo '<button class="btn btn-xs btn-warning"> Belum ACC</button>';
                            }else if($rowambil_data_pengurus_pengcab['acc'] == 1){
                              echo '<button class="btn btn-xs btn-success"> ACC</button>';
                            }else{
                              echo '<button class="btn btn-xs btn-danger"> Di Tolak</button>';
                            }
                          
                          }
                          ?>
                              </div>
                              <div class="col-md-6">
                                <a class="example-image-link" href="<?php echo $url_picbesarxpp; ?>"
                                  data-lightbox="example-set" data-title="<?php echo $rowambil_data_pengurus_pengcab['nama_pegawai']; ?>">
                                  <img class="profile-user-img img-responsive img-circle"
                                    src="<?php echo $url_thumbx; ?>" style="width:75px" alt="User profile picture">
                                </a>
                              </div>
                        </div>
                        </div>
                      </div>
                    </li>
                          <?php  
                            }
                          ?>
                <?php
                  }
                ?>
                    <li>
                      <i class="fa fa-clock-o bg-<?php echo $arraywarna[array_rand($arraywarna)]; ?>"></i>
                    </li>
                  </ul>
                </div>
                <!-- /.col -->
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php echo form_close(); ?>
        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $header; ?> <small><?php echo $instance_name; ?></small></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php
}