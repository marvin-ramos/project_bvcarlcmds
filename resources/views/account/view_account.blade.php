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
                  <img src="{{ URL::to($employeeData->profile) }}" class="rounded-circle" style="width: 100px; height: 100px;">
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
            <div class="text-center">
              <h5 class="h3">
                {{ $employeeData->firstname }} {{ $employeeData->middlename }} {{ $employeeData->lastname }}<span class="font-weight-light">, {{ $employeeData->age }}</span>
              </h5>
              <div class="h5 font-weight-300">
                <i class="ni location_pin mr-2"></i>{{ $employeeData->address }}
              </div>
              <form method="POST" action="{{ url('admin/account/add/store') }}">
              @csrf
              <h6 class="heading-small text-muted mb-4">User Account information</h6>
              <div class="row">
                <input type="hidden" name="employee_id" value="{{ $employeeData->id}}">
                <label class="form-control-label" for="role">Role</label>
                <select class="form-control @error('role') is-invalid @enderror" name="role" id="role">
                  <option  value="" disabled selected>{{ $employeeData->role_name}}</option>
                </select>
                @error('role')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="row">
                <label for="email" class="form-control-label">{{ __('Email Address') }}</label>
                <input type="text" name="email" id="email" class="form-control" value="{{ $employeeData->email }}">
              </div>
              <div class="row">
                <label for="email" class="form-control-label">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control" name="password">
              </div>
              <hr class="my-4" />
              <div class="pl-lg-4">
                <div class="row">
                  <div class="col-lg-12">
                      <a href="{{ route('employee.table') }}" class="btn btn-danger" style="width: 100%;">Back</a>
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
                      <input type="text" id="input-first-name" class="form-control" value="{{ $employeeData->firstname }}">
                    </div>
                  </div>
                  <div class="col-lg-5">
                    <div class="form-group">
                      <label class="form-control-label" for="input-last-name">Last name</label>
                      <input type="text" id="input-last-name" class="form-control" value="{{ $employeeData->lastname }}">
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <div class="form-group">
                      <label class="form-control-label" for="input-last-name">M.I.:</label>
                      <input type="text" id="input-last-name" class="form-control" value="{{ $employeeData->middlename }}">
                    </div>
                  </div>
                </div>
              </div>
              <div class="pl-lg-4">
                <div class="row">
                  <div class="col-lg-5">
                    <div class="form-group">
                      <label class="form-control-label" for="gender_id">Gender</label>
                      <select class="form-control" name="gender_id" id="gender_id">
                        <option  value="{{ $employeeData->gender_id }}">{{ $employeeData->gender }}</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-5">
                    <div class="form-group">
                      <label class="form-control-label" for="input-last-name">Birthday</label>
                      <input type="text" id="input-last-name" class="form-control" value="{{ $employeeData->birthday }}">
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <div class="form-group">
                      <label class="form-control-label" for="input-last-name">Age</label>
                      <input type="text" id="input-last-name" class="form-control" value="{{ $employeeData->age }}">
                    </div>
                  </div>
                </div>
              </div>
              <div class="pl-lg-4">
                <div class="row">
                  <div class="col-lg-7">
                    <div class="form-group">
                      <label class="form-control-label" for="input-first-name">Contact Number</label>
                      <input type="text" id="input-first-name" class="form-control"value="{{ $employeeData->contact_number }}">
                    </div>
                  </div>
                  <div class="col-lg-5">
                    <div class="form-group">
                      <label class="form-control-label" for="status_id">Status</label>
                      <select class="form-control" name="status_id" id="status_id">
                        <option  value="{{ $employeeData->status_id }}">{{ $employeeData->status }}</option>
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
                      <label class="form-control-label" for="input-address">Address</label>
                      <textarea id="input-address" class="form-control" rows="4" cols="50">{{ $employeeData->address }}</textarea>
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