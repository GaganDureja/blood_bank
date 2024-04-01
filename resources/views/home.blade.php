@extends('layout')

@section('title', 'Home')

@section('content')
    <div class="container h-100">
        <div class="row">
            <h2 class="text-center">Available Blood Samples</h2>
            @foreach ($allBloodGroups as $bloodGroup)
                <div class="col-md-3">
                    <div class="card m-2">
                        <div class="card-body">
                            <img class="card-img-top" src="{{ asset('storage/uploads/' .$bloodGroup->hospital->hospital_image) }}" alt="Card image" style="width:100%">
                            <h4 class="card-title">{{$bloodGroup->blood_group}}</h4>
                            <p class="card-text">
                                {{$bloodGroup->hospital->name}}<br>
                                {{$bloodGroup->hospital->address}}<br>
                                {{$bloodGroup->hospital->state}}
                            </p>
                            @if (Auth::guest())
                                <a href="{{url('/login')}}" class="btn btn-primary">Request</a>
                            @endif
                            @if (Auth::check() && Auth::user()->role == "receiver" && Auth::user()->blood_group == $bloodGroup->blood_group)
                                <a href="{{url('/send-blood-request/' . $bloodGroup->id)}}" class="btn btn-primary">Request</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-md-12 mt-4">
                {{ $allBloodGroups->links() }}
            </div>
        </div>
    </div>
@endsection


