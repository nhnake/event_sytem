<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * Display a listing of all users (excluding admins).
     */
    public function index(): JsonResponse
    {
        $users = User::where('role', 'user')->get();

        return response()->json([
            'users' => $users
        ]);
    }
}
