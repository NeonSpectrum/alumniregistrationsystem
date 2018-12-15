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
        <tr>
          <td>{{ $batch !== $row->batch ? $row->batch : '' }}</td>
          <td>{{ $row->first_name . " " . $row->last_name }}</td>
        </tr>
        @php
          $batch = $row->batch
          $batchYear[$batch] = $batchYear[$batch] ? $batchYear[$batch] + 1 : 1;
        @endphp
      @endif
    @endforeach
  </tbody>
</table>
Most Visited Batch Year: {{ getMostVisited($batchYear)["year"] }}

@php
function getMostVisited($batchYear){
  $max = ["year" => 0, "count" => 0];

  foreach ($batchYear as $year => $value) {
    if($max["count"] < $value){
      $max["year"] = $year;
      $max["count"] = $value;
    }
  }

  $return $max;
}
@endphp
