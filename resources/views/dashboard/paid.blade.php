@php ($active = "dashboard")

@include('header')
@include('navbar')
<div class="col s12" style="margin: 30px 50px 0 50px">
  <div class="card material-table">
    <div class="table-header">
      <span class="table-title">List of Paid Guests (Total: {{ $total }})</span>
      <div class="actions">
        <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons">search</i></a>
      </div>
    </div>
    <table class
    ="datatable">
      <thead>
        <tr>
          <th width="5%">ID</th>
          <th width="30%">Name</th>
          <th width="20%">Companion List</th>
          <th width="15%">Picture</th>
          <th width="15%">Remarks</th>
          <th width="15%">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $id => $row)
          <tr>
            <td>{{ $id + 1 }}</td>
            <td>{{ $row["data"]->first_name . " " . $row["data"]->last_name }} | {{ $row["data"]->email_address }} | {{ $row["data"]->reference_number }}</td>
            <td>{!! $row["companion"] !!}</td>
            <td>
              @if($row["data"]->reference_file_name)
                <img class="materialboxed" src="{{ asset('public/references/' . $row["data"]->reference_file_name) }}" height="100px" width="100px" style="object-fit:cover">
              @else
                <span style="color:red;font-style:italic">N/A</span>
              @endif
            </td>
            <td>{{ $row["data"]->remarks }}</td>
            <td style="padding: 5px">
              <button class="waves-effect waves-light btn btnSendTicket" data-code="{{ $row['code'] }}" style="width:100%;margin-top:5px">
                SEND TICKET
                <i class="material-icons left">send</i>
              </button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@include('dashboard.modal')
@include('footer')
