  <script>const main_url="{{ url('/') }}"</script>
  <script src="{{ asset('public/js/app.js') }}"></script>
  <script src="{{ asset('public/js/jquery.serializejson.min.js') }}"></script>
  <script src="{{ asset('public/js/materialize.min.js') }}"></script>
  <script src="{{ asset('public/js/datatables.min.js') }}"></script>
  <script src="{{ asset('public/js/datatable-custom.js') }}"></script>
  <script src="{{ asset('public/js/sweetalert2.all.min.js') }}"></script>
  <script src="{{ asset('public/js/script.js') }}?v={{ filemtime(public_path('js/script.js')) }}"></script>
</body>
</html>
