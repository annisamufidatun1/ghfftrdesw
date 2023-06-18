<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class event extends Model
{

    protected $fillable = ['title', 'event_location', 'category', 'ticket_price', 'start_date', 'end_date','event_detail', 'event_website', 'event_logo', 'event_poster'];

    protected $hidden = ['created_at', 'updated_at'];

}
