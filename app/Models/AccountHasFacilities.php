<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Thiagoprz\CompositeKey\HasCompositeKey;

class AccountHasFacilities extends Model
{
    use HasFactory;
    use HasCompositeKey;

    protected $table = 'ACCOUNT_has_FACILITIES_JT';
    protected $primaryKey = ['ACCOUNT_ID', 'FACILITY_ID'];
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'ACCOUNT_ID',
        'FACILITY_ID'
    ];

    public function facility()
    {
        return $this->belongsTo(Facility::class, 'FACILITY_ID', 'FACILITY_ID');
    }

    public function account()
    {
        return $this->belongsTo(Account::class, 'ACCOUNT_ID', 'ACCOUNT_ID');
    }
}
