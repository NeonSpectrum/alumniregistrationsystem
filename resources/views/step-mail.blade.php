Dear {{ $data->name }},
<br><br>
Please do something about the steps.
<br><br>
1. something<br>
2. something<br>
3. something
<br><br>
To upload a file please click the link below.<br>
{{ url('upload?code=' . $data->code) }}
