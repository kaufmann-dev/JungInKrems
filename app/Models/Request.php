<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $table = 'REQUESTS_ST';
    public $timestamps = true;
    protected $primaryKey = 'REQUEST_ID';
    public $incrementing = true;

    protected $fillable = [
        'ACCOUNT_ID', 'FACILITY_ID', 'REQUEST_TYPE', 'STATUS', 'MESSAGE', 'REQUEST_ID'
    ];

    public function account()
    {
        return $this->belongsTo(AccountHasFacility::class, 'ACCOUNT_ID', 'ACCOUNT_ID');
    }

    public function facility()
    {
        return $this->belongsTo(AccountHasFacility::class, 'FACILITY_ID', 'FACILITY_ID');
    }
}
