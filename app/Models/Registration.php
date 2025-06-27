<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $table = 'registrations';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'event_id',
        'qr_code',
        'payment_status',
        'transaction_proof_url'
    ];

    public function presence()
    {
        return $this->hasOne(Presence::class, 'registration_id', 'id');
    }

    public function certificate()
    {
        return $this->hasOne(Certificate::class, 'registration_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }
}
