<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    protected $table = 'BOOKMARKS_BT';
    protected $primaryKey = 'BOOKMARK_ID';
    public $incrementing = true;
    public $timestamps = true;

    /* public function account()
    {
        return $this->hasOne(Account::class, 'BOOKMARK_ID', 'ACCOUNT_ID');
    }

    public function event()
    {
        return $this->hasOne(Event::class, 'BOOKMARK_ID', 'EVENT_ID');
    }

    public static function getEvents()
    {
        return Event::all();
    } */
}
