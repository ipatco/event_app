<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class Users extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.manage', compact('users'));
    }

    public function sendLink(Request $request, $id)
    {
        $user = User::find($id);

        $status = Password::sendResetLink($user->email);

        return $status == Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))
            ->withErrors(['email' => __($status)]);
    }

    public function makeVendor($id)
    {
        $user = User::find($id);
        $user->role = 'vendor';
        $user->save();
        return back();
    }
}
