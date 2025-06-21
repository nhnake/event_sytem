<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index() {
        return Event::all();
    }

    public function store(Request $request) {
        return Event::create($request->all());
    }

    public function show(Event $event) {
        return $event;
    }

    public function update(Request $request, Event $event) {
        $event->update($request->all());
        return $event;
    }

    public function destroy(Event $event) {
        $event->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
