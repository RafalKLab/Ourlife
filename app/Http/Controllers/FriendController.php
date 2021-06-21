<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function getIndex(){
        $friends = Auth::user()->friends();
        $requests = Auth::user()->friendRequests();
        return view('friends.index', [
            'friends' => $friends,
            'requests' => $requests
        ]);
    }

    public function getAdd($username){
        $user = User::where('username', $username)->first();
        if(Auth::user()==$user){
            return redirect()->route('home')->with('info', 'You can not add yourself as friend...');
        }
        if(!$user){
            return redirect()->route('home')->with('info', 'User not found!');
        }
        if( Auth::user()->hasFriendRequestPending($user)
                || $user->hasFriendRequestReceived($user) ){
            return redirect()->route('profile.index', ['username' => $user->username])->with('info', 'User has friend request!');
        }
        if(Auth::user()->isFriendWith($user)){
            return redirect()->route('profile.index', ['username' => $user->username])->with('info', 'User is your friend!');
        }
        Auth::user()->addFriend($user);
        return redirect()->route('profile.index', ['username' => $username])->with('success', 'Request has been sent!');
    }

    public function getAccept($username){
        $user = User::where('username', $username)->first();

        if(Auth::user()==$user){
            return redirect()->route('home')->with('info', 'You can not add yourself as friend...');
        }
        if(!$user){
            return redirect()->route('home')->with('info', 'User not found!');
        }
        if(Auth::user()->isFriendWith($user)){
            return redirect()->route('profile.index', ['username' => $user->username])->with('info', 'User is your friend!');
        }
        if( !Auth::user()->hasFriendRequestReceived($user)){
            return redirect()->route('home');
        }
        Auth::user()->acceptFriendRequest($user);
        return redirect()->route('profile.index', ['username' => $username])->with('success', 'Friend request has been accepted!');
    }

    public function postDelete($username){
        $user = User::where('username', $username)->first();
        if(!Auth::user()->isFriendWith($user)){
            return redirect()->back();
        }
        Auth::user()->deleteFriend($user);
        return redirect()->back()->with('success', 'Friend has been removed!');
    }
}
