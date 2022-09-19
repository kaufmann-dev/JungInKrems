<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Thiagoprz\CompositeKey\HasCompositeKey;

class AccountHasBookmarks extends Model
{
    use HasFactory;
    use HasCompositeKey;
    
    protected $table = 'ACCOUNT_has_BOOKMARKS_JT';
    protected $primaryKey = ['ACCOUNT_ID','BOOKMARK_ID'];
    
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'BOOKMARK_ID', 'ACCOUNT_ID'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'BOOKMARK_ID', 'EVENT_ID')->with(['account', 'facility']);
    }

    public function facility()
    {
        return $this->belongsTo(Facility::class, 'BOOKMARK_ID', 'FACILITY_ID');
    }

    public static function find(array $ids)
    {
        return self::where('ACCOUNT_ID', $ids['ACCOUNT_ID'])->where('BOOKMARK_ID', $ids['BOOKMARK_ID'])->first();
    }
}
