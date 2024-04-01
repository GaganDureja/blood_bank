@extends('layout')

@section('title', 'Blood Request')

@section('content')
    <div class="container h-100">
        <h2 class="text-center">Blood Requests </h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Blood Group</th>
                    @if(Auth::user()->role !== 'hospital')
                    <th>Hospital</th>
                    @else
                    <th>Receiver</th>
                    @endif
                    <th>Status</th>
                    @if(Auth::user()->role === 'hospital')
                    <th>Update Status</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($bloodRequests as $bloodRequest)
                    <tr>
                        <td>{{$bloodRequest->blood->blood_group}}</td>
                        @if(Auth::user()->role !== 'hospital')
                            <td>
                                {{$bloodRequest->blood->hospital->name}}<br>
                                {{$bloodRequest->blood->hospital->address}}<br>
                                {{$bloodRequest->blood->hospital->state}}
                            </td>
                        @else
                            <td>{{$bloodRequest->receiver->name}}</td>
                        @endif
                        <td>{{$bloodRequest->status}}</td>
                        @if(Auth::user()->role === 'hospital')
                        <td>
                            <button class="btn btn-success" data-id="{{$bloodRequest->id}}" data-action="Confirm" onclick="update_status(this)"> Confirm</button>
                            <button class="btn btn-danger" data-id="{{$bloodRequest->id}}" data-action="Delete" onclick="update_status(this)"> Delete</button>
                        </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('js')
<script>
    function update_status(evt){
        id = evt.getAttribute('data-id');
        action = evt.getAttribute('data-action');
        // perform action

        Swal.fire({
            text: action+" action is performed on ID-"+id,
            icon: "success",
        });
    }
</script>
@endsection
