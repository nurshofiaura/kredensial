<!-- App Header -->
<div class="appHeader bg-primary text-light">
  <div class="left">
    <a href="<?= site_url('home'); ?>" class="headerButton goBack">
      <i class="fas fa-arrow-left fa-2x"></i>
    </a>
  </div>
  <div class="pageTitle"><?= $title; ?></div>
  <div class="right"></div>
</div>
<!-- * App Header -->

<!-- App Capsule -->
<div id="appCapsule">
  <div class="row my-4">
    <div class="col text-center mt-5">
      <center>
        <style>
          #my_camera, #my_camera video {
            display: inline-block;
            width: 100% !important;
            height: 420px !important;
            margin: auto !important;
            border-radius: 8px !important;
          }
          video {
            -webkit-transform: scaleX(-1);
            transform: scaleX(-1);
          }
        </style>
        <div id="my_camera"></div>
      </center>
      <div style="width:100%; margin:auto; text-align:center;">
        <button type="button" id="btn-clock" class="btn btn-block <?= ($clock_type=='in')?'btn-primary':'btn-primary'; ?>"><?= ($clock_type=='in')?'Clock In':'Clock Out'; ?></button>
      </div>
      <div class="form-group">
        <input type="text" name="location" id="location" class="form-control text-center" readonly>
      </div>
      <div class="form-group mb-5">
        <div id="map" style="width:100%; height:300px;"></div>
      </div>
    </div>
  </div>
</div>
<!-- * App Capsule -->
<script language="JavaScript">
  Webcam.set({
    width: 340,
    height: 420,
    image_format: 'jpeg',
    jpeg_quality: 100,
  });
  Webcam.attach('#my_camera');

  $('#btn-clock').click(function(e){
    $('#btn-clock').attr('disabled', true);
    $('#btn-clock').text('Processing...');
    Webcam.snap(function(uri){
      var image_base64 = uri;
      var location = $('#location').val();
      var clock_type = '<?= $clock_type; ?>';
      if(clock_type == 'in'){
        var text = 'Clock In';
      }else{
        var text = 'Clock Out';
      }
      $.ajax({
        type: 'POST',
        url: '<?= site_url('attendance/live'); ?>',
        data: {
          clock_type: clock_type,
          image: image_base64,
          location: location
        },
        dataType: 'JSON',
        cache: false,
        success: function(response){
          $('#btn-clock').attr('disabled', false);
          $('#btn-clock').text(text);

          if(response.success){
            Swal.fire({
              icon: 'success',
              title: 'Thank You',
              text: response.message,
              confirmButtonText: 'OKE',
            }).then((result) => {
              if(result.isConfirmed){
                window.location.href="<?= site_url('home'); ?>";
              }
            });
          }else{
            Swal.fire({
              icon: 'error',
              title: 'Sorry...',
              text: response.message,
              confirmButtonText: 'OKE',
            });
          }
        }
      });
    });
  });

  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    alert("Geolocation is not supported by this browser.");
  }

  function showPosition(position) {
    var latitude  = position.coords.latitude;
    var longitude = position.coords.longitude;
    var latlong   = latitude + ', ' + longitude;
    $('#location').val(latlong);

    const map = L.map('map').setView([latitude, longitude], <?= $setting->zoom_level; ?>);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: ''
    }).addTo(map);

    L.marker([latitude, longitude]).addTo(map)
      .bindPopup('My Location')
      .openPopup();

    var officeIcon = L.icon({
      iconUrl: '<?= base_url('assets/img/icon/office-center.png'); ?>',

      iconSize:     [38, 95], // size of the icon
      shadowSize:   [50, 64], // size of the shadow
      iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
      popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
    });

    L.marker([<?= $setting->location; ?>], {icon: officeIcon}).addTo(map)
      .bindPopup('<?= $setting->company; ?>');

    L.circle([<?= $setting->location; ?>], {
      color: 'blue',
      fillColor: 'blue',
      fillOpacity: 0.5,
      radius: <?= $setting->radius; ?>
    }).addTo(map);
  }
</script>