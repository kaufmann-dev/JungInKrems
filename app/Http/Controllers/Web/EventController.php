<?php

namespace App\Http\Controllers\Web;

use App\Models\Event;
use App\Http\Controllers\Controller;
use App\Http\Traits\EventTrait;
use App\Models\AccountHasBookmarks;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    use EventTrait;

    public function createEvent()
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
        
        Event::create(request()->all());
        
        if(request()->user()->ACCOUNT_TYPE == 'Benutzer') {
            request()->user()->ACCOUNT_TYPE = 'Veranstalter';
            request()->user()->save();
        }
    }

    public function adminUpdateEvent($id)
    {
        $this->validateRequest(request());
        $this->requireUpdate(request());
        $this->requireAdminUpdate(request());

        if(request()->has('IMAGE')) {
            $file = request()->file('IMAGE');
            $fileName = $file->getClientOriginalName();
            Storage::disk('uploads')->putFileAs('/images/uploads', $file, $fileName);
            request()->merge(['IMAGE_PATH' => $fileName]);
        }

        $event = Event::find($id);
        
        $event->update(request()->all());
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
    }

    public function deleteEvent($id)
    {
        $event = Event::find($id);
        $event->delete();

        $bookmarks = AccountHasBookmarks::where('BOOKMARK_ID', $id)->get();
        foreach($bookmarks as $bookmark) {
            $bookmark->delete();
        }
    }
}