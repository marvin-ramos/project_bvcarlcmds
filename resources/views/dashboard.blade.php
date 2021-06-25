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
      <div class="header-body" id="cards">
        <div class="row align-items-center py-4">
        </div>

        @include('layouts.card')

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
              <canvas id="barData" height="245" class="TotalPeopleVisit"></canvas>
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
    function loadlink(){
      $('#cards').load("/card");
      console.log('TESTING!!!!');
    }

    loadlink();
    setInterval(function(){
        loadlink()
    }, 1000);
  </script>
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
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: {!! json_encode($chart->labels) !!},
        datasets: [
          {
          label: 'Total Visitors',
          backgroundColor: "rgba(71, 195, 99, 0.5)",
          data:  {!! json_encode($chart->dataset)!!},
          borderColor: "#47c363",
              fill: true,
          },
        ]
      },
      options: {
        scales: {
          xAxes: [],
          yAxes: [{
            ticks: {
              beginAtZero:true
            }
          }]
        }
      }
    });
  </script>
  <script>
    var ctx = document.getElementById('lineData').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: [],
        datasets: [
          {
          label: 'IN',
          backgroundColor: "rgba(71, 195, 99, 0.5)",
          data:  [],
          borderColor: "#47c363",
              fill: true,
          },{
          label: 'OUT',
          backgroundColor: "rgba(252, 84, 75, 0.5)",
          data:  [],
          borderColor: "#fc544b",
          fill: true,
          },
        ]
      },
      options: {
        scales: {
          xAxes: [],
          yAxes: [{
            ticks: {
              beginAtZero:true
            }
          }]
        }
      }
    });
    var updateChart = function() {
      $.ajax({
        url: "{{ route('api.chart') }}",
        type: 'GET',
        dataType: 'json',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
          myChart.data.labels = data.labels;
          myChart.data.datasets[0].data = data.data1;
          myChart.data.datasets[1].data = data.data2;
          myChart.update();
        },
        error: function(data){
          console.log(data);
        }
      });
    }
    
    updateChart();
    setInterval(() => {
      updateChart();
    }, 1000);
  </script>
@endsection