<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function postStatus(Request $request){
        $this->validate($request, [
            'status' => 'required|max:1000'
            ]);
        Auth::user()->statuses()->create([
            'body' => $request->input('status')
        ]);
        return redirect()->route('home')->with('success', 'Post has been created!');
    }

    public function destroy($id){
        $status = Status::findOrFail($id);
        if(Auth::user()->id==$status->user_id){
            $status->delete();
            return redirect()->route('home')->with('success', 'You have deleted your post!');
        }
    }

    public function postReply(Request $request, $statusId)
    {
        $this->validate($request, [
            "reply-{$statusId}" => 'required|max:1000|'
        ]);
        $status = Status::notReply()->find($statusId);
        if (!$status) redirect()->route('home');
        if (!Auth::user()->isFriendWith($status->user)
            && Auth::user()->id !== $status->user->id) {
            return redirect()->route('home');
        }
        $reply = new Status();
        $reply->body = $request->input("reply-{$status->id}");
        $reply->user()->associate(Auth::user());
        $status->replies()->save($reply);
        return redirect()->back()->with('success', 'You have commented a post!');
    }

    public function getLike($statusId){
        $status = Status::find($statusId);
        if (!$status) redirect()->route('home');
        if(!Auth::user()->isFriendWith($status->user)){
            return redirect()->route('home');
        }
        if(Auth::user()->hasLikedStatus($status)){
            return redirect()->back();
        }
        $status->likes()->create(['user_id' => Auth::user()->id]);
        return redirect()->back();
    }
}
