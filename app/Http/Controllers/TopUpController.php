<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TopUpController extends Controller
{
    public function add($amount){
        $user = Auth::user();
        $user->coins += $amount;
        $user->save();

        return redirect()->route('home.topup')->with('success', 'Successfully top up');
    }
}
