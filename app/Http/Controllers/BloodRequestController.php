<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Blood_request;
use App\Models\All_blood;
use Illuminate\Support\Facades\Redirect;



class BloodRequestController extends Controller
{
    public function index(){
        $user = Auth::user();

        if ($user->role === 'hospital') {
            $hospitalId = $user->id;
            $bloodRequests = Blood_request::whereHas('blood', function ($query) use ($hospitalId) {
                $query->where('hospital_id', $hospitalId);
            })->with(['blood', 'receiver'])->paginate(10);
        } elseif ($user->role === 'receiver') {
            $bloodRequests = $user->sentBloodRequests()->with('receiver')->paginate(10);
        } else {
            abort(403, 'Unauthorized action.');
        }

        return view('blood-request', ['bloodRequests' => $bloodRequests]);
    }

    public function add_request(Request $request){
        if (Auth::check() && Auth::user()->role === 'receiver') {
            $id = $request->route('blood_id');
            $bloodGroup = All_blood::find($id);
            if(Auth::user()->blood_group === $bloodGroup->blood_group){
                $b_request = new Blood_request();
                $b_request->receiver_id = Auth::id();
                $b_request->blood_group_requested = $id;
                if($b_request->save()){
                    $icon = "success";
                    $text = "Request Sent";
                }else{
                    $icon = "error";
                    $text = "Technical Error!!!";
                }
            }else{
                $icon = "error";
                $text = "Blood Group MisMatch your profile";
            }
        }else{
            $icon = "error";
            $text = "Only registered Receiver can request";
        }
        return Redirect::to('/')->with($icon, $text);
    }
}
