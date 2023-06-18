<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ratingReview extends Model
{
    use HasFactory;

    protected $table = "rating_review";

    protected $fillable = ['rating','review','id_event','id_user'];
}
