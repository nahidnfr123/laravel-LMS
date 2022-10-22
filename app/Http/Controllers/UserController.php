<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function show(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $courses = auth()->user()->courses;
        return view('user.profile', compact('courses'));
    }

    public function edit(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('user.profileForm');
    }

    public function manage($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $user = User::findOrFail($id);
        $userPermissions = $user->getAllPermissions()->pluck('name')->toArray();
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.users.manage', compact('user', 'userPermissions', 'roles', 'permissions'));
    }

    public function manageUpdate(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $user = User::findOrFail($id);
        if ($request->permissions && count($request->permissions)) {
            $permissions = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
            if ($permissions) {
                $user->syncPermissions($permissions);
            }
        }
        return redirect()->route('admin.user.index');
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
        return redirect()->route('home.profile.show')->with('message', 'Profile Updated');
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
        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
        return redirect()->route('home.profile.show')->with('message', 'Password Updated');
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        abort_if(!auth()->user()->can('delete_user'), 403);
        User::findOrFail($id)->delete();
        return redirect()->back();
    }
}
