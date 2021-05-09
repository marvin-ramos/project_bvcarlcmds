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
  <div class="header pb-6 d-flex align-items-center" style="min-height: 150px;">
    <!-- Mask -->
    <span class="mask bg-gradient-default opacity-8"></span>
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
      <div class="row">
        <div class="col-lg-7 col-md-10">
        </div>
      </div>
    </div>
  </div>
  <!-- Page content -->
  <div class="container-fluid mt--6">
    <div class="row">
      <div class="col-xl-4 order-xl-2">
        <div class="card card-profile">
          <div class="row justify-content-center">
            <div class="col-lg-3 order-lg-2">
              <div class="card-profile-image">
                <a href="#">
                  <img src="{{ URL::to(($user->employee)->profile) }}" class="rounded-circle" style="width: 100px; height: 100px;">
                </a>
              </div>
            </div>
          </div>
          <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
            <div class="d-flex justify-content-between">
            </div>
          </div>
          <div class="card-body pt-0">
            <div class="row">
              <div class="col">
                <div class="card-profile-stats d-flex justify-content-center">
                </div>
              </div>
            </div>
            <div class="text-left">
              <form class="needs-validation" method="POST" action="{{ url('edit/password') }}">
                @csrf
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label class="form-control-label" for="input-email">User Role</label>
                      <input type="text" id="input-email" class="form-control" value="{{ $user->role_name }}">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label class="form-control-label" for="input-email">Email address</label>
                      <input type="email" id="input-email" class="form-control" value="{{ $user->email }}">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label class="form-control-label" for="current_password">Current Password</label>
                      <input type="password" id="current_password" class="form-control" name="current_password">
                    </div>
                    @error('current_password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label class="form-control-label" for="new_password">New Password</label>
                      <input type="password" id="new_password" class="form-control" name="new_password">
                    </div>
                    @error('new_password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label class="form-control-label" for="new_confirm_password">Confirm Password</label>
                      <input type="password" id="new_confirm_password" class="form-control" name="new_confirm_password">
                    </div>
                    @error('new_confirm_password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <button type="submit" class="btn btn-success" style="width: 100%;">Update</button>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
                      <a onclick="return confirmation()" class="btn btn-danger" style="width: 100%;color: #fff;">Cancel</a>
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
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-8 order-xl-1">
        <div class="card">
          <div class="card-header">
            <div class="row align-items-center">
              <div class="col-8">
                <h3 class="mb-0">Edit profile </h3>
              </div>
              <div class="col-4 text-right">
              </div>
            </div>
          </div>
          <div class="card-body">
            <form>
              <h6 class="heading-small text-muted mb-4">User information</h6>
              <div class="pl-lg-4">
                <div class="row">
                  <div class="col-lg-5">
                    <div class="form-group">
                      <label class="form-control-label" for="input-first-name">First name</label>
                      <input type="text" id="input-first-name" class="form-control" value="{{ optional($user->employee)->firstname }}">
                    </div>
                  </div>
                  <div class="col-lg-5">
                    <div class="form-group">
                      <label class="form-control-label" for="input-last-name">Last name</label>
                      <input type="text" id="input-last-name" class="form-control" value="{{ optional($user->employee)->lastname }}">
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <div class="form-group">
                      <label class="form-control-label" for="input-last-name">M.I.:</label>
                      <input type="text" id="input-last-name" class="form-control" value="{{ optional($user->employee)->middlename }}">
                    </div>
                  </div>
                </div>
              </div>
              <div class="pl-lg-4">
                <div class="row">
                  <div class="col-lg-5">
                    <div class="form-group">
                      <label class="form-control-label" for="input-first-name">Gender</label>
                      <input type="text" id="input-first-name" class="form-control" value="{{ optional($user->employee->gender)->gender }}">
                    </div>
                  </div>
                  <div class="col-lg-5">
                    <div class="form-group">
                      <label class="form-control-label" for="input-last-name">Birthday</label>
                      <input type="text" id="input-last-name" class="form-control" value="{{ optional($user->employee)->birthday }}">
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <div class="form-group">
                      <label class="form-control-label" for="input-last-name">Age</label>
                      <input type="text" id="input-last-name" class="form-control" value="{{ optional($user->employee)->age }}">
                    </div>
                  </div>
                </div>
              </div>
              <div class="pl-lg-4">
                <div class="row">
                  <div class="col-lg-7">
                    <div class="form-group">
                      <label class="form-control-label" for="input-first-name">Contact Number</label>
                      <input type="text" id="input-first-name" class="form-control" value="{{ optional($user->employee)->contact_number }}">
                    </div>
                  </div>
                  <div class="col-lg-5">
                    <div class="form-group">
                      <label class="form-control-label" for="input-last-name">Status</label>
                      <input type="text" id="input-last-name" class="form-control" value="{{ optional($user->employee->status)->status }}">
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
                      <label class="form-control-label" for="input-address">Address</label>
                      <textarea id="input-address" class="form-control" rows="5" cols="50">{{ optional($user->employee)->address }}</textarea>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <footer class="footer pt-0 bg-default">
      @include('layouts.footer')
    </footer>
    
  </div>
</div>

@endsection