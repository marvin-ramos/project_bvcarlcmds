@extends('layouts.app')

@section('content')
<div class="main-content">
	
<!-- Header -->
<div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
  <div class="separator separator-bottom separator-skew zindex-100">
    <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
      <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
    </svg>
  </div>
</div>

<!-- Page content -->
<div class="container mt--8 pb-5">
  <div class="row justify-content-center">
    <div class="col-lg-5 col-md-7">
      <div class="card bg-secondary border-0 mb-0">
        <div class="card-header bg-transparent pb-5">
          <div class="text-muted text-center mt-2 mb-3"><small>Sign in with</small></div>
          <div class="btn-wrapper text-center">
            <a href="#" class="text-muted text-center mt-2 mb-3">
              <h1>BVCARCMDS</h1>
            </a>
          </div>
        </div>
        <div class="card-body px-lg-5 py-lg-5">
          <form role="form">
            <div class="form-group mb-3">
              <div class="input-group input-group-merge input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                </div>
                <input class="form-control" placeholder="Email" type="email">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group input-group-merge input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                </div>
                <input class="form-control" placeholder="Password" type="password">
              </div>
            </div>
            <div class="text-center">
              <button type="button" class="btn btn-primary my-4">Sign in</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection