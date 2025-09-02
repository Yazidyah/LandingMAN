<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        if (auth()->user()->name !== 'superadmin') {
            return redirect()->route('admin.dashboard');
        }
        // Ambil semua user kecuali yang namanya "superadmin", urutkan berdasarkan id
        $users = User::where('name', '!=', 'superadmin')->orderBy('id')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);
        // Set email otomatis dari nama user
        $validated['email'] = $request->name . '@man1kotabogor.id';
        $validated['password'] = bcrypt($validated['password']);
        User::create($validated);
        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password);
        }
        $user->update($validated);
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
        {
            $user = User::findOrFail($id);
            if ($user->name === 'superadmin') {
                return redirect()->route('admin.users.index')->with('error', 'Tidak dapat menghapus superadmin.');
            }
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
        }
}
