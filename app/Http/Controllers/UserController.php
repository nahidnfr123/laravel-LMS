<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $courses = auth()->user()->courses;
        return view('user.profile', compact('courses'));
    }

    public function edit(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('user.profileForm');
    }

    public function update(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required|min:3|max:40',
            'phone' => 'required',
            'avatar' => 'nullable|sometimes|image|mimes:jpg,png,jpeg,gif,svg|max:4048',
            'dob' => '',
            'gender' => '',
        ]);
        $data = $request->all();
        $user = \App\Models\User::findOrFail(auth()->id());
        unset($data['avatar']);
        if ($request->hasFile('avatar')) {
            $data['avatar'] = $this->photoUploader($request->file('avatar'));
        }
        $user->update($data);
        return redirect()->route('home.profile')->with('message', 'Profile Updated');
    }

    public function passwordEdit(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('user.passwordUpdateForm');
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        return redirect()->route('home.profile')->with('message', 'Password Updated');
    }
}
