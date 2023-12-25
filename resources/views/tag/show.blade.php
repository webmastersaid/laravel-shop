@extends('adminlte::page')

@section('title', 'Tag - ' . $tag->title)

@section('content_header')
    <h1>Tag - {{ $tag->title }}</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-flex">
            <div class="p-1">
                <a class="btn btn-primary" href="{{ route('tag.edit', $tag->id) }}">Edit</a>
            </div>
            <div class="p-1">
                <form action="{{ route('tag.delete', $tag->id) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <td>{{ $tag->id }}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{ $tag->title }}</td>
                    </tr>
                    <tr>
                        <th>Created</th>
                        <td>{{ $tag->created_at }}</td>
                    </tr>
                    <tr>
                        <th>Updated</th>
                        <td>{{ $tag->updated_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/admin_custom.css') }}">
@endsection

@section('js')
    <script src="{{ asset('/js/admin_custom.js') }}"></script>
@endsection
