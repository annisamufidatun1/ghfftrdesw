<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rumah extends Model
{
    use HasFactory;

    public function user(){
        return $rumah->belongsTo(User::class);
    }
}
