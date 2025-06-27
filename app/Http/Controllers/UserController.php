<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::whereIn('role', ['tim keuangan', 'panitia']);

        if ($request->has('filter') && in_array($request->filter, ['tim keuangan', 'panitia'])) {
            $query->where('role', $request->filter);
        }

        $data = $query->orderBy('created_at', 'asc')->get();

        return view('user.index', [
            'users' => $data
        ]);
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $validatedData = validator($request->all(), [
            'txtName' => 'required|string|max:255',
            'txtUsername' => 'required|string|max:100',
            'txtPassword' => 'required|string|min:6|max:255',
            'txtConfPassword' => 'required|string|same:txtPassword',
            'txtRole' => 'required|string|in:panitia,tim keuangan',
            'txtStatus' => 'required|boolean',
        ], [
            'txtConfPassword.same' => 'Konfirmasi password tidak sama.',
        ])->validate();

        $user = new User();
        $user->name = $validatedData['txtName'];
        $user->username = $validatedData['txtUsername'];
        $user->password = Hash::make($validatedData['txtPassword']);
        $user->role = $validatedData['txtRole'];
        $user->status = $validatedData['txtStatus'];
        $user->save();

        return redirect(route('userList'));
    }

    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validatedData = validator($request->all(), [
            'txtName' => 'required|string|max:255',
            'txtUsername' => 'required|string|max:100',
            'txtRole' => 'required|string|in:panitia,tim keuangan',
            'txtStatus' => 'required|boolean',
        ])->validate();

        $user->name = $validatedData['txtName'];
        $user->username = $validatedData['txtUsername'];
        $user->role = $validatedData['txtRole'];
        $user->status = $validatedData['txtStatus'];
        $user->save();

        return redirect(route('userList'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect(route('userList'));
    }
}
