<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'EVENTS_ST';
    protected $primaryKey = 'EVENT_ID';
    protected $foreignKey = 'ACCOUNT_ID';
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

/*     public function bookmark()
    {
        return $this->belongsTo(Bookmark::class, 'EVENT_ID', 'BOOKMARK_ID');
    } */

    public function account()
    {
        return $this->belongsTo(Account::class, 'ACCOUNT_ID');
    }

    public function facility()
    {
        return $this->belongsTo(Facility::class, 'FACILITY_ID')->withDefault();
    }

    /* public static function create(array $data)
    {
        $bookmark = new Bookmark();
        $bookmark->save();

        $event = new Event();
        $event->ACCOUNT_ID = $data['EVENT_ID'];
        $event->ACCOUNT_ID = $data['ACCOUNT_ID'];
        $event->FACILITY_ID = $data['FAICILITY_ID'];
        $event->TITLE = $data['TITLE'];
        $event->DESCRIPTION = $data['DESCRIPTION'];
        $event->STARTING_TIME = $data['STARTING_TIME'];
        $event->ENDING_TIME = $data['ENDING_TIME'];
        $event->WEBSITE_URL = $data['WEBSITE_URL'];
        $event->PHONE_NR = $data['PHONE_NR'];
        $event->EMAIL = $data['EMAIL'];
        $event->POSTAL_CODE = $data['POSTAL_CODE'];
        $event->CITY = $data['CITY'];
        $event->ADDRESS = $data['ADDRESS'];
        $event->IMAGE_PATH = $data['IMAGE_PATH'];
        $event->EVENT_TYPE = $data['EVENT_TYPE'];
        $event->save();
        return $event;
    } */
}
