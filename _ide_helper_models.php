<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Account
 *
 * @property int $ACCOUNT_ID
 * @property string $NAME
 * @property string $EMAIL
 * @property string $PASSWORD
 * @property bool $IS_EMAIL_VERIFIED
 * @property string $ACCOUNT_TYPE
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AccountHasBookmarks> $bookmarks
 * @property-read int|null $bookmarks_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AccountHasFacilities> $managesFacilities
 * @property-read int|null $manages_facilities_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|Account newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Account newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Account query()
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereACCOUNTID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereACCOUNTTYPE($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereEMAIL($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereISEMAILVERIFIED($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereNAME($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account wherePASSWORD($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereUpdatedAt($value)
 */
	class Account extends \Eloquent implements \Illuminate\Contracts\Auth\Authenticatable {}
}

namespace App\Models{
/**
 * App\Models\AccountHasBookmarks
 *
 * @property int $BOOKMARK_ID
 * @property int $ACCOUNT_ID
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Event $event
 * @property-read \App\Models\Facility $facility
 * @method static \Illuminate\Database\Eloquent\Builder|AccountHasBookmarks newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountHasBookmarks newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountHasBookmarks query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountHasBookmarks whereACCOUNTID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountHasBookmarks whereBOOKMARKID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountHasBookmarks whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountHasBookmarks whereUpdatedAt($value)
 */
	class AccountHasBookmarks extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AccountHasFacilities
 *
 * @property int $FACILITY_ID
 * @property int $ACCOUNT_ID
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \App\Models\Account $account
 * @property-read \App\Models\Facility $facility
 * @method static \Illuminate\Database\Eloquent\Builder|AccountHasFacilities newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountHasFacilities newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountHasFacilities query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountHasFacilities whereACCOUNTID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountHasFacilities whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountHasFacilities whereFACILITYID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountHasFacilities whereUpdatedAt($value)
 */
	class AccountHasFacilities extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Bookmark
 *
 * @property int $BOOKMARK_ID
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Bookmark newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bookmark newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bookmark query()
 * @method static \Illuminate\Database\Eloquent\Builder|Bookmark whereBOOKMARKID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bookmark whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bookmark whereUpdatedAt($value)
 */
	class Bookmark extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Event
 *
 * @property int $EVENT_ID
 * @property int $ACCOUNT_ID
 * @property int|null $FACILITY_ID
 * @property string $TITLE
 * @property \Illuminate\Support\Carbon $STARTING_TIME
 * @property \Illuminate\Support\Carbon|null $ENDING_TIME
 * @property string|null $WEBSITE_URL
 * @property string|null $PHONE_NR
 * @property string|null $EMAIL
 * @property string $POSTAL_CODE
 * @property string $CITY
 * @property string $ADDRESS
 * @property string $IMAGE_PATH
 * @property string $DESCRIPTION
 * @property string $EVENT_TYPE
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Account $account
 * @property-read \App\Models\Facility|null $facility
 * @method static \Illuminate\Database\Eloquent\Builder|Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event query()
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereACCOUNTID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereADDRESS($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCITY($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereDESCRIPTION($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereEMAIL($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereENDINGTIME($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereEVENTID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereEVENTTYPE($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereFACILITYID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereIMAGEPATH($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event wherePHONENR($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event wherePOSTALCODE($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereSTARTINGTIME($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereTITLE($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereWEBSITEURL($value)
 */
	class Event extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Facility
 *
 * @property int $FACILITY_ID
 * @property string $NAME
 * @property string $DESCRIPTION
 * @property string $WEBSITE_URL
 * @property string $PHONE_NR
 * @property string $EMAIL
 * @property string $POSTAL_CODE
 * @property string $CITY
 * @property string $ADDRESS
 * @property int $IS_CITY_VERIFIED
 * @property string $FACILITY_TYPE
 * @property string $IMAGE_PATH
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AccountHasBookmarks $manager
 * @method static \Illuminate\Database\Eloquent\Builder|Facility newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Facility newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Facility query()
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereADDRESS($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereCITY($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereDESCRIPTION($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereEMAIL($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereFACILITYID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereFACILITYTYPE($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereIMAGEPATH($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereISCITYVERIFIED($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereNAME($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility wherePHONENR($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility wherePOSTALCODE($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereWEBSITEURL($value)
 */
	class Facility extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Request
 *
 * @property int $REQUEST_ID
 * @property int $ACCOUNT_ID
 * @property int $FACILITY_ID
 * @property string $REQUEST_TYPE
 * @property string $STATUS
 * @property string|null $MESSAGE
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Request newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Request newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Request query()
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereACCOUNTID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereFACILITYID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereMESSAGE($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereREQUESTID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereREQUESTTYPE($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereSTATUS($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereUpdatedAt($value)
 */
	class Request extends \Eloquent {}
}

