<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $table = 'FACILITIES_ST';
    protected $primaryKey = 'FACILITY_ID';
    public $timestamps = true;
    public $incrementing = false;

    protected $fillable = [
        'NAME', 'DESCRIPTION', 'WEBSITE_URL', 'PHONE_NR',
        'EMAIL', 'POSTAL_CODE', 'CITY', 'ADDRESS', 'IS_CITY_VERIFIED', 'FACILITY_TYPE', 'IMAGE_PATH', 'FACILITY_ID'
    ];

    public function managers()
    {
        // belong to many accounthasfacilities
        return $this->belongsToMany(Account::class, 'ACCOUNT_has_FACILITIES_JT', 'FACILITY_ID', 'ACCOUNT_ID');
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'FACILITY_ID', 'FACILITY_ID')->with(['account', 'facility']);
    }
    
    protected $casts = [
        'IS_CITY_VERIFIED' => 'boolean',
    ];
}