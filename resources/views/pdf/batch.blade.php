@php($batch = 1992)
@php($show = true)

<table width="100%">
  <thead>
    <tr>
      <th>Batch Year</th>
      <th>Name</th>
    </tr>
  </thead>
  <tbody>
    @foreach($data as $row)
      <tr>
        <td>{{ $show ? $row->batch : '' }}</td>
        <td>{{ $row->first_name . " " . $row->last_name }}</td>
      </tr>
      @php($show = $row->batch != $batch)
    @endforeach
  </tbody>
</table>
