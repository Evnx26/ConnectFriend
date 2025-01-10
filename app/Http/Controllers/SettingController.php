<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hobby;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function index(){
        $works = Work::all();
        $userWorks = Auth::user()->works->pluck('id')->toArray();
        return view('home.settings', compact('works', 'userWorks'));
    }

    public function setAccountVisible(Request $request){
        $user = User::find(Auth::id());
        $currentVisibility = $user->account_visible;
        
        if(!$request->has('visibility') && $currentVisibility === 1){
            return back()->with('error', 'Your account is already visible.');
        }

        if(!$request->has('visibility') && $currentVisibility === 0){
            return back()->with('error', 'Your account is already invisible.');
        }

        if($request->has('visibility')){
            if($user->coin < 65) {
                return back()->with('error', 'You dont have enough coins to make account invisible');
            }
            
            $user->account_visible = 0;
            $user->coins -= 65;

            $avatarImage = ['avatar/avatar-1.png', 'avatar/avatar-2.png'];
            $randomAvatar = $avatarImage[array_rand($avatarImage)];
            $user->avatar_image = $randomAvatar;

            $user->save();

            return back()->with('success', 'Your account visibility set to invisible. 65 coins deducted.');
        }

        if(!$request->has('visibility')){
            if($user->coins < 10){
                return back()->with('error', 'You dont have enough coins to make account visible');
            }

            if($user->avatar_image){

            }

            $user->account_visible = 1;
            $user->coins -= 5;

            $user->save();

            return back()->with('success', 'Your account visibility set to visible. 10 coins deducted.');
        }
    }

    public function updatePassword(Request $request){
        $request->validate([
            'current_password' => 'required', 
            'password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if(!Hash::check($request->current_password, $user->password)){
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->password = bcrypt($request->password);
        $user->save();

        Auth::logout();

        return redirect()->route('login')->with('success', 'Successfully update the password');
    }

    public function updateProfile(Request $request){
        $request->validate([
            'name' => 'required|string|max:255', 
            'description' => 'nullable|string|max:500',
            'linkedin' => 'nullable|string|max:50',
            'work' => 'required|array|min:3', 
            'phone' => ['required', 'numerinc'], 
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', 
            'email' => 'required|email|unique:users,email,' . Auth::id()
        ]);

        $user = Auth::user();

        $user->name = $request->name;
        $user->description = $request->description;
        $user->linkedin = $request->linkedin;
        $user->phone_number = $request->phone;
        $user->email = $request->email;
        $user->works()->sync($request->work);

        if($request->hasFile('profile_image')){
            $file = $request->file('profile_image')->store('profile_image', 'public'); 
            $user->profile_image = $file;
        }

        $user->save();

        return back()->with('success', 'Successfully updated Your profile');
    }
}
