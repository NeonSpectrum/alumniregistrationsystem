@include('header')
<nav style="background: green">
  <div class="nav-wrapper">
    <a href="#" class="brand-logo" style="margin-left:20px;font-size:25px">Alumni Registration</a>
    <ul id="nav-mobile" class="right hide-on-med-and-down">
      <li class="active"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
      <li><a href="{{ url('/logs') }}">Logs</a></li>
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
          <th width="5%">ID</th>
          <th width="35%">Name</th>
          <th width="30%">Companion List</th>
          <th width="15%">Picture</th>
          <th width="15%">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $row)
          <tr>
            <td>{{ $row["data"]->id }}</td>
            <td>{{ $row["data"]->first_name . " " . $row["data"]->last_name }} | {{ $row["data"]->email_address }} | {{ $row["data"]->reference_number }}</td>
            <td>{!! $row["companion"] !!}</td>
            <td>
              @if($row["data"]->reference_file_name)
                <img class="materialboxed" src="{{ asset('public/references/' . $row["data"]->reference_file_name) }}" height="100px" width="100px" style="object-fit:cover">
              @else
                <span style="color:red;font-style:italic">N/A</span>
              @endif
            </td>
            <td style="padding: 5px">
              <button class="waves-effect waves-light btn btnSendTicket" data-code="{{ $row['code'] }}" style="width:100%">
                SEND TICKET
                <i class="material-icons left">send</i>
              </button>
              <button class="waves-effect waves-light btn btnDelete red" data-code="{{ $row['code'] }}" style="width:100%;margin-top:5px">
                DELETE
                <i class="material-icons left">delete</i>
              </button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<div id="verifyPasswordModal" class="modal">
  <form name="frmVerifyPassword" data-type="with-companions">
    <input type="hidden" name="type">
    <input type="hidden" name="code">
    <div class="modal-content">
      <h4>Verify Password</h4>
      <div class="input-field">
        <input id="verify_password" name="password" type="password" class="validate">
        <label for="verify_password">Password</label>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="modal-close waves-effect waves-green btn-flat">Cancel</button>
      <button type="submit" class=" waves-effect waves-green btn-flat">Send</button>
    </div>
  </form>
</div>
@include('footer')
