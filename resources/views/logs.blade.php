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
      <span class="table-title">Activity Logs</span>
      <div class="actions">
        <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons">search</i></a>
      </div>
    </div>
    <table class="datatable">
      <thead>
        <tr>
          <th>ID</th>
          <th>Username</th>
          <th>Action</th>
          <th>Date Created</th>
        </tr>
      </thead>
      <tbody>
        @foreach($logs as $log)
          <tr>
            <td>{{ $log->id }}</td>
            <td>{{ $log->username }}</td>
            <td>{{ $log->action }}</td>
            <td>{{ date("F d, Y g:i:s A", strtotime($log->created_at)) }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@include('footer')
