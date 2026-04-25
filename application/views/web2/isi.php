<?php
if ($page=="home")
{
?>
<section>
	<div class="container">

		<div class="row">

			<!-- LEFT -->
			<div class="col-sm-9">

				<!--
					controlls-over		= navigation buttons over the image
					buttons-autohide 	= navigation buttons visible on mouse hover only

					data-plugin-options:
						"singleItem": true
						"autoPlay": true (or ms. eg: 4000)
						"navigation": true
						"pagination": true
						"transitionStyle":"fadeUp" (fade,backSlide,goDown,fadeUp)
				-->
				<div class="owl-carousel buttons-autohide controlls-over" data-plugin-options='{"singleItem": true, "autoPlay": true, "navigation": true, "pagination": true, "transitionStyle":"fade"}'>
					<a href="#">
						<img class="img-fluid" src="<?php echo base_url();?>assets/images/1.jpg" alt="">
					</a>
					<a href="#">
						<img class="img-fluid" src="<?php echo base_url();?>assets/images/2.jpg" alt="">
					</a>
					<a href="#">
						<img class="img-fluid" src="<?php echo base_url();?>assets/images/3.jpg" alt="">
					</a>
				</div>

				<!-- breaking news -->
				<div class="alert alert-mini alert-primary mb-30"><!-- DANGER -->
					<strong>BREAKING NEWS:</strong>
					<div class="owl-carousel controlls-over m-0" data-plugin-options='{"autoPlay":3000, "stopOnHover":true, "items": 1, "singleItem": true, "navigation": false, "pagination": false, "transitionStyle":"fadeUp"}'>
						<div class="text-left fs-14">
							<?= $web_header ?>
						</div>
						<div class="text-left fs-14">
							<?= $web_intro ?>
						</div>
						<div class="text-left fs-14">
							<?= $web_slider ?>
						</div>
					</div>
				</div><!-- /breaking news -->

				<h3 class="page-header fw-300 mt-60">
					<i class="fa fa-bar-chart"></i>
					<strong>Statistik Perawat dan Bidan Tahun <?= date('Y') ?> Berdasarkan Profil</strong>
				</h3>
				<div class="row">
					<div class="col-md-6">

						<h4>Jenis Kelamin</h4>
						<p>
							<?php
								$gender=$this->m_berkas->peta_count('ALL','jk');
							 ?>
							 Laki-laki : <?= $gender['MALE_COUNT'] ?><br>
							 Perempuan : <?= $gender['FEMALE_COUNT'] ?>
						</p>

						<hr class="half-margins" /><!-- separator -->

						<h4>Status Pegawai</h4>
						<p>
							<?php
								$sp=$this->m_berkas->peta_count('ALL','tipe_pegawai');
								foreach($sp as $rowsp){
									$nsp = $this->m_umum->ambil_data('kol_status_pegawai','id_status_pegawai',$rowsp['tipe_pegawai']);
										echo $nsp['nama_status_pegawai'].' = '.$rowsp['total_pegawai'].'<br>';
								}
								?>
						</p>

						<hr class="half-margins" /><!-- separator -->

						<h4>Agama</h4>
						<p>
							<?php
								$agama=$this->m_berkas->peta_count('ALL','id_agama');
								foreach($agama as $rowagama){
									$nagama = $this->m_umum->ambil_data('kol_agama','id_agama',$rowagama['id_agama']);
										echo $nagama['nama_agama'].' = '.$rowagama['total_agama'].'<br>';
								}
							 ?>
						</p>

						<hr class="half-margins" /><!-- separator -->
					</div>

					<div class="col-md-6">

						<h4>Status Pernikahan</h4>
						<p>
							<?php
								$kawin=$this->m_berkas->peta_count('ALL','id_status_kawin');
								foreach($kawin as $rowkawin){
									$nkawin = $this->m_umum->ambil_data('kol_status_kawin','id_status_kawin',$rowkawin['id_status_kawin']);
										echo $nkawin['nama_status_kawin'].' = '.$rowkawin['total_kawin'].'<br>';
								}
							 ?>
						</p>

						<hr class="half-margins" /><!-- separator -->

						<h4>Pelatihan Khusus</h4>
						<p>
							<?php
								$pelatihan=$this->m_berkas->ambil_berkas_pelatihan('ALL');
								foreach($pelatihan as $rowpelatihan){
									$npelatihan = $this->m_umum->ambil_data('kol_kategori_pelatihan','id_kategori_pelatihan',$rowpelatihan['id_kategori_pelatihan']);
										echo $npelatihan['nama_kategori_pelatihan'].' = '.$rowpelatihan['total_pelatihan'].'<br>';
								}
								?>
						</p>

						<hr class="half-margins" /><!-- separator -->

					</div>
				</div>
			</div>
			<!-- /LEFT -->

			<!-- RIGHT -->
			<div class="col-sm-3">

				<!-- FOLLOW -->
				<h3 class="page-header fw-300 mt-0">
					<i class="fa fa-twitter"></i>
					Foolow <span>Us</span>
				</h3>

				<!-- Social Icons -->
				<div class="mt-20 clearfix">
					<a href="#" class="social-icon social-facebook float-left" data-toggle="tooltip" data-placement="top" title="Facebook">

						<i class="icon-facebook"></i>
						<i class="icon-facebook"></i>
					</a>

					<a href="#" class="social-icon social-twitter float-left" data-toggle="tooltip" data-placement="top" title="Twitter">
						<i class="icon-twitter"></i>
						<i class="icon-twitter"></i>
					</a>

					<a href="#" class="social-icon social-gplus float-left" data-toggle="tooltip" data-placement="top" title="Google plus">
						<i class="icon-gplus"></i>
						<i class="icon-gplus"></i>
					</a>

					<a href="#" class="social-icon social-linkedin float-left" data-toggle="tooltip" data-placement="top" title="Linkedin">
						<i class="icon-linkedin"></i>
						<i class="icon-linkedin"></i>
					</a>

					<a href="#" class="social-icon social-rss float-left" data-toggle="tooltip" data-placement="top" title="Rss">
						<i class="icon-rss"></i>
						<i class="icon-rss"></i>
					</a>

				</div>
				<!-- /Social Icons --><hr>
				<h3 class="page-header fw-300 mt-0">
					<i class="fa fa-newspaper-o"></i>
					Berita <span>Utama</span>
				</h3>
				<p>
				<?= $web_intro ?>
				</p>
			</div>
			<!-- /RIGHT -->

		</div>

	</div>
</section>
<?php
}
elseif ($page=="faq")
{
?>
<section class="page-header page-header-lg parallax parallax-3" style="background-image:url('<?php echo base_url();?>assets/images/red.jpg')">
	<div class="overlay dark-2"><!-- dark overlay [1 to 9 opacity] --></div>

</section>
<section>
	<div class="container">

		<div class="row">

			<!-- LEFT COLUMNS -->
			<div class="col-md-12">
				<p class="lead">TUTORIAL PENGGUNAAN PROGRAM</p>

				<div class="toggle toggle-transparent toggle-bordered-full mt-60">
				<?php foreach($ambil_faq['faq'] as $rowambil_faq){ ?>

					<div class="toggle"><!-- toggle -->
						<label><?= $rowambil_faq['faq'] ?></label>
						<div class="toggle-content">
							<p class="lead">
								<?= $rowambil_faq['judul_faq'] ?>
							</p>
							<p class="clearfix">
								<?= $rowambil_faq['isi_faq'] ?>
							</p>

						</div>
					</div><!-- /toggle -->
						<?php } ?>
				</div>
				<!-- /TOGGLES -->

			</div>
			<!-- /LEFT COLUMNS -->
			<?php
				echo $ambil_faq['pagination'];
			?>
		</div>

	</div>
</section>
							<!--
								.article-format class will add some slightly formattings for a good text visuals.
								This is because most editors are not ready formatted for bootstrap
								Blog content should come inside this container, as it is from database!
								src/scss/_core/base/_typography.scss
								===================
								pagination
								===================

								  <div class="page-header">Simple CSS pagination</div>
								  <ul id="pagination">
									<li><a href="#">«</a></li>
									<li><a href="#">1</a></li>
									<li><a href="#" class="">2</a></li>
									<li><a href="#">3</a></li>
									<li><a href="#">4</a></li>
									<li><a href="#">5</a></li>
									<li><a href="#">6</a></li>
									<li><a href="#">7</a></li>
									<li><a href="#">»</a></li>
								  </ul>


									<div class="page-header">Active and Hoverable Pagination</div>
								  <ul id="pagination">
									<li><a class="" href="#">«</a></li>
									<li><a href="#">1</a></li>
									<li><a href="#" class="active">2</a></li>
									<li><a href="#">3</a></li>
									<li><a href="#">4</a></li>
									<li><a href="#">5</a></li>
									<li><a href="#">6</a></li>
									<li><a href="#">7</a></li>
									<li><a href="#">»</a></li>
								  </ul>


								  <div class="page-header">Bordered Pagination</div>
								  <div class="b-pagination-outer">

								  <ul id="border-pagination">
									<li><a class="" href="#">«</a></li>
									<li><a href="#">1</a></li>
									<li><a href="#" class="active">2</a></li>
									<li><a href="#">3</a></li>
									<li><a href="#">4</a></li>
									<li><a href="#">5</a></li>
									<li><a href="#">6</a></li>
									<li><a href="#">7</a></li>
									<li><a href="#">»</a></li>
								  </ul>
								</div>

								</div>
							-->
<?php
}
elseif ($page=="logbook")
{
?>
<style>
#chartdiv {
  width: 100%;
  height: 1000px;
}
</style>
<section class="page-header page-header-lg parallax parallax-3" style="background-image:url('<?php echo base_url();?>assets/images/red.jpg')">
	<div class="overlay dark-2"><!-- dark overlay [1 to 9 opacity] --></div>
</section>
<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
	<!-- 	<div id="chartdiv"></div> -->
				<h3><strong>JUMLAH KATEGORI KOMPETENSI BERDASARKAN LOGBOOK TAHUN <?= date('Y'); ?></strong></h3>
				<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Nama Kategori Kompetensi</th>
							<th>Jabatan</th>
							<th>Jumlah Logbook</th>
						</tr>
					</thead>
					<tbody>
							<?php
								foreach($tbl_kompetensi as $rowtbl_kompetensi){
							?>
						<tr>
							<td><?= $rowtbl_kompetensi['nama_kompetensi'] ?></td>
							<td><?= $rowtbl_kompetensi['nama_jabatan'] ?></td>
							<td><?= $rowtbl_kompetensi['jml_logbook'] ?></td>
						</tr>
						<?php
							}
						?>
					</tbody>
				</table>
			</div>
			</div>
		</div>
	</div>
</section>
<?php
}
