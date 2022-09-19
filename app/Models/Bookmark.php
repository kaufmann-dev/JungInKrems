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
}
