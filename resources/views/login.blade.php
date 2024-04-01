@extends('layout')

@section('title', 'Login')

@section('content')
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <h2>Login on Blood Bank</h2>
                <form action="{{url('/login')}}" method="POST">
                    @csrf
                    <div class="mb-3 mt-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter email" value="{{old('email')}}" name="email" required>
                        <span class="text-danger">
                            @error('email')
                                {{$message}}
                            @enderror
                        </span>
                    </div>
                    <div class="mb-3">
                        <label for="pwd" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" required>
                        <span class="text-danger">
                            @error('password')
                                {{$message}}
                            @enderror
                        </span>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
@endsection