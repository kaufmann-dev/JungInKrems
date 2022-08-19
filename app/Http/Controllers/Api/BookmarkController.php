<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

class BookmarkController extends Controller
{
    public function getBookmarks()
    {
        $bookmarks = request()->user()->bookmarks;
        return response()->json($bookmarks, 200);
    }
    
    public function deleteBookmark($id)
    {
        $bookmark = request()->user()->bookmarks()->where('BOOKMARK_ID', $id)->first();
        $bookmark->delete();

        return response()->json(['message' => 'Deleted bookmark.'], 200);
    }

    public function addBookmark($id)
    {
        $bookmark = request()->user()->bookmarks()->create([
            'BOOKMARK_ID' => $id,
            'ACCOUNT_ID' => request()->user()->ACCOUNT_ID,
        ]);

        return response()->json($bookmark, 200);
    }
}
