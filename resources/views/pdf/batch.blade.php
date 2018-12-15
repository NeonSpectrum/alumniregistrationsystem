@php($batch = 0)
@php
$excluded = [
  "Sheila Geronimo",
  "Ma. Teresa Borebor",
  "Marivic Gatus",
  "EDMON TORRES"
  "Roselle Basa",
  "ARNE BANA",
  "ARIEL AVILES",
  "SHIRLEY SHIRLEY",
  "JOVY AFABLE",
  "Sheila Geronimo",
  "Rex Bringula"
]
@endphp
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
        <tr>,
          <td>{{ $batch !== $row->batch ? $row->batch : '' }}</td>
          <td>{{ $row->first_name . " " . $row->last_name }}</td>
        </tr>
        @php($batch = $row->batch)
      @endif
    @endforeach
  </tbody>
</table>
