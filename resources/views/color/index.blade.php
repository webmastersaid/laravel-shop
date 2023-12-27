@extends('adminlte::page')

@section('title', 'Colors')

@section('content_header')
    <h1>Colors</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="{{ route('color.create') }}">Add</a>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>HEX</th>
                        <th>Color</th>
                        <th>Created</th>
                        <th>Updated</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($colors as $color)
                        <tr>
                            <td>{{ $color->id }}</td>
                            <td><a href="{{ route('color.show', $color->id) }}">#{{ $color->title }}</a></td>
                            <td style="background-color: #{{ $color->title }};"></td>
                            <td>{{ $color->created_at }}</td>
                            <td>{{ $color->updated_at }}</td>
                        </tr>
                    @endforeach
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
