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
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('js/scanner.js') }}"></script>
</body>
</html>
