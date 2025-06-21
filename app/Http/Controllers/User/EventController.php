<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\User; 
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index() {
        return auth()->user()->events;
    }

    public function store(Request $request) {
        return auth()->user()->events()->create($request->all());
    }

    public function show(Event $event) {
        return $event;
    }

    public function update(Request $request, Event $event) {
        if ($event->user_id !== auth()->id()) abort(403);
        $event->update($request->all());
        return $event;
    }

    public function destroy(Event $event) {
        if ($event->user_id !== auth()->id()) abort(403);
        $event->delete();
        return response()->json(['message' => 'Deleted']);
    }
}