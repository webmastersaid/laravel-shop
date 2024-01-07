@extends('adminlte::page')

@section('title', 'Create group')

@section('content_header')
    <h1>Create group</h1>
@endsection

@section('content')
    <div class="card card-primary">
        <form action="{{ route('group.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group col-md-6">
                    <label for="groupName">Group name</label>
                    <input type="text" name="title" class="form-control" id="groupName" placeholder="Enter group name">
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
