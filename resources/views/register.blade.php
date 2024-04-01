@extends('layout')

@section('title', 'Register')

@section('content')
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <h2>Register on Blood Bank</h2>
                <form action="{{url('/register')}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="mb-3 mt-3">
                        <label for="type" class="form-label">Type:</label>
                        <select name="type" class="form-control" onchange="check_type()" id="type" required>
                            <option value="" selected disabled>Select your registration type</option>
                            <option value="Hospital" {{ old('type') == 'Hospital' ? 'selected' : '' }}>Hospital</option>
                            <option value="Receiver" {{ old('type') == 'Receiver' ? 'selected' : '' }}>Receiver</option>
                        </select>
                        <span class="text-danger">
                            @error('type')
                                {{$message}}
                            @enderror
                        </span>
                    </div>
                    <div id="hospital_details">
                        <div class="mb-3 mt-3">
                            <label for="hospital_name" class="form-label">Hospital Name:</label>
                            <input type="text" class="form-control" id="hospital_name" placeholder="Enter Hospital Name" name="hospital_name" value="{{old('hospital_name')}}" >
                            <span class="text-danger">
                                @error('hospital_name')
                                    {{$message}}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="hospital_add" class="form-label">Address:</label>
                            <input type="text" class="form-control" id="hospital_add" placeholder="Enter Hospital Address" name="hospital_address" value="{{old('hospital_address')}}" >
                            <span class="text-danger">
                                @error('hospital_address')
                                    {{$message}}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="hospital_state" class="form-label">State:</label>
                            <input type="text" class="form-control" id="hospital_state" placeholder="Enter Hospital State" name="hospital_state" value="{{old('hospital_state')}}" >
                            <span class="text-danger">
                                @error('hospital_state')
                                    {{$message}}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="hospital_image" class="form-label">Image:</label>
                            <input type="file" accept="image/*" class="form-control" id="hospital_image" name="hospital_image">
                            <span class="text-danger">
                                @error('hospital_image')
                                    {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div id="receiver_details">
                        <div class="mb-3 mt-3">
                            <label for="receiver_name" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="receiver_name" placeholder="Enter Name" name="receiver_name" value="{{old('receiver_name')}}" >
                            <span class="text-danger">
                                @error('receiver_name')
                                    {{$message}}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="receiver_blood" class="form-label">Blood Group:</label>
                            <select name="receiver_blood" class="form-control" id="receiver_blood">
                                <option value="">Select Blood Group</option>
                                <option value="A+" value="Receiver" {{ old('receiver_blood') == 'A+' ? 'selected' : '' }}>A+</option>
                                <option value="A-" value="Receiver" {{ old('receiver_blood') == 'A-' ? 'selected' : '' }}>A-</option>
                                <option value="B+" value="Receiver" {{ old('receiver_blood') == 'B+' ? 'selected' : '' }}>B+</option>
                                <option value="B-" value="Receiver" {{ old('receiver_blood') == 'B-' ? 'selected' : '' }}>B-</option>
                                <option value="AB+" value="Receiver" {{ old('receiver_blood') == 'AB+' ? 'selected' : '' }}>AB+</option>
                                <option value="AB-" value="Receiver" {{ old('receiver_blood') == 'AB-' ? 'selected' : '' }}>AB-</option>
                                <option value="O+" value="Receiver" {{ old('receiver_blood') == 'O+' ? 'selected' : '' }}>O+</option>
                                <option value="O-" value="Receiver" {{ old('receiver_blood') == 'O-' ? 'selected' : '' }}>O-</option>
                            </select>
                            <span class="text-danger">
                                @error('receiver_blood')
                                    {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email"  value="{{old('email')}}" required>
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
                    <div class="mb-3">
                        <label for="pwd1" class="form-label">Confirm Password:</label>
                        <input type="password" class="form-control" id="pwd1" onblur="check_pass()" placeholder="Confirm password" name="password_confirmation" required>
                        <span class="text-danger">
                            @error('password_confirmation')
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


@section('js')
<script>
    $(document).ready(function(){
        $("#receiver_details").hide();
        $("#hospital_details").hide();
        check_type();
    });
</script>

<script>
    function check_type(){
        type = $('#type').val();
        if(type=="Receiver"){
            $("#receiver_details").show();
            $("#hospital_details").hide();
            $("#receiver_name").prop('required', true);
            $("#receiver_blood").prop('required', true);
            $("#hospital_name").prop('required', false);
            $("#hospital_add").prop('required', false);
            $("#hospital_state").prop('required', false);
            $("#hospital_image").prop('required', false);
        }
        if (type=="Hospital"){
            $("#hospital_details").show();
            $("#receiver_details").hide();
            $("#receiver_name").prop('required', false);
            $("#receiver_blood").prop('required', false);
            $("#hospital_name").prop('required', true);
            $("#hospital_add").prop('required', true);
            $("#hospital_state").prop('required', true);
            $("#hospital_image").prop('required', true);
        }
    }
</script>

<script>
    function check_pass(){
        p = $("#pwd").val();
        p1 = $("#pwd1").val();
        if(p!=p1){
            $("#pwd1").css({'border-color': 'red'});
        }else{
            $("#pwd1").css({'border-color': 'green'});
        }
    }
</script>

<script>
    $(document).ready(function() {
        $('input[type="file"]').change(function() {
            let fileSize = this.files[0].size;
            let maxSize = 3 * 1024 * 1024;

            if (fileSize > maxSize) {
                Swal.fire({
                    text: "File size exceeds 3 MB.",
                    icon: "error",
                });
                $(this).val('');
            }
        });
    });
</script>
@endsection
