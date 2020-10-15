<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id){
        $user = User::find($id);
        return view('users/show',compact(('user')));
    }

    public function edit(User $user,$id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $user = User::find($request->id);
        if ($request->user_profile_photo !=null) {
            $request->user_profile_photo->storeAs('public/user_images', $user->id . '.jpg');
            $user->profile_photo = $user->id . '.jpg';
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect('/');
    }

}
