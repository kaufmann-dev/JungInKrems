<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Foundation\Auth\User as Authenticatable;
use \Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
// can reset password
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
// use ResetPasswordNotification
use App\Notifications\ResetPasswordNotification;
// use reset password
use Illuminate\Auth\Notifications\ResetPassword;
// email verification
use App\Notifications\VerifyEmailNotification;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;

class Account extends Model implements Authenticatable, CanResetPasswordContract, MustVerifyEmailContract
{

    use HasApiTokens, HasFactory, Notifiable, CanResetPassword, MustVerifyEmail;

    protected $table = 'ACCOUNTS_ST';
    protected $primaryKey = 'ACCOUNT_ID';
    public $timestamps = true;
    public $incrementing = true;
    protected $emailVerifiedColumn = 'IS_EMAIL_VERIFIED';

    protected $fillable = [
        'NAME', 'EMAIL', 'PASSWORD', 'ACCOUNT_TYPE', 'IS_EMAIL_VERIFIED'
    ];

    protected $casts = [
        'IS_EMAIL_VERIFIED' => 'boolean',
    ];

    protected $hidden = [
        'REMEMBER_TOKEN', 'pivot',
        'PASSWORD'
    ];

    // ------------------- RELATIONSHIPS ------------------- //

    public function bookmarks()
    {
        return $this->hasMany(AccountHasBookmarks::class, 'ACCOUNT_ID', 'ACCOUNT_ID')->with('event')->with('facility');
    }

    public function managesFacilities()
    {
        return $this->hasMany(AccountHasFacilities::class, 'ACCOUNT_ID', 'ACCOUNT_ID')->with('facility');
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'ACCOUNT_ID', 'ACCOUNT_ID');
    }

    public function requests()
    {
        return $this->hasMany(Request::class, 'ACCOUNT_ID', 'ACCOUNT_ID');
    }

    // ------------------- IMPLEMENTATION ------------------- //

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
        return 'REMEMBER_TOKEN';
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

    public function getEmailForPasswordReset()
    {
        return $this->EMAIL;
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function getEmailForVerification()
    {
        return $this->EMAIL;
    }
    
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification());
    }
    
    public function markEmailAsVerified()
    {
        return $this->forceFill([
            'IS_EMAIL_VERIFIED' => true,
        ])->save();
    }

    public function hasVerifiedEmail()
    {
        return $this->IS_EMAIL_VERIFIED;
    }
}
