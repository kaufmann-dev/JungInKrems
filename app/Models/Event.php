<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'EVENTS_ST';
    protected $primaryKey = 'EVENT_ID';
    
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'ACCOUNT_ID', 'EVENT_ID', 'TITLE', 'WEBSITE_URL', 'PHONE_NR', 'EMAIL', 'POSTAL_CODE', 'CITY', 'ADDRESS', 'IMAGE_PATH', 'EVENT_TYPE', 'DESCRIPTION', 'STARTING_TIME', 'ENDING_TIME', 'FACILITY_ID'
    ];

    protected $casts = [
        'DESCRIPTION' => 'string',
        'STARTING_TIME' => 'datetime',
        'ENDING_TIME' => 'datetime',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'ACCOUNT_ID', 'ACCOUNT_ID')->select('ACCOUNT_ID', 'NAME');
    }

    public function facility()
    {
        return $this->belongsTo(Facility::class, 'FACILITY_ID', 'FACILITY_ID')->with("managers")->withDefault();
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        // Return the date as a string without any timezone conversion
        return $date->format('Y-m-d H:i:s');
    }
}
