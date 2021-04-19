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
              <h3 class="mb-0">Add Account Records</h3>
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
                    <input type="email" id="input-email" class="form-control" placeholder="jesse@example.com">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="input-password">Password</label>
                    <input type="password" id="input-password" class="form-control" placeholder="Username">
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
                    <input type="text" id="input-first-name" class="form-control" placeholder="First name" value="Lucky">
                  </div>
                </div>
                <div class="col-lg-5">
                  <div class="form-group">
                    <label class="form-control-label" for="input-last-name">Last name</label>
                    <input type="text" id="input-last-name" class="form-control" placeholder="Last name" value="Jesse">
                  </div>
                </div>
                <div class="col-lg-2">
                  <div class="form-group">
                    <label class="form-control-label" for="input-last-name">M.I.:</label>
                    <input type="text" id="input-last-name" class="form-control" placeholder="Last name" value="Jesse">
                  </div>
                </div>
              </div>
            </div>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-lg-5">
                  <div class="form-group">
                    <label class="form-control-label" for="input-first-name">Gender</label>
                    <input type="text" id="input-first-name" class="form-control" placeholder="First name" value="Lucky">
                  </div>
                </div>
                <div class="col-lg-5">
                  <div class="form-group">
                    <label class="form-control-label" for="input-last-name">Birthday</label>
                    <input type="text" id="input-last-name" class="form-control" placeholder="Last name" value="Jesse">
                  </div>
                </div>
                <div class="col-lg-2">
                  <div class="form-group">
                    <label class="form-control-label" for="input-last-name">Age</label>
                    <input type="text" id="input-last-name" class="form-control" placeholder="Last name" value="Jesse">
                  </div>
                </div>
              </div>
            </div>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-lg-7">
                  <div class="form-group">
                    <label class="form-control-label" for="input-first-name">Contact Number</label>
                    <input type="text" id="input-first-name" class="form-control" placeholder="First name" value="Lucky">
                  </div>
                </div>
                <div class="col-lg-5">
                  <div class="form-group">
                    <label class="form-control-label" for="input-last-name">Status</label>
                    <input type="text" id="input-last-name" class="form-control" placeholder="Last name" value="Jesse">
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
                    <textarea id="input-address" class="form-control" rows="4" cols="50">Address</textarea>
                  </div>
                </div>
              </div>
            </div>

            <hr class="my-4" />
            <h6 class="heading-small text-muted mb-4">Employee Profile</h6>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-md-9">
                  <div class="form-group">
					<input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <button class="btn btn-success">Register</button>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <a href="{{ route('employee.table') }}" class="btn btn-danger">Cancel</a>
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