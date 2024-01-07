@extends('adminlte::page')

@section('title', 'Edit group - ' . $group->title)

@section('content_header')
    <h1>Edit group - {{ $group->title }}</h1>
@endsection

@section('content')
    <div class="card card-primary">
        <form action="{{ route('group.update', $group->id) }}" method="POST">
            @csrf
            @method('patch')
            <div class="card-body">
                <div class="form-group col-md-6">
                    <label for="groupName">Group name</label>
                    <input type="text" name="title" class="form-control" id="groupName"
                        placeholder="Enter group name" value="{{ $group->title }}">
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
