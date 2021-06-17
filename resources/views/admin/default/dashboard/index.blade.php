@extends('admin::layout')

@section('content')

<div class="row my-1 min-h-title">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>
    </div>
    <div class="col-lg-6">
        <div class="d-flex align-items-center justify-content-between justify-content-md-start h-100">
            <h1>Welcome !</h1>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <p>Selamat Datang Kembali <strong>{{ config('username') }}</strong>, Anda Login Sebagai <strong>{{ Auth::user()->roles->pluck('name')[0] }} </strong></p>
        <p>Visit your site here <a class="btn btn-primary ml-1 visit-site" href="{{ url('/') }}" target="_blank">Visit Site</a></p>
    </div>
</div>

<div class="card bg-gradient-info">
    <div class="row">
      
        <div class="card-body">
            <div class="col-lg-6">
                <div class="d-flex my-2 align-items-center justify-content-between justify-content-md-start h-100">
                    <h1>Statistik Pengunjung</h1>
                </div>
            </div>
            <div class="col-md-12">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link border active" id="pills-day-tab" data-toggle="pill" href="#pills-day" role="tab" aria-controls="pills-day" aria-selected="true">Day</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white border" id="pills-week-tab" data-toggle="pill" href="#pills-week" role="tab" aria-controls="pills-week" aria-selected="false">Week</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white border" id="pills-month-tab" data-toggle="pill" href="#pills-month" role="tab" aria-controls="pills-month" aria-selected="false">Month</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white border" id="pills-year-tab" data-toggle="pill" href="#pills-year" role="tab" aria-controls="pills-year" aria-selected="false">Year</a>
                    </li>
                </ul>
                <div class="tab-content px-md-1 py-4 py-md-5">
                    <div class="tab-pane fade show active" id="pills-day" role="tabpanel" aria-labelledby="pills-day-tab">
                        <div class="badge badge-info statistic-time">
                            15 Feb 2020 - 21 Feb 2020
                        </div>
                        <canvas id="daily"  style="min-height: 350px; height: 350px; max-height: 350px; max-width: 100%;"></canvas>
                    </div>
                    <div class="tab-pane fade" id="pills-week" role="tabpanel" aria-labelledby="pills-week-tab">
                        <div class="badge badge-info statistic-time">
                            1st Week Jan 2020 - 3rd Week Feb 2020
                        </div>
                        <canvas id="weekly"   style="min-height: 350px; height: 350px; max-height: 350px; max-width: 100%;"></canvas>
                    </div>
                    <div class="tab-pane fade" id="pills-month" role="tabpanel" aria-labelledby="pills-month-tab">
                        <div class="badge badge-info statistic-time">
                            Aug 2019 - Feb 2020
                        </div>
                        <canvas id="monthly"   style="min-height: 350px; height: 350px; max-height: 350px; max-width: 100%;"></canvas>
                    </div>
                    <div class="tab-pane fade" id="pills-year" role="tabpanel" aria-labelledby="pills-year-tab">
                        <div class="badge badge-info statistic-time">
                            2014 - 2020
                        </div>
                        <canvas id="yearly"  style="min-height: 350px; height: 350px; max-height: 350px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Chart JS -->
<link rel="stylesheet" type="text/css" href="{{ theme_asset('backend::default', '/vendor/chartjs-2.9.3/chart.min.css') }}"/>
<script type="text/javascript" src="{{ theme_asset('backend::default', '/vendor/chartjs-2.9.3/chart.min.js') }}"></script>
<script type="text/javascript">
    var salesGraphChartCanvas = $('#daily').get(0).getContext('2d');
  //$('#revenue-chart').get(0).getContext('2d');

  var salesGraphChartData = {
    labels  : ['2011 Q1', '2011 Q2', '2011 Q3', '2011 Q4', '2012 Q1', '2012 Q2', '2012 Q3', '2012 Q4', '2013 Q1', '2013 Q2'],
    datasets: [
      {
        label               : 'Digital Goods',
        fill                : false,
        borderWidth         : 2,
        lineTension         : 0,
        spanGaps : true,
        borderColor         : '#efefef',
        pointRadius         : 3,
        pointHoverRadius    : 7,
        pointColor          : '#efefef',
        pointBackgroundColor: '#efefef',
        data                : [2666, 2778, 4912, 3767, 6810, 5670, 4820, 15073, 10687, 8432]
      }
    ]
  }

  var salesGraphChartOptions = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
      display: false,
    },
    scales: {
      xAxes: [{
        ticks : {
          fontColor: '#efefef',
        },
        gridLines : {
          display : false,
          color: '#efefef',
          drawBorder: false,
        }
      }],
      yAxes: [{
        ticks : {
          stepSize: 5000,
          fontColor: '#efefef',
        },
        gridLines : {
          display : true,
          color: '#efefef',
          drawBorder: false,
        }
      }]
    }
  }

  // This will get the first returned node in the jQuery collection.
  var salesGraphChart = new Chart(salesGraphChartCanvas, { 
      type: 'line', 
      data: salesGraphChartData, 
      options: salesGraphChartOptions
    }
  )
</script>
@endsection