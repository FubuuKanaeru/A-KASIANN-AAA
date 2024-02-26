@extends('adminlte/app')
@section('title','Chart')
@section('active-chart','active')

@section('content')
    <livewire:petugas.Chart></livewire:petugas.Chart>
@endsection

@section('chart-script')
    <livewire:petugas.chart-script></livewire:petugas.chart-script>
@endsection