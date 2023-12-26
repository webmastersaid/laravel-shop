@extends('adminlte::page')

@section('title', 'Create user')

@section('content_header')
    <h1>Create user</h1>
@endsection

@section('content')
    <div class="card card-primary">
        <form action="{{ route('user.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group col-md-6">
                    <label for="userName">Name</label>
                    <input type="text" value="{{ old('name') }}" name="name" class="form-control" id="userName"
                        placeholder="Bob">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="userSurname">Surname</label>
                    <input type="text" value="{{ old('surname') }}" name="surname" class="form-control" id="userSurname"
                        placeholder="Smith">
                    @error('surname')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="userPatronymic">Patronymic</label>
                    <input type="text" value="{{ old('patronymic') }}" name="patronymic" class="form-control"
                        id="userPatronymic" placeholder="Davidson">
                    @error('patronymic')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="userAge">Age</label>
                    <input type="number" value="{{ old('age') }}" name="age" class="form-control" id="userAge"
                        placeholder="25">
                    @error('age')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="userAddress">Address</label>
                    <input type="text" value="{{ old('address') }}" name="address" class="form-control" id="userAddress"
                        placeholder="Sreet, avenue">
                    @error('address')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="genderSelectBorder">Gender</label>
                    <select name="gender" class="custom-select" id="genderSelectBorder">
                        <option disabled selected>Not selected</option>
                        <option {{ old('gender') == 1 ? 'selected' : '' }} value="1">Male</option>
                        <option {{ old('gender') == 2 ? 'selected' : '' }} value="2">Female</option>
                    </select>
                    @error('gender')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="emailEmail">E-mail</label>
                    <input type="email" value="{{ old('email') }}" name="email" class="form-control" id="emailEmail"
                        placeholder="bob@example.com">
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="passwordPassword">Password</label>
                    <input type="password" value="{{ old('password') }}" name="password" class="form-control"
                        id="passwordPassword" placeholder="password">
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="passwordPassword">Confirm password</label>
                    <input type="password" value="{{ old('password_confirmation') }}" name="password_confirmation"
                        class="form-control" id="passwordPassword" placeholder="password">
                    @error('password_confirmation')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
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
