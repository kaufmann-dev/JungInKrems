<?php

namespace App\Http\Controllers\Api;

use App\Models\Event;
use App\Http\Controllers\Controller;
use App\Models\AccountHasBookmarks;
use App\Models\Bookmark;
use App\Http\Traits\EventTrait;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    use EventTrait;

    public function getEvents()
    {
        $events = Event::all();
        return response()->json($events, 200);
    }

    public function getEvent($id)
    {
        $event = Event::with(['account'])->find($id);
        return response()->json($event, 200);
    }

    public function addEvent()
    {
        $this->validateRequest(request());
        $this->requireUpdate(request());
        $this->requireNew(request());

        $file = request()->file('IMAGE');
        $fileName = $file->getClientOriginalName();

        Storage::disk('uploads')->putFileAs('/images/uploads', $file, $fileName);

        request()->merge(['IMAGE_PATH' => $fileName]);


        if(!request()->has('EVENT_ID')) {
            $bookmark = Bookmark::create();
            $bookmark->save();
            request()->merge(['EVENT_ID' => $bookmark->BOOKMARK_ID]);
        }
        if(!request()->has('ACCOUNT_ID')) {
            request()->merge(['ACCOUNT_ID' => request()->user()->ACCOUNT_ID]);
        }
        if(!request()->has('EVENT_TYPE')) {
            request()->merge(['EVENT_TYPE' => 'Freizeit']);
        }
        
        $event = Event::create(request()->all());
        
        if(request()->user()->ACCOUNT_TYPE == 'Benutzer') {
            request()->user()->ACCOUNT_TYPE = 'Veranstalter';
            request()->user()->save();
        }

        return response()->json($event, 200);
    }

    public function updateEvent($id)
    {
        $this->validateRequest(request());
        $this->requireUpdate(request());

        if(request()->has('IMAGE')){
            $file = request()->file('IMAGE');
            $fileName = $file->getClientOriginalName();
            Storage::disk('uploads')->putFileAs('/images/uploads', $file, $fileName);
            request()->merge(['IMAGE_PATH' => $fileName]);
        }

        $event = Event::find($id);
        if(!request()->has('EVENT_TYPE')) {
            request()->merge(['EVENT_TYPE' => 'Freizeit']);
        }
        $event->update(request()->all());

        return response()->json($event, 200);
    }

    public function deleteEvent($id)
    {
        $event = Event::find($id);
        $event->delete();

        $bookmarks = AccountHasBookmarks::where('BOOKMARK_ID', $id)->get();
        foreach($bookmarks as $bookmark) {
            $bookmark->delete();
        }

        return response()->json(['message' => "Deleted event."], 200);
    }
}