<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Rules\UniqueEmail;


class RegisterController extends Controller
{
    public function index(){
        return view('register');
    }

    public function register(Request $request){
        $request->validate([
            'type' => 'required',
            'email' => ['required', 'email', new UniqueEmail],
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        if ($request->type == 'Hospital') {
            $request->validate([
                'hospital_name' => 'required',
                'hospital_address' => 'required',
                'hospital_state' => 'required',
                'hospital_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:3072'
            ]);
        }
        if ($request->type == 'Receiver') {
            $request->validate([
                'receiver_name' => 'required',
                'receiver_blood' => 'required',
            ]);
        }

        $user = new User();
        $user->role = $request->type;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        if ($request->type == 'Hospital') {
            $user->name = $request->hospital_name;
            $user->address = $request->hospital_address;
            $user->state = $request->hospital_state;

            $image = $request->file('hospital_image');
            // $image_name = $image->getClientOriginalName();
            $image_name = time() . $image->getClientOriginalName();
            $image->storeAs('public/uploads',$image_name);
            // $hospitalImage = $request->file('hospital_image')->store('public/uploads');
            $user->hospital_image = $image_name;
        }
        if ($request->type == 'Receiver') {
            $user->name = $request->receiver_name;
            $user->blood_group = $request->receiver_blood;
        }
        $user->save();

        Auth::login($user);

        return Redirect::to('/')->with('success', 'Registration Done');
    }
}
