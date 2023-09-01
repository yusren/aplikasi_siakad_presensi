<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index', [
            'users' => User::where('role', ['dosen', 'mahasiswa'])->get(),
        ]);
    }

    public function create()
    {
        return view('users.create', [
            'roles' => [
                'dosen',
                'mahasiswa',
            ],
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required',
            'role' => 'required',
            'status' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'same:confirm-password',
        ]);
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect(route('user.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    public function show(User $user)
    {
        dd($user);
    }

    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user,
            'roles' => [
                'dosen',
                'mahasiswa',
            ],
        ]);
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required',
            'role' => 'required',
            'status' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'same:confirm-password',
        ]);

        $data = $request->all();
        if (! empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            $data = Arr::except($data, ['password']);
        }

        $user->update($data);

        return redirect(route('user.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect(route('user.index'))->with('toast_success', 'Berhasil Menghapus Data!');
    }
}
