<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class All_blood extends Model
{
    use HasFactory;
    protected $table = "all_blood";
    protected $primaryKey = "id";

    public function hospital()
    {
        return $this->belongsTo(User::class, 'hospital_id');
    }
}
