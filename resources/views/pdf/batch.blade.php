@php($batch = 0)

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
        <td>{{ $batch !== $row->batch ? $row->batch : '' }}</td>
        <td>{{ $row->first_name . " " . $row->last_name }}</td>
      </tr>
      @php($batch = $row->batch)
    @endforeach
  </tbody>
</table>
