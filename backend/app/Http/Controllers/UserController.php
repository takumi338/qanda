<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{

    public function show($id){
        $user = User::find($id);
        $posts = Post::where('user_id', $id)
            ->orderBy('created_at', 'desc')->paginate(5);
        return view('users/show',compact('user','posts'));
    }

    public function edit(User $user,$id)
    {
        $user = User::find($id);
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $user = User::find($request->id);
        if ($request->user_profile_photo !=null) {
            $request->user_profile_photo->storeAs('public/user_images', $user->id . '.jpg');
            $user->profile_photo = $user->id . '.jpg';
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        \Session::flash('flash_message','編集成功しました。');
        return redirect('/');
    }

    public function destroy(Request $request,User $user)
    {
        $user = User::find($request->id);
        $user->delete();
        
        \Session::flash('flash_message','削除成功しました。');
        return redirect('/');
    }

}
