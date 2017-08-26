<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $messages = $user->messages()->get();
        $messagesCount = $user->messages()->count();
        $userImage = $user->photo;
        if($userImage == null){
            $userImage = "https://graph.facebook.com/2014093932159244/picture?type=large";
        }
//        dd($messagesCount);
        return view('home',['messagesCount' => $messagesCount , 'messages' => $messages , 'userImage' => $userImage , 'user' => $user]);
    }
}
