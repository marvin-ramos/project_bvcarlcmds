@extends('layouts.app')

@section('content')
<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
<div class="scrollbar-inner">
  <!-- Brand -->
  <div class="sidenav-header  align-items-center">
    <a class="navbar-brand" href="javascript:void(0)">
      <img src="../assets/img/brand/blue.png" class="navbar-brand-img" alt="...">
    </a>
  </div>
  <div class="navbar-inner">

    <!-- Collapse -->
    @include('layouts.sidebar')

  </div>
</div>
</nav>

<!-- Main content -->
<div class="main-content" id="panel">
<!-- Topnav -->
<nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
 
    <!-- Navbar links -->
    @include('layouts.topnav')

    </div>
  </div>
</nav>

<!-- Header -->
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
        </div>
        <div class="col-lg-6 col-5 text-right">
          <a href="{{ route('employee.add') }}" class="btn btn-sm btn-success" style="width: 20%;">Add</a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col">
      <div class="card">
        <!-- Card header -->
        <div class="card-header border-0">
          <h3 class="mb-0">Employee Data Table</h3>
        </div>

        <!-- Light table -->
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col" class="sort" data-sort="id">ID</th>
                <th scope="col" class="sort" data-sort="profile">Picture</th>
                <th scope="col" class="sort" data-sort="name">Name</th>
                <th scope="col" class="sort" data-sort="address">Address</th>
                <th scope="col" class="sort" data-sort="created">Created At</th>
                <th scope="col" class="sort" data-sort="completion">Action</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody class="list">
              @foreach ($employees as $employee)
                <tr>
                    <td class="id">{{ ++$i }}</td>
                    <th scope="row" class="profile">
                      <div class="media align-items-center">
                        <a href="#" class="avatar rounded-circle mr-3">
                          <img alt="Profile" src="{{ URL::to($employee->profile) }}">
                        </a>
                      </div>
                    </th>
                    <td class="name">{{ $employee->firstname }} {{ $employee->middlename }} {{ $employee->lastname }}</td>
                    <td class="address">{{ $employee->address }}</td>
                    <td class="created">{{ $employee->created_at }}</td>
                    <td style="width: 100%;">
                      <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-primary btn-sm" style="width: 30%;">Edit</a>
                      <a href="{{ route('employee.view', $employee->id) }}" class="btn btn-secondary btn-sm" style="width: 30%;">View</a>
                      <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
                      <a class="btn btn-danger btn-sm" onclick="return confirmationDeleteEmployee();" style="width: 30%;">Erase</a>
                      <script type="text/javascript">
                        function confirmationDeleteEmployee() {
                          swal({
                            title: "Alert",
                            text: "Are you sure you want to Delete the records?",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                          }).then(okay => {
                            if(okay) {
                              window.location.href = "{{ route('employee.delete', $employee->id) }}";
                            }
                          });
                        }
                      </script>
                    </td>
                </tr>
              @endforeach
            </tbody>
          </table>

          {!! $employees->links() !!}
        </div>
      </div>
    </div>
  </div>

	<!-- Footer -->
	<footer class="footer pt-0 bg-default">
	  @include('layouts.footer')
	</footer>

</div>
</div>
@endsection


@section('scripts')
<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
<script>
  @if(session('success'))
    swal({
      title: '{{ session('alertTitle') }}',
      text:  '{{ session('success') }}',
      icon:  '{{ session('alertIcon') }}',
      button: "OK",
    });
  @endif
</script>
@endsection