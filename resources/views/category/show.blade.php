@extends('adminlte::page')

@section('title', 'Category - ' . $category->title)

@section('content_header')
    <h1>Category - {{ $category->title }}</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-flex">
            <div class="p-1">
                <a class="btn btn-primary" href="{{ route('category.edit', $category->id) }}">Edit</a>
            </div>
            <div class="p-1">
                <form action="{{ route('category.delete', $category->id) }}" method="POST">
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
                        <td>{{ $category->id }}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{ $category->title }}</td>
                    </tr>
                    <tr>
                        <th>Created</th>
                        <td>{{ $category->created_at }}</td>
                    </tr>
                    <tr>
                        <th>Updated</th>
                        <td>{{ $category->updated_at }}</td>
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
