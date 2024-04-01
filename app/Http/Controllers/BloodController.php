<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\All_blood;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;



class BloodController extends Controller
{
    public function index(){
        $user = Auth::user();
        $perPage = 10;
        // $bloodRecords = All_blood::where('hospital_id', $user->id)->paginate($perPage);
        $bloodRecords = All_blood::with('hospital')->where('hospital_id', $user->id)->paginate($perPage);
        return view('add-blood', ['bloodRecords' => $bloodRecords]);
    }

    public function add_blood(Request $request){
        $request->validate([
            'blood_group' => 'required',
        ]);
        $b_group = new All_blood();
        $b_group->hospital_id = Auth::id();
        $b_group->blood_group = $request->blood_group;
        $b_group->save();
        return Redirect::to('/add-blood')->with('success', 'Blood Added');
    }
}
