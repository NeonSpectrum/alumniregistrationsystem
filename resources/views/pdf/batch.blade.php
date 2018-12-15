@php($batch = 0)
@php($batchYear = [])
<table width="100%">
  <thead>
    <tr>
      <th>Batch Year</th>
      <th>Name</th>
    </tr>
  </thead>
  <tbody>
    @foreach($data as $row)
      @if($row->batch != 0)
        @php
          $batchYear[$row->batch] = $batchYear[$row->batch] ? $batchYear[$row->batch] + 1 : 1;
        @endphp
        <tr>
          <td>{{ $batch !== $row->batch ? $row->batch : '' }}</td>
          <td>{{ $row->first_name . " " . $row->last_name }}</td>
        </tr>
        @php($batch = $row->batch)
      @endif
    @endforeach
  </tbody>
</table>
Most Visited Batch Year: {{ max(array_keys($batchYear)) }}
