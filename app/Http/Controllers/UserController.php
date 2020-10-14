<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Session;

class UserController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('auth.profile', compact('user'));
    }

    public function UserManage()
    {
        $user = user::all();
        return view('auth.user_manage', compact('user'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|email|unique:users,email,' . base64_decode($id),
            'phone' => 'max:26',
            'address' => 'max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000'
        ]);

        $user = user::findOrFail(base64_decode($id));
        if ($request->hasFile('image')) {
            if (File::exists($user->image) && 'assets/images/user.png' != $user->image) {
                File::delete($user->image);
            }
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileStore3 = rand(10, 100) . time() . "." . $extension;
            $request->file('image')->storeAs('public/user', $fileStore3);
            $image = 'storage/user/' . $fileStore3;
        } else {
            $image = $user->image;
        }

        User::findOrFail(base64_decode($id))->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'address' => $request['address'],
            'phone' => $request['phone'],
            'image' => $image,
        ]);

        Session::flash('message', 'Profile update successfully');
        return redirect()->back();
    }

    protected function ProfilePassword(Request $request, $id)
    {
        $request->validate([
            'old_password' => 'required|string|min:8',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::findOrFail(base64_decode($id));
        if (Hash::check($request->old_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request['password']),
            ]);
            Session::flash('message', 'Password change successfully');
            return redirect()->back();
        } else {
            return redirect()->back()->withErrors(['message' => ['Old password not match']]);
        }
    }

    public function destroy($id)
    {
        //
    }
}
