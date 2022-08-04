<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function getBookmarks(Request $request)
    {
        $bookmarks = $request->user()->bookmarks;
        return response()->json($bookmarks, 200);
    }
    
    public function deleteBookmark(Request $request, $id)
    {
        $bookmark = $request->user()->bookmarks()->where('BOOKMARK_ID', $id)->first();
        $bookmark->delete();

        return response()->json(['message' => 'Deleted bookmark.'], 200);
    }

    public function addBookmark(Request $request, $id)
    {
        $bookmark = $request->user()->bookmarks()->create([
            'BOOKMARK_ID' => $id,
            'ACCOUNT_ID' => $request->user()->ACCOUNT_ID,
        ]);

        return response()->json($bookmark, 200);
    }
}
