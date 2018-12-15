@php($batch = 1992)

<table>
  <thead>
    <tr>
      <th>Batch Year</th>
      <th>Name</th>
    </tr>
  </thead>
  <tbody>
    @foreach($data as $row)
      <tr>
        <td>{{ $row->batch == $batch ? $row->batch : '' }}</td>
        <td>{{ $row->first_name . " " . $row->last_name }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
