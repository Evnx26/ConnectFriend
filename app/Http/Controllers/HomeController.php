<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Work;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home(){
        $user = Auth::user();
        $friendSuggestions = $user->getNonFriends();
        $works = Work::all();
        return view('home.index', compact('friendSuggestions', 'works'));
    }

    public function profile(){
        $user = Auth::user();
        $friends = $user->friends()
            ->wherePivot('status', 'accepted')
            ->get()
            ->merge(
                $user->friendRequests()
                    ->wherePivot('status', 'accepted')
                    ->get()
            );
        $requests = Auth::user()->friendRequests->where('pivot.status', 'pending');
        return view('home.profile', compact('friends', 'requests'));
    }
}

