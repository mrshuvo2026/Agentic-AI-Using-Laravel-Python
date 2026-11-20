<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
     public function index()
    {
        // সব ইউজারকে লিস্ট আকারে আনা
        $users = User::latest()->paginate(10); 

        // ভিউতে পাঠানো
        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
{
    return view('admin.users.edit', compact('user'));
}

public function update(Request $request, User $user)
{
    $request->validate([
        'role' => 'required|in:admin,teacher,student',
    ]);

    $user->update(['role' => $request->role]);

    return redirect()->route('admin.users.index')->with('success', 'Role updated successfully.');
}

}
