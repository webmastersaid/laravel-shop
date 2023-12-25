@extends('adminlte::page')

@section('title', 'Create tag')

@section('content_header')
    <h1>Create tag</h1>
@endsection

@section('content')
    <div class="card card-primary">
        <form action="{{ route('tag.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group col-md-6">
                    <label for="tagName">Tag name</label>
                    <input type="text" name="title" class="form-control" id="tagName" placeholder="Enter tag name">
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
