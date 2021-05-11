@extends('layouts.app')

@section('content')
@role(['admin'])
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
@endrole

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

  <!-- Header -->
  <div class="header bg-primary pb-6">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
        </div>
        <!-- Card stats -->
        <div class="row">
          <div class="col-xl-4 col-md-4 col-lg-4 col-xs-12">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Total Entered People</h5>
                    <span class="h2 font-weight-bold mb-0">{{ $gate_in }}</span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                      <i class="ni ni-active-40"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-md-4 col-lg-4 col-xs-12">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Total Come Out People</h5>
                    <span class="h2 font-weight-bold mb-0">{{ $gate_out }}</span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                      <i class="ni ni-chart-pie-35"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-md-4 col-lg-4 col-xs-12">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Remaining People</h5>
                    <span class="h2 font-weight-bold mb-0">{{ $remain_people }}</span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                      <i class="ni ni-money-coins"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Page content -->
  <div class="container-fluid mt--6">
    <div class="row">
      <div class="col-xl-8">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col">
                <h6 class="text-light text-uppercase ls-1 mb-1">Overview</h6>
                <h5 class="h3 text-white mb-0">Total Record Of People Entering Establishment</h5>
              </div>
            </div>
          </div>
          <div class="card-body">
            <!-- Chart -->
            <div class="chart">
              <!-- Chart wrapper -->
              <canvas id="lineData" height="245"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col">
                <h6 class="text-uppercase text-muted ls-1 mb-1">Record</h6>
                <h5 class="h3 mb-0">Total People Visit</h5>
              </div>
            </div>
          </div>
          <div class="card-body">
            <!-- Chart -->
            <div class="chart">
              <canvas id="barData" height="245"></canvas>
            </div>
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
  <script>
    var ctx = document.getElementById('barData').getContext('2d');
    var chart = new Chart(ctx, {
    type: 'bar',
    data: {
    labels:  {!! json_encode($chart->labels) !!} ,
    datasets: [
      {
      label: 'Visitor Record',
      backgroundColor: "rgba(71, 195, 99, 0.5)",
      data:  {!! json_encode($chart->dataset)!!} ,
      borderColor: "#47c363",
          fill: true,
      },
    ]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'top',
        },
        title: {
          display: true,
          text: 'Chart.js Line Chart'
        }
        },
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            callback: function(value) {
              if (value % 1 === 0) {
                return value;
              }
            }
          },
          scaleLabel: {
          display: false
          }
        }]
      },
      legend: {
        labels: {
        fontColor: '#122C4B',
        fontFamily: "'Muli', sans-serif",
        padding: 25,
        boxWidth: 25,
        fontSize: 14,
        }
      },
      layout: {
        padding: {
          left: 10,
          right: 10,
          top: 0,
          bottom: 10
        }
      }
    }
    });
  </script>
  <script>
    var ctx = document.getElementById('lineData').getContext('2d');
    var chart = new Chart(ctx, {
    type: 'line',
    data: {
    labels:  {!! json_encode($chart->labels) !!} ,
    datasets: [
      {
      label: 'Visitor Record',
      backgroundColor: "rgba(71, 195, 99, 0.5)",
      data:  {!! json_encode($chart->dataset)!!} ,
      borderColor: "#47c363",
          fill: true,
      },
    ]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'top',
        },
        title: {
          display: true,
          text: 'Chart.js Line Chart'
        }
        },
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            callback: function(value) {
              if (value % 1 === 0) {
                return value;
              }
            }
          },
          scaleLabel: {
          display: false
          }
        }]
      },
      legend: {
        labels: {
        fontColor: '#122C4B',
        fontFamily: "'Muli', sans-serif",
        padding: 25,
        boxWidth: 25,
        fontSize: 14,
        }
      },
      layout: {
        padding: {
          left: 10,
          right: 10,
          top: 0,
          bottom: 10
        }
      }
    }
    });
  </script>
@endsection