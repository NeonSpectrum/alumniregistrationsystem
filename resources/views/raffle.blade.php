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
  <div align="center" style="margin-top:30px">
    <div class="roulette" style="display:none">
      {{-- @foreach($data as $row)
        <img src="{{ asset("loggedusers/" . $row->reference_number . "-picture.png") }}" alt="">
      @endforeach --}}
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-qrcode.webp") }}" alt="ka">
      <img src="{{ asset("loggedusers/FVKBRKMPJ6-picture.png") }}" alt="bobo">
    </div>
  </div>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/materialize.min.js') }}"></script>
<script src="{{ asset('js/roulette.min.js') }}"></script>
<script>
  var roulette = $(".roulette").roulette({
    speed: 30,
    duration: 10,
    stopImageNumber: Math.floor((Math.random() * $(".roulette>img").length)),
    slowDownCallback: function() {
      console.log('slowDown');
    },
    stopCallback: function(img) {
      console.log($(img).attr("alt"));
    }
  })

  $(document).keypress(function(e) {
    if (e.keyCode === 13) {
      roulette.roulette("start")
    }
  })
</script>
</body>
</html>
