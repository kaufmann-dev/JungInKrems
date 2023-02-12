<?php

namespace App\Http\Controllers\Web;

use App\Models\AccountHasBookmarks;
use App\Http\Controllers\Controller;

class BookmarkController extends Controller
{
    public function deleteBookmark($id)
    {
        $bookmark = AccountHasBookmarks::find(['ACCOUNT_ID' => request()->user()->ACCOUNT_ID, 'BOOKMARK_ID' => $id]);
        $bookmark->delete();
    }

    public function createBookmark($id)
    {
        $bookmark = AccountHasBookmarks::create(['ACCOUNT_ID' => request()->user()->ACCOUNT_ID, 'BOOKMARK_ID' => $id]);
    }
}
