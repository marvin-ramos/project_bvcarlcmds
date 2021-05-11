<div class="collapse navbar-collapse" id="sidenav-collapse-main">
  <!-- Nav items -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link active" href="{{ route('main.dashboard') }}">
        <i class="ni ni-tv-2 text-primary"></i>
        <span class="nav-link-text">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('employee.table') }}">
        <i class="ni ni-planet text-orange"></i>
        <span class="nav-link-text">Employee</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('account.table') }}">
        <i class="ni ni-pin-3 text-primary"></i>
        <span class="nav-link-text">Account</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('history.table') }}">
        <i class="ni ni-single-02 text-yellow"></i>
        <span class="nav-link-text">History</span>
      </a>
    </li>
  </ul>
</div>