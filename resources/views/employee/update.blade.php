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
<div class="header pb-6 d-flex align-items-center" style="min-height: 150px;">
  <!-- Mask -->
  <span class="mask bg-gradient-default opacity-8"></span>
  <!-- Header container -->
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
    				    <img src="{{ URL::to($employeeData->profile) }}" style="width: 150px; height: 150px;" class="rounded-circle">
    				  </a>
    				</div>
    			</div>
    		</div>
    		<div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
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
        		  {{ $employeeData->lastname }} {{ $employeeData->firstname }} {{ $employeeData->middlename }}<span class="font-weight-light">, {{ $employeeData->age }}</span>
        		</h5>
        		<div class="h5 font-weight-300">
        		  <i class="ni location_pin mr-2"></i>{{ $employeeData->address }}
        		</div>
        		<div class="h5 mt-4">
        		  <i class="ni business_briefcase-24 mr-2"></i>Solution Manager - Creative Tim Officer
        		</div>
        		<div>
        		  <i class="ni education_hat mr-2"></i>Bidirectional Visitor Counter with Automatic Room Light Controller and Management Display System
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
              <h3 class="mb-0">Update Employee</h3>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('employee.update', $employeeData->id) }}" enctype="multipart/form-data">
            @csrf
            <h6 class="heading-small text-muted mb-4">User information</h6>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-lg-5">
                  <div class="form-group">
                    <label class="form-control-label" for="firstname">First name</label>
                    <input type="text" id="firstname" name="firstname" class="form-control  @error('firstname') is-invalid @enderror" value="{{ $employeeData->firstname }}">
                    @error('firstname')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-5">
                  <div class="form-group">
                    <label class="form-control-label" for="lastname">Last name</label>
                    <input type="text" id="lastname" name="lastname" class="form-control  @error('lastname') is-invalid @enderror" value="{{ $employeeData->lastname }}">
                    @error('lastname')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-2">
                  <div class="form-group">
                    <label class="form-control-label" for="middlename">M.I.:</label>
                    <input type="text" id="middlename" name="middlename" class="form-control  @error('middlename') is-invalid @enderror" value="{{ $employeeData->middlename }}">
                    @error('middlename')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
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
                      <option  value="{{ $employeeData->gender_id }}">{{ $employeeData->gender }}</option>
                      @foreach($genderData as $gender)
                      <option value="{{ $gender->id }}">{{ $gender->gender }}</option>
                      @endforeach
                    </select>
                    @error('gender_id')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-5">
                  <div class="form-group">
                    <label class="form-control-label" for="birth_date">Birthday</label>
                    <input type="text" id="birth_date" class="form-control @error('birth_date') is-invalid @enderror" placeholder="MM/DD/YYYY" name="birthday" value="{{ $employeeData->birthday }}">
                    @error('birthday')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-2">
                  <div class="form-group">
                    <label class="form-control-label" for="age">Age</label>
                    <input type="text" id="age" class="form-control" name="age" value="{{ $employeeData->age }}">
                  </div>
                </div>
              </div>
            </div>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-lg-7">
                  <div class="form-group">
                    <label class="form-control-label" for="contact_number">Contact Number</label>
                    <input type="text" id="contact_number" name="contact_number" class="form-control  @error('contact_number') is-invalid @enderror" value="{{ $employeeData->contact_number }}">
                    @error('contact_number')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-5">
                  <div class="form-group">
                    <label class="form-control-label" for=status_id>Status</label>
                    <select class="form-control @error('status_id') is-invalid @enderror" name="status_id" id="status_id">
                      <option  value="{{ $employeeData->status_id }}">{{ $employeeData->status }}</option>
                      @foreach($statusData as $status)
                        <option value="{{ $status->id }}">{{ $status->status }}</option>
                      @endforeach
                    </select>
                      @error('status_id')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
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
                    <textarea id="address" class="form-control @error('address') is-invalid @enderror" rows="4" cols="50" name="address">{{ $employeeData->address }}</textarea>
                    @error('address')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              </div>
            </div>

            <hr class="my-4" />
            <h6 class="heading-small text-muted mb-4">Employee Profile</h6>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-7">
                  <div class="form-group">
                    <input type="file" id="profile" name="profile" class="form-control @error('profile') is-invalid @enderror">
                    @error('profile')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <button type="submit" class="btn btn-success">Update</button>
                  </div>
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