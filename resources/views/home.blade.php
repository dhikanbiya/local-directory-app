@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1>hello {{Auth::user()->name}}</h1>
	<div class="col-md-6">
		<p>
			Total user : {{$user}} <br>
			Total SKPD : {{$office}} <br>
			Total Tempat Ibadah : {{$worship}}<br>
			Total Pom Bensin : {{$fuel}}<br>
			Total Tempat Hiburan dan Belanja : {{$site}} <br>
			Total Restoran : {{$restaurant}}
		</p>
	</div>
	<div class='col-md-5'>
	<div id='chart'>
	</div>
    </div>
</div>
@endsection
@section('javascript')
@parent
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>

<script>

Highcharts.chart('chart', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
    },
    title: {
        text: 'Jumlah fasilitas Kota Tangerang Selatan'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 35,
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            }
        }
    },
    series: [{
        type: 'pie',
        name: 'fasilitas',
        data: [
            ['Tempat Ibadah', {{$worship}}],
            ['SKPD', {{$office}}],
            ['Pom Bensin', {{$fuel}}],
            ['Restoran', {{$restaurant}}],
            ['Tempat hiburan',{{$site}}]
        ]
    }]
});


</script>
@endsection
