@extends('adminlte::page')

@section('title', 'Color - ' . $color->title)

@section('content_header')
    <h1>Color - {{ $color->title }}</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-flex">
            <div class="p-1">
                <a class="btn btn-primary" href="{{ route('color.edit', $color->id) }}">Edit</a>
            </div>
            <div class="p-1">
                <form action="{{ route('color.delete', $color->id) }}" method="POST">
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
                        <td>{{ $color->id }}</td>
                    </tr>
                    <tr>
                        <th>HEX</th>
                        <td>#{{ $color->title }}</td>
                    </tr>
                    <tr>
                        <th>Color</th>
                        <td><div style="width: 16px; height: 16px; background: #{{ $color->title }};"></div></td>
                    </tr>
                    <tr>
                        <th>Created</th>
                        <td>{{ $color->created_at }}</td>
                    </tr>
                    <tr>
                        <th>Updated</th>
                        <td>{{ $color->updated_at }}</td>
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
