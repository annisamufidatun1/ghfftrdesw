<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bookmark extends Model
{
    use HasFactory;

    protected $table = "bookmark";

    protected $fillable = ['id_user','id_event'];
}
