@extends('layout')

@section('title', 'Add Blood')

@section('content')
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <h2>Add Blood Group</h2>
                <form action="{{url('/add-blood')}}" method="POST">
                    @csrf
                    <div class="mb-3 mt-3">
                        <label for="blood_group" class="form-label">Blood Group:</label>
                        <select name="blood_group" class="form-control" id="blood_group">
                            <option value="">Select Blood Group</option>
                            <option value="A+" value="Receiver" {{ old('blood_group') == 'A+' ? 'selected' : '' }}>A+</option>
                            <option value="A-" value="Receiver" {{ old('blood_group') == 'A-' ? 'selected' : '' }}>A-</option>
                            <option value="B+" value="Receiver" {{ old('blood_group') == 'B+' ? 'selected' : '' }}>B+</option>
                            <option value="B-" value="Receiver" {{ old('blood_group') == 'B-' ? 'selected' : '' }}>B-</option>
                            <option value="AB+" value="Receiver" {{ old('blood_group') == 'AB+' ? 'selected' : '' }}>AB+</option>
                            <option value="AB-" value="Receiver" {{ old('blood_group') == 'AB-' ? 'selected' : '' }}>AB-</option>
                            <option value="O+" value="Receiver" {{ old('blood_group') == 'O+' ? 'selected' : '' }}>O+</option>
                            <option value="O-" value="Receiver" {{ old('blood_group') == 'O-' ? 'selected' : '' }}>O-</option>
                        </select>
                        <span class="text-danger">
                            @error('blood_group')
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

    <div class="container h-100 mt-4">
        <h2 class="text-center">My Blood Groups</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Blood Group</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bloodRecords as $bloodRecord)
                    <tr>
                        <td>{{ $bloodRecord->blood_group }}</td>
                        <td>{{ $bloodRecord->created_at->format('M d, Y h:i A') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection