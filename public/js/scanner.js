$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
})

let scanner = new Instascan.Scanner({
  video: document.getElementById('preview'),
  refractoryPeriod: 3000,
  captureImage: true
})

scanner.addListener('scan', function(content, image) {
  $('h1.data').text('Loading...')
  window.currentData = { code: content }
  $.ajax({
    type: 'POST',
    data: {
      image,
      type: 'qrcode',
      ...currentData
    }
  })
    .done(function(response) {
      if (response.success) {
        currentData.name = response.name
        preparePhoto()
        scanner.stop()
      } else {
        $('h1.data').text('Already Logged In')
      }
    })
    .always(function() {
      setTimeout(function() {
        $('h1.data').text(null)
      }, 3000)
      fetchLogged()
    })
})
Instascan.Camera.getCameras()
  .then(function(cameras) {
    window.cameras = cameras
    if (cameras.length > 0) {
      scanner.start(cameras[0])
    } else {
      console.error('No cameras found.')
    }
  })
  .catch(function(e) {
    console.error(e)
  })

function preparePhoto() {
  navigator.mediaDevices
    .getUserMedia({
      video: { width: 375, height: 375 }
    })
    .then(stream => {
      let player
      swal({
        html: `
          <h1 style="margin:0">
            Welcome, ${currentData.name}
          </h1>
          <video id="capturePhoto" style="transform:rotateY(180deg)"></video>
          <center>
            Capturing in<br>
            <h1 class="countdown" style="margin:0">5</h1>
          </center>
        `,
        timer: 5000,
        showConfirmButton: false,
        customClass: 'swal2-modal-lg',
        onOpen: () => {
          player = document.getElementById('capturePhoto')
          player.srcObject = stream
          player.play()
          window.timer = setInterval(function() {
            $('h1.countdown').text(Number($('h1.countdown').text()) - 1)
          }, 1000)
        },
        onClose: () => {
          clearInterval(timer)
        }
      }).then(result => {
        let picture = document.createElement('canvas')
        picture.height = 375
        picture.width = 375
        picture.getContext('2d').drawImage(player, 0, 0, 375, 375)

        showImage(picture.toDataURL())
      })
    })
}

function showImage(url) {
  swal({
    imageUrl: url,
    showCancelButton: true,
    cancelButtonText: 'Retake'
  }).then(result => {
    if (result.value) {
      $.ajax({
        type: 'POST',
        data: { type: 'picture', code: currentData.code, image: url }
      })
        .done(function(response) {
          if (response.success) {
            currentData.name = response.name
            preparePhoto()
            scanner.stop()
          } else {
            swal('Already Logged In.')
          }
        })
        .always(function() {
          scanner.start(cameras[0])
          setTimeout(function() {
            $('h1.data').text(null)
          }, 3000)
          fetchLogged()
        })
    } else {
      preparePhoto()
    }
  })
}

function fetchLogged() {
  $.get(
    'loggedlist',
    null,
    function(response) {
      $('ul.collection').html(null)
      response.forEach(function(item) {
        $('ul.collection').append(`
          <li class="collection-item" style="overflow:hidden">
            <a href="loggedusers/${item.reference_number}-qrcode.webp" target="_blank">
              ${item.first_name} ${item.last_name} (${item.reference_number}) logged in
            </a>
            <div style="float:right;font-size:10px">
              ${moment(item.logged_at).format('MMM D, YYYY h:mm:ss A')}
            </div>
          </li>
        `)
      })
      $('.collection-item a').click(function(e) {
        e.preventDefault()
        $('.materialboxed')
          .attr('src', $(this).attr('href'))
          .materialbox()
        setTimeout(function() {
          let image = M.Materialbox.getInstance($('.materialboxed'))
          image.open()
        }, 100)
      })
    },
    'json'
  )
}

fetchLogged()
