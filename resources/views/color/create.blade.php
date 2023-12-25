@extends('adminlte::page')

@section('title', 'Create color')

@section('content_header')
<h1>Create color</h1>
@endsection

@section('content')
<div class="card card-primary">
    <form action="{{ route('color.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group col-md-6">
                <label for="colorName">HEX</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">#</span>
                    </div>
                    <input type="text" name="title" class="form-control" id="colorName" placeholder="000000" maxlength="6">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('/css/admin_custom.css') }}">
@endsection

@section('js')
<script src="{{ asset('/js/admin_custom.js') }}"></script>
@endsection