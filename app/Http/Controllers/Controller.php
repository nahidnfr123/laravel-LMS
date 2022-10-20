<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function photoUploader($file): array|string
    {
//        $name = $file->getClientOriginalName();
        $path = $file->store('public/uploads/img');
        return str_replace('public', '/storage', $path) ?? $path;
    }

    public function profileUpdate (Request $request): \Illuminate\Http\RedirectResponse
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
        return redirect()->route('home.profile');
    }
}
