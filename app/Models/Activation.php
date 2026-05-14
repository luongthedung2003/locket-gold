<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'plan_id',
        'locket_username',
        'locket_uid',
        'status',
        'notes',
        'dns_link'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
