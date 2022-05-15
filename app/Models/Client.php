<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    public $fillable = [
        'agent_id',
        'first_name',
        'last_name',
        'follow_up_date',
        'inq',
        'web',
        'status',
        'start_date',
        'notice',
        'insurer',
        'cover',
        'respond',
        'remark',
        'contact',
        'email'
    ];

    public $timestamps = false;

    public function agent() {
        return $this->belongsTo(User::class, 'agent_id', 'id', 'first_name');
    }
    
}
