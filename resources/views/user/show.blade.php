@extends('adminlte::page')

@section('title', 'User - ' . $user->name)

@section('content_header')
    <h1>user - {{ $user->name }}</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-flex">
            <div class="p-1">
                <a class="btn btn-primary" href="{{ route('user.edit', $user->id) }}">Edit</a>
            </div>
            <div class="p-1">
                <form action="{{ route('user.delete', $user->id) }}" method="POST">
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
                        <td>{{ $user->id }}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>Surname</th>
                        <td>{{ $user->surname }}</td>
                    </tr>
                    <tr>
                        <th>Patronymic</th>
                        <td>{{ $user->patronymic }}</td>
                    </tr>
                    <tr>
                        <th>Age</th>
                        <td>{{ $user->age }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $user->address }}</td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td>{{ $user->genderTitle }}</td>
                    </tr>
                    <tr>
                        <th>E-mail</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Created</th>
                        <td>{{ $user->created_at }}</td>
                    </tr>
                    <tr>
                        <th>Updated</th>
                        <td>{{ $user->updated_at }}</td>
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
