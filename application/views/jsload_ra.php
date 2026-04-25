<script src="<?= base_url() ?>rassets/vendor/datatable/jquery-3.5.1.js"></script>

<script src="<?= base_url() ?>rassets/vendor/datatable/jquery.dataTables.min.js"></script>

<script src="<?= base_url() ?>rassets/vendor/datatable/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>rassets/vendor/datatable/jszip.min.js"></script>
<script src="<?= base_url() ?>rassets/vendor/datatable/pdfmake.min.js"></script>
<script src="<?= base_url() ?>rassets/vendor/datatable/vfs_fonts.js"></script>

<script src="<?= base_url() ?>rassets/vendor/datatable/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>rassets/vendor/datatable/buttons.print.min.js"></script>
<script src="<?= base_url() ?>rassets/vendor/datatable/buttons.colVis.min.js"></script>

<script src="<?= base_url() ?>rassets/vendor/datatable/dataTables.select.min.js"></script>
<script src="<?= base_url() ?>assets/datatables/dataTables.fixedColumns.min.js"></script>
  <!-- phosphor js -->
  <script src="<?= base_url() ?>rassets/vendor/phosphor/phosphor.js"></script>

  <!-- Bootstrap js-->
  <script src="<?= base_url() ?>rassets/vendor/bootstrap/bootstrap.bundle.min.js"></script>

  <!-- select2 -->
  <script src="<?= base_url() ?>rassets/vendor/select/select2.min.js"></script>

  <!-- apexcharts -->
  <script src="<?= base_url() ?>rassets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="<?= base_url() ?>rassets/vendor/chartjs/chart.js"></script>
  <script src="<?= base_url() ?>assets/amcharts/core.js"></script>
  <script src="<?= base_url() ?>assets/amcharts/charts.js"></script>
  <script src="<?= base_url() ?>assets/amcharts/themes/dataviz.js"></script>
  <script src="<?= base_url() ?>assets/amcharts/themes/animated.js"></script>

  <!-- Toatify js-->
  <script src="<?= base_url() ?>rassets/vendor/notifications/toastify-js.js"></script>
    <!-- Glight js -->
  <script src="<?= base_url() ?>rassets/vendor/glightbox/glightbox.min.js"></script>
  <script src="<?= base_url() ?>rassets/vendor/masonry/masonry.pkgd.min.js"></script>

    <!-- flatpickr js-->
  <script src="<?= base_url() ?>rassets/vendor/datepikar/flatpickr.js"></script>
  <!-- <script src="<= base_url() ?>rassets/js/toastui-calendar.min.js"></script>-->

  <!-- sweetalert js-->
  <script src="<?= base_url() ?>rassets/vendor/sweetalert/sweetalert.js"></script>

  <!-- fullcalendar js -->
  <script src="<?= base_url() ?>rassets/vendor/fullcalendar/global.js"></script>

<script src="<?php echo base_url();?>assets/js/jquery.autocomplete.js"></script>

<script>
/*<?php if($this->session->flashdata('sukses')): ?>
Swal.fire({
  icon: 'success',
  title: 'Berhasil',
  text: '<?= $this->session->flashdata('sukses'); ?>',
  timer: 2000,
  showConfirmButton: false
});
<?php endif; ?>
  <?php if($this->session->flashdata('danger')): ?>
    Swal.fire({
      icon: 'error',
      title: 'Gagal',
      text: '<?= $this->session->flashdata('danger'); ?>'
    });
  <?php endif; ?>*/
function getLocalStorageItem(key, def = null) {
    try {
        const v = localStorage.getItem(key);
        return v === null ? def : JSON.parse(v);
    } catch (e) {
        return def;
    }
}

function setLocalStorageItem(key, val) {
    try {
        localStorage.setItem(key, JSON.stringify(val));
    } catch (e) {}
}
</script>
  <!-- js -->
  <script src="<?= base_url() ?>rassets/js/sweet_alert.js"></script>

  <!-- phosphor js -->
  <script src="<?= base_url() ?>rassets/vendor/phosphor/phosphor.js"></script>

  <!-- Simple bar js-->
  <script src="<?= base_url() ?>rassets/vendor/simplebar/simplebar.js"></script>

   <!-- App js-->
  <script src="<?= base_url() ?>rassets/js/script.js"></script>
  <?php  swal_flashdata(); ?>
<script>
// AJAX Swal handler global
$(document).ajaxSuccess(function(event, xhr, settings) {
    try {
        let res = JSON.parse(xhr.responseText);

        // hanya kalau status berbentuk string: success/error/info
        if (!res.status || typeof res.status !== "string") return;

        Swal.fire({
            toast: res.toast ?? false,
            position: res.toast ? 'top-end' : 'center',
            icon: res.status,
            title: res.title ?? "",
            text: res.message ?? "",
            timer: res.toast ? (res.timer ?? 2000) : undefined,
            showConfirmButton: res.toast ? false : true
        }).then(() => {
            if(res.reload) location.reload();
            if(res.redirect) window.location.href = res.redirect;
        });

    } catch (e) {}
});



</script>