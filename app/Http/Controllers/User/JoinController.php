<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;

class JoinController extends Controller
{
    public function join(Event $event) {
        auth()->user()->joinedEvents()->syncWithoutDetaching($event->id);
        return response()->json(['message' => 'Joined']);
    }

    public function history() {
        return auth()->user()->joinedEvents;
    }

    public function participants(Event $event) {
        return $event->participants;
    }
    public function giveFeedback(Request $request, $eventId){
    $request->validate([
        'rating' => 'nullable|integer|min:1|max:5',
        'feedback' => 'nullable|string',
    ]);

    $user = auth()->user();

    $record = DB::table('event_user')
        ->where('event_id', $eventId)
        ->where('user_id', $user->id)
        ->first();

    if (!$record) {
        return response()->json(['message' => 'You did not join this event'], 403);
    }

    DB::table('event_user')
        ->where('event_id', $eventId)
        ->where('user_id', $user->id)
        ->update([
            'rating' => $request->rating,
            'feedback' => $request->feedback,
            'updated_at' => now(),
        ]);

    return response()->json(['message' => 'Feedback submitted successfully']);
}

}

