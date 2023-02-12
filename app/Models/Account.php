<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Account extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'ACCOUNTS_ST';
    protected $primaryKey = 'ACCOUNT_ID';
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        'USERNAME', 'EMAIL', 'PASSWORD', 'ACCOUNT_TYPE'
    ];

    protected $casts = [
        'IS_EMAIL_VERIFIED' => 'boolean',
        'email_verified_at' => 'datetime',
    ];

    protected $hidden = [
        'remember_token',
    ];

    public function bookmarks()
    {
        return $this->hasMany(AccountHasBookmarks::class, 'ACCOUNT_ID', 'ACCOUNT_ID')->with('event')->with('facility');
    }

    public function managesFacilities()
    {
        return $this->hasMany(AccountHasFacilities::class, 'ACCOUNT_ID', 'ACCOUNT_ID')->with('facility');
    }

    public function getAuthIdentifierName()
    {
        return $this->getKeyName();
    }

    public function getAuthPassword()
    {
        return $this->PASSWORD;
    }

    public function getRememberToken()
    {
        return $this->{$this->getRememberTokenName()};
    }

    public function setRememberToken($value)
    {
        $this->{$this->getRememberTokenName()} = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }
    public function getAuthIdentifier()
    {
        return $this->{$this->getAuthIdentifierName()};
    }
    public static function create(array $data)
    {
        $bookmark = new Bookmark();
        $bookmark->save();

        $account = new Account();
        $account->ACCOUNT_ID = $bookmark->BOOKMARK_ID;
        $account->NAME = $data['name'];
        $account->EMAIL = $data['email'];
        $account->PASSWORD = $data['password'];
        $account->ACCOUNT_TYPE = "Benutzer";
        $account->IS_EMAIL_VERIFIED = false;
        $account->save();
        return $account;
    }
}
