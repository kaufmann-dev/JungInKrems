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
 */
	class Account extends \Eloquent implements \Illuminate\Contracts\Auth\Authenticatable {}
}

namespace App\Models{
/**
 * App\Models\AccountHasBookmarks
 *
 * @property-read \App\Models\Event|null $event
 * @property-read \App\Models\Facility|null $facility
 * @method static \Illuminate\Database\Eloquent\Builder|AccountHasBookmarks newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountHasBookmarks newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountHasBookmarks query()
 */
	class AccountHasBookmarks extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AccountHasFacilities
 *
 * @property-read \App\Models\Account|null $account
 * @property-read \App\Models\Facility|null $facility
 * @method static \Illuminate\Database\Eloquent\Builder|AccountHasFacilities newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountHasFacilities newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountHasFacilities query()
 */
	class AccountHasFacilities extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Bookmark
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Bookmark newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bookmark newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bookmark query()
 */
	class Bookmark extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Event
 *
 * @property-read \App\Models\Account|null $account
 * @property-read \App\Models\Facility|null $facility
 * @method static \Illuminate\Database\Eloquent\Builder|Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event query()
 */
	class Event extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Facility
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Event> $events
 * @property-read int|null $events_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AccountHasFacilities> $managers
 * @property-read int|null $managers_count
 * @method static \Illuminate\Database\Eloquent\Builder|Facility newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Facility newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Facility query()
 */
	class Facility extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Request
 *
 * @property-read \App\Models\Account|null $account
 * @property-read \App\Models\Facility|null $facility
 * @method static \Illuminate\Database\Eloquent\Builder|Request newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Request newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Request query()
 */
	class Request extends \Eloquent {}
}

