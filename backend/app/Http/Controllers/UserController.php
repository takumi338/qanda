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
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect('/');
    }

}
