@include('header')
<nav style="background: green">
  <div class="nav-wrapper">
    <a href="#" class="brand-logo" style="margin-left:20px;font-size:25px">Alumni Registration</a>
    <ul id="nav-mobile" class="right hide-on-med-and-down">
      <li><a href="{{ url('/logout') }}" onclick="return confirm('Are you sure do you want to logout?')">Logout</a></li>
    </ul>
  </div>
</nav>
<div class="col s12" style="margin: 30px 50px 0 50px">
  <div class="card material-table">
    <div class="table-header">
      <span class="table-title">List of Registered Guests</span>
      <div class="actions">
        <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons">search</i></a>
      </div>
    </div>
    <table class
    ="datatable">
      <thead>
        <tr>
          <th width="10%">ID</th>
          <th width="30%">Name</th>
          <th width="30%">Companion List</th>
          <th width="15%">Picture</th>
          <th width="15%">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $row)
          <tr>
            <td>{{ $row["data"]->id }}</td>
            <td>{{ $row["data"]->first_name . " " . $row["data"]->last_name }} ({{ $row["data"]->email_address }})</td>
            <td>{!! $row["companion"] !!}</td>
            <td>
              @if($row["data"]->reference_file_name)
                <img class="materialboxed" src="{{ asset('public/references/' . $row["data"]->reference_file_name) }}" height="100px" width="100px" style="object-fit:cover">
              @else
                <span style="color:red;font-style:italic">N/A</span>
              @endif
            </td>
            <td>
              <button class="waves-effect waves-light btn btnSendTicket" data-code="{{ $row['code'] }}">
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
@include('footer')
