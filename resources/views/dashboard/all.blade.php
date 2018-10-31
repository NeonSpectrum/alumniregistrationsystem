@php ($active = "dashboard")

@include('header')
@include('navbar')
<div class="col s12" style="margin: 30px 50px 0 50px">
  <div class="card material-table">
    <div class="table-header">
      <span class="table-title">{{ Common::encrypt("ECWTH4RRQK") }}List of All Guests (Total: {{ $total }})</span>
      <div class="actions">
        <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons">search</i></a>
      </div>
    </div>
    <table class="datatable">
      <thead>
        <tr>
          <th width="5%">ID</th>
          <th>Name</th>
          <th>Email Address</th>
          <th>Reference Number</th>
          <th>Companions</th>
          <th>Contact Number</th>
          <th width="8%">Batch</th>
          <th>Referrer</th>
          <th>Date Registered</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $id => $row)
          <tr>
            <td>{{ $id + 1 }}</td>
            <td>
              <a href="#" onclick="showGuestInfo({{ $row['data']->id }})">
                {{ $row["data"]->first_name . " " . $row["data"]->last_name }}{{ $row["data"]->nickname ? " ({$row["data"]->nickname})" : "" }}
              </a>
            </td>
            <td>{{ $row["data"]->email_address }}</td>
            <td>{{ $row["data"]->reference_number }}</td>
            <td>{!! $row["companion"] !!}</td>
            <td>{{ $row["data"]->contact_number }}</td>
            <td>{{ $row["data"]->batch }}</td>
            <td>{{ $row["data"]->referrer }}</td>
            <td>{{ date("F d, Y", strtotime($row["data"]->created_at)) }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@include('dashboard.modal')
@include('footer')
