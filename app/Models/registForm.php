<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class registForm extends Model
{

    protected $fillable = ['organizer','address', 'contact', 'email', 'title', 'event_location', 'category', 'ticket_price', 'start_date', 'end_date','event_detail','account_number', 'event_website', 'status', 'identity_card', 'payment_proof','event_poster', 'event_logo'];

    protected $hidden = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
