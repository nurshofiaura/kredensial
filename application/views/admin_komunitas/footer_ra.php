<!--  <footer class="main-footer no-print"> -->
<?php
 $array_f = array('class="footer-primary"','class="footer-secondary"','class="footer-success"','class="footer-danger"','class="footer-warning"','class="footer-info"','class="footer-light"','class="footer-dark"','');
 $ft = array_rand($array_f);
 $fo = $array_f[$ft];
?>
        <div class="go-top">
          <span class="progress-value">
            <i class="ti ti-arrow-up"></i>
          </span>
        </div>
        <footer <?= $fo ?>>
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-9 col-12">
                <ul class="footer-text">
                  <li><?= $ilicensed ?></li>
                </ul>
              </div>
              <div class="col-md-3">
                <ul class="footer-text text-end">
                  <li><b><?= $ifooter ?></b></li>
                </ul>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
  </div>