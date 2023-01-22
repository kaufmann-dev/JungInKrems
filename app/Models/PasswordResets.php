<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordResets extends Model
{
    protected $table = 'password_resets';
    protected $primaryKey = 'email';
    protected $keyType = 'string';
    
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'email', 'token', 'created_at'
    ];
    
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}