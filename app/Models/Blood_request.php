<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blood_request extends Model
{
    use HasFactory;
    protected $table = "blood_request";
    protected $primaryKey = "id";

    public function blood(){
        return $this->belongsTo(All_blood::class, 'blood_group_requested', 'id');
    }
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
