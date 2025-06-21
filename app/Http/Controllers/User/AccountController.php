<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function update(Request $request) {
        auth()->user()->update($request->all());
        return auth()->user();
    }

    public function destroy() {
        auth()->user()->delete();
        return response()->json(['message' => 'Account deleted']);
    }
}