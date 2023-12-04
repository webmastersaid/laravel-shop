@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@endsection

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('/css/admin_custom.css')}}">    
@endsection

@section('js')
    <script src="{{asset('/js/admin_custom.js')}}"></script>
@endsection