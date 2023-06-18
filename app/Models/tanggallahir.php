<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tanggallahir extends Model
{
    use HasFactory;
    public function user(){
        return $tanggallahir->belongsTo(User::class, 'id');
    }
}
