<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Nickname</th>
      <th>Email Address</th>
      <th>Reference Number</th>
      <th>Contact Number</th>
      <th>Company</th>
      <th>Job Title</th>
      <th>Batch</th>
      <th>Referrer</th>
      <th>Date Registered</th>
    </tr>
  </thead>
  <tbody>
    @foreach($data as $id => $row)
      <tr>
        <td>{{ $id + 1 }}</td>
        <td>{{ $row["data"]->first_name . " " . $row["data"]->middle_initial . " " . $row["data"]->last_name }}</td>
        <td>{{ $row["data"]->nickname }} </td>
        <td>{{ $row["data"]->email_address }}</td>
        <td>{{ $row["data"]->reference_number }}</td>
        <td>{{ $row["data"]->contact_number }}</td>
        <td>{{ $row["data"]->company }}</td>
        <td>{{ $row["data"]->job_title }}</td>
        <td>{{ $row["data"]->batch }}</td>
        <td>{{ $row["data"]->referrer }}</td>
        <td>{{ date("F d, Y", strtotime($row["data"]->created_at)) }}</td>
      </tr>
      @if(count($row["companions"]) > 0)
        @foreach($row["companions"] as $companion)
          <tr>
            <td></td>
            <td>{{ $companion->first_name . " " . $companion->middle_initial . " " . $companion->last_name }}</td>
            <td>{{ $companion->nickname }}</td>
            <td>{{ $companion->email_address }}</td>
            <td>{{ $companion->reference_number }}</td>
            <td></td>
            <td>{{ $companion->company }}</td>
            <td>{{ $companion->job_title }}</td>
            <td>{{ $companion->batch }}</td>
            <td></td>
            <td></td>
          </tr>
        @endforeach
      @endif
    @endforeach
  </tbody>
</table>
