<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FriendController extends Controller
{
    public function sendRequest(Request $request) {
        try {
            $user = Auth::user(); // User login saat ini
            $friend = User::find($request->friend_id); // User yang akan dikirim request
    
            if (!$friend) {
                return response()->json(['message' => 'Friend not found'], 404);
            }
    
            if ($user->id === $friend->id) {
                return response()->json(['message' => 'You cannot send a friend request to yourself'], 400);
            }
    
            // Cek apakah request sudah ada
            $existingRequest = $user->friendRequests()
                ->where('friend_id', $friend->id)
                ->wherePivot('status', 'pending')
                ->exists();
    
            if ($existingRequest) {
                return response()->json(['message' => 'Friend request already sent'], 400);
            }
    
            // Cek apakah mereka sudah berteman
            $alreadyFriends = $user->friends()
                ->wherePivot('status', 'accepted')
                ->where('id', $friend->id)
                ->exists();
    
            if ($alreadyFriends) {
                return response()->json(['message' => 'You are already friends'], 400);
            }
    
            // Kirim request
            $user->friendRequests()->attach($friend->id, ['status' => 'pending']);
    
            return response()->json(['message' => 'Friend request sent'], 200);
        } catch (\Exception $e) {
            Log::error('Error in sendRequest: ' . $e->getMessage());
            return response()->json(['message' => 'An internal error occurred'], 500);
        }
    }
    

    public function acceptRequest(User $user, User $friend)
    {
        try {
            if (!$friend) {
                return response()->json(['message' => 'User not found'], 404);
            }

            if (
                $user->friends()
                ->where(function ($query) use ($friend) {
                    $query->where('friend_id', $friend->id)
                        ->orWhere('user_id', $friend->id);
                })
                ->wherePivot('status', 'accepted')
                ->exists()
            ) {
                return response()->json(['message' => 'Friend already accepted'], 400);
            }

            $user->friendRequests()->updateExistingPivot($friend->id, ['status' => 'accepted']);

            return response()->json(['message' => 'Friend request accepted']);
        } catch (\Exception $e) {
            Log::error('Error in acceptRequest: ' . $e->getMessage());
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function removeFriend(User $user, User $friend)
    {
        $firstDirection = $user->friends()->where('friend_id', $friend->id)->exists();

        $secondDirection = $friend->friends()->where('friend_id', $user->id)->exists();

        if (!$firstDirection && !$secondDirection) {
            return response()->json(['message' => 'Friend not found'], 404);
        }

        if ($firstDirection) {
            $user->friends()->detach($friend->id);
        }

        if ($secondDirection) {
            $friend->friends()->detach($user->id);
        }

        return response()->json(['message' => 'Friend removed successfully'], 200);
    }
}
