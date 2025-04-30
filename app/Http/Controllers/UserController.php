<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return view('pages.user.index', compact('users'));
    }

    public function create()
    {

        return view('pages.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:128',
            'email' => 'required|string|email|max:128|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('users', 'public');
            }
    
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'image' => $imagePath,
                'password' => Hash::make($request->password),
                'is_active' => $request->is_active
            ]);
            //update nilai user di dasboard secara realtime
            event(new MessageSent('300'));

            return redirect()->route('user.index')->with('success', 'Users created successfully.');   
        } catch (Exception $e) {
            Log::error('Error saving user: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Failed to create user: ' , $e->getMessage());
        } 
    }

    public function show(User $user) {
        return view('pages.user.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('pages.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:128',
            'email' => 'required|string|email|max:128|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'sometimes'
        ]);

        if ($request->filled('password')) {
            $validatedData['password'] = bcrypt($request->password);
        } else {
            unset($validatedData['password']);
        }

        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::delete('public/images/' . $user->image);
            }
            $validatedData['image'] = $request->file('image')->store('images', 'public');
        }

        $validatedData['is_active'] = $request->has('is_active') ? 't' : 'f';

        $user->update($validatedData);
        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
}
