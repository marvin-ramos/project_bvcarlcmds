@extends('layouts.app')

@section('content')
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
<nav class="navbar navbar-top navbar-expand navbar-dark bg-default border-bottom">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      
      <!-- Navbar links -->
      @include('layouts.topnav')

    </div>
  </div>
</nav>
<!-- Header -->
<!-- Header -->
<div class="header pb-6 d-flex align-items-center" style="min-height: 150px; background-image: url(../assets/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
  <!-- Mask -->
  <span class="mask bg-gradient-default opacity-8"></span>
  <!-- Header container -->
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col-xl-12 col-12 col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col-8">
              <h3 class="mb-0">Add Employee</h3>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('employee.store') }}">
            @csrf
            <h6 class="heading-small text-muted mb-4">User information</h6>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-lg-5">
                  <div class="form-group">
                    <label class="form-control-label" for="firstname">First name</label>
                    <input type="text" id="firstname" name="firstname" class="form-control" value="{{ $employeeData->firstname }}">
                  </div>
                </div>
                <div class="col-lg-5">
                  <div class="form-group">
                    <label class="form-control-label" for="lastname">Last name</label>
                    <input type="text" id="lastname" name="lastname" class="form-control" value="{{ $employeeData->lastname }}">
                  </div>
                </div>
                <div class="col-lg-2">
                  <div class="form-group">
                    <label class="form-control-label" for="middlename">M.I.:</label>
                    <input type="text" id="middlename" name="middlename" class="form-control" value="{{ $employeeData->middlename }}">
                  </div>
                </div>
              </div>
            </div>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-lg-5">
                  <div class="form-group">
                    <label class="form-control-label" for="gender">Gender</label>
                    <select class="form-control @error('gender_id') is-invalid @enderror" name="gender_id" id="gender_id">
                      <option  value="" disabled selected>{{ $employeeData->gender }}</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-5">
                  <div class="form-group">
                    <label class="form-control-label" for="birth_date">Birthday</label>
                    <input type="text" class="form-control" name="birthday" value="{{ $employeeData->birthday }}">
                  </div>
                </div>
                <div class="col-lg-2">
                  <div class="form-group">
                    <label class="form-control-label" for="age">Age</label>
                    <input type="text" id="age" class="form-control" value="{{ $employeeData->age }}">
                  </div>
                </div>
              </div>
            </div>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-lg-7">
                  <div class="form-group">
                    <label class="form-control-label" for="contact_number">Contact Number</label>
                    <input type="text" id="contact_number" name="contact_number" class="form-control" value="{{ $employeeData->contact_number }}">
                  </div>
                </div>
                <div class="col-lg-5">
                  <div class="form-group">
                    <label class="form-control-label" for=status_id>Status</label>
                    <select class="form-control" name="status_id" id="status_id">
                      <option  value="" disabled selected>{{ $employeeData->status }}</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <hr class="my-4" />
            <h6 class="heading-small text-muted mb-4">Contact information</h6>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="form-control-label" for="address">Address</label>
                    <textarea id="address" class="form-control" rows="4" cols="50">{{ $employeeData->address }}</textarea>
                  </div>
                </div>
              </div>
            </div>

            <hr class="my-4" />
            <h6 class="heading-small text-muted mb-4"></h6>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-md-9">
                </div>
                <div class="col">
                </div>
                <div class="col">
                  <div class="form-group">
                    <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
                    <a onclick="return confirmation()" class="btn btn-danger" style="color: #fff;">Cancel</a>
                      <script>
                        function confirmation() {
                          swal({
                            title: "Alert",
                            text: "Are you sure you want to go back ??",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                          }).then(okay => {
                            if(okay) {
                              window.location.href = "{{ route('employee.table') }}";
                            }
                          });
                        }
                      </script>
                  </div>
                </div>
              </div>
            </div>
          </form>
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