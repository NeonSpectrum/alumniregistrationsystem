<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ filemtime(public_path('css/style.css')) }}">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
  <title>Alumni Registration Scanner</title>
  <style>
    body {overflow:hidden !important;}
  </style>
</head>
<body>
<div class="row scanner">
  <div class="col m9" align="center" style="padding-top:40px">
    <video id="preview"></video>
    <br><br>
    <h1 class="data" style="color:red"></h1>
  </div>
  <div class="col m3" style="background-color:white;height:100%;max-height:100%;padding:0;overflow:auto">
    <ul class="collection" style="margin:0">
    </ul>
  </div>
</div>
<center><img class="materialboxed" src=""></center>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/materialize.min.js') }}"></script>
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/instascan.min.js') }}"></script>
<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  })
  let scanner = new Instascan.Scanner({
    video: document.getElementById('preview'),
    refractoryPeriod: 3000,
    captureImage: true
  });
  scanner.addListener('scan', function (content, image) {
    $("h1.data").text("Loading...")
    let form_data = new FormData()
    form_data.append("code", content)
    form_data.append("image", image);
    $.ajax({
      type: "POST",
      data: form_data,
      contentType: false,
      processData: false
    }).done(function(response){
      if(response.success){
        $("h1.data").text("Reference Number: " + content)
      } else {
        $("h1.data").text("Already Logged In.")
      }
    }).always(function(){
      setTimeout(function(){
        $("h1.data").text(null)
      }, 3000)
      fetchLogged()
    })
  });
  Instascan.Camera.getCameras().then(function (cameras) {
    if (cameras.length > 0) {
      scanner.start(cameras[0]);
    } else {
      console.error('No cameras found.');
    }
  }).catch(function (e) {
    console.error(e);
  });

  function fetchLogged(){
    $.get("loggedlist", null, function(response){
      $("ul.collection").html(null)
      response.forEach(function(item){
        $("ul.collection").append(`
          <li class="collection-item" style="overflow:hidden">
            <a href="loggedusers/${item.reference_number}.webp" target="_blank">
              ${item.first_name} ${item.last_name} (${item.reference_number}) logged in
            </a>
            <div style="float:right;font-size:10px">
              ${moment(item.logged_at).format("MMM D, YYYY h:mm:ss A")}
            </div>
          </li>
        `)
      })
      $(".collection-item a").click(function(e){
        e.preventDefault()
        $(".materialboxed").attr("src", $(this).attr("href")).materialbox();
        setTimeout(function(){
          let image = M.Materialbox.getInstance($(".materialboxed"))
          image.open()
        }, 100)
      })
    },"json")
  }

  fetchLogged()
</script>
</body>
</html>
