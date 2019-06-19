{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Marcando</h1>
@stop

@section('content')
    <p>Agendamento de quadras esportivas</p>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
 google.charts.load("current", {packages:["corechart"]});
 google.charts.setOnLoadCallback(drawChart);

 function drawChart() {
 var data = google.visualization.arrayToDataTable([['Nome da Quadra', 'Nº Agendamentos'],
 @foreach ($quadras as $quadra)
 {!! "['$quadra->nome', $quadra->num]," !!}
 @endforeach
 ]);
 var options = {
 title: 'Nº de agendamentos por quadra',
 is3D: true,
 };
 var chart = new google.visualization
 .PieChart(document.getElementById('piechart_3d'));
 chart.draw(data, options);
 }
</script>
<div id="piechart_3d" style="width: 900px; height: 500px;"></div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop