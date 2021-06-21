<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function getProfile($username){
        $user = User::where('username', $username)->first();
        $user_copy = $user;
        if(!$user){
            abort(404);
        }
        return view('profile.index', compact('user', 'user_copy'));
    }

    public function getEdit(){
        return view('profile.edit');
    }

    public function postEdit(Request $request){
        $this->validate($request, [
            'first_name' => 'alpha|min:2|max:50',
            'last_name' => 'alpha|min:2|max:50',
            'location' => 'min:2|max:20',
        ]);
        $newImageName = time() . '-' . Auth::user()->username . '.' . $request->photo->extension();
        $request->photo->move(public_path('images'), $newImageName);
        Auth::user()->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'location' => $request->input('location'),
            'photo_path' => $newImageName
        ]);
        return redirect()
               ->route('profile.edit')
               ->with('success', 'Profile has been updated');
    }
}
