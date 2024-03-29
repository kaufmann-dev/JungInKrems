<?php

namespace App\Http\Middleware\Web;

use Closure;

class BookmarkOwner
{
    public function handle($request, Closure $next)
    {
        $bookmarkId = $request->route('id');

        if($request->user()->bookmarks->contains('BOOKMARK_ID', $bookmarkId) || $request->user()->ACCOUNT_TYPE == 'Systemverwalter')
            return $next($request);
        
        return abort(403, 'Sie sind nicht der Besitzer dieses Lesezeichens.');
    }
}
