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
                  <div>
                    <span class="heading">22</span>
                    <span class="description">Friends</span>
                  </div>
                  <div>
                    <span class="heading">10</span>
                    <span class="description">Photos</span>
                  </div>
                  <div>
                    <span class="heading">89</span>
                    <span class="description">Comments</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="text-center">
              <h5 class="h3">
                {{ optional($user->employee)->firstname }} {{ optional($user->employee)->middlename }} {{ optional($user->employee)->lastname }} <span class="font-weight-light">, {{ optional($user->employee)->age }}</span>
              </h5>
              <div class="h5 font-weight-300">
                <i class="ni location_pin mr-2"></i>{{ optional($user->employee)->address }}
              </div>
              <div class="h5 mt-4">
                <i class="ni business_briefcase-24 mr-2"></i>{{ $user->role_name }} - BVCARCMDS
              </div>
              <div>
                <i class="ni education_hat mr-2"></i><p style="font-size: 12px; text-align: left;">Hello I'm <span>{{ optional($user->employee)->firstname }} {{ optional($user->employee)->middlename }} {{ optional($user->employee)->lastname }}</span>, <span>{{ optional($user->employee)->age }}</span> yrs old of age <span>{{ optional($user->employee->gender)->gender }}</span> and i live in a wonderful city of <span>{{ optional($user->employee)->address }}</span> where i was born on <span>{{ optional($user->employee)->birthday }}</span>.</p>
                <p style="font-size: 12px; text-align: left;">
                  <span style="font-weight: bold;">Please, keep in touch and you can email me</span><br>
                  <i class="fa fa-mail-bulk"></i> <span>{{ optional($user)->email }}</span><br>
                  <i class="fa fa-phone"></i> <span>{{ optional($user->employee)->contact_number }}</span>
                </p>
              </div>
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
              <h6 class="heading-small text-muted mb-4">User Account information</h6>
              <div class="pl-lg-4">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-email">Email address</label>
                      <input type="email" id="input-email" class="form-control" value="{{ $user->email }}">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-password">Password</label>
                      <input type="password" id="input-password" class="form-control" value="{{ $user->password }}">
                    </div>
                  </div>
                </div>
              </div>
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
                      <textarea id="input-address" class="form-control" rows="4" cols="50">{{ optional($user->employee)->address }}</textarea>
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