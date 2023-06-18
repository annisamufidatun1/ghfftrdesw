<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hobi extends Model
{
    use HasFactory;
    public function user(){
        return $hobi->belongsTo(User::class, 'id');
    }
}
