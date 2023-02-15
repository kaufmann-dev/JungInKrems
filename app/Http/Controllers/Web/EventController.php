<?php

namespace App\Http\Controllers\Web;

use App\Models\Event;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Traits\EventTrait;
use App\Models\Bookmark;

class EventController extends Controller
{
    use EventTrait;

    public function createEvent()
    {
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
        
        $this->validateRequest(request());
        $event = Event::create(request()->all());
        /* return redirect()->route('events'); */
    }

    public function updateEvent($id)
    {
        $event = Event::find($id);
        
        if(!request()->has('EVENT_TYPE')) {
            request()->merge(['EVENT_TYPE' => 'Freizeit']);
        }
        $this->validateRequest(request());
        $event->update(request()->all());
    }

    public function deleteEvent($id)
    {
        $event = Event::find($id);
        $event->delete();
    }
}