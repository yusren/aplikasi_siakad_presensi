<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('admins.index', [
            'users' => User::whereIn('role', ['superadmin', 'admin', 'lpm', 'kaprodi', 'birokeuangan'])->get(),
        ]);
    }

    public function create()
    {
        return view('admins.create', [
            'roles' => [
                'superadmin',
                'admin',
                'lpm',
                'kaprodi',
                'birokeuangan',
                'akademik',
                'Keuangan_SDM',
                'Kemahasiswaan',
            ],
            'prodi' => Prodi::get(),
        ]);
    }

    public function store(AdminRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect(route('admin.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    public function show(User $admin)
    {
        dd($admin);
    }

    public function edit(User $admin)
    {
        return view('admins.edit', [
            'admin' => $admin,
            'roles' => [
                'superadmin',
                'admin',
                'lpm',
                'kaprodi',
                'birokeuangan',
            ],
            'prodi' => Prodi::get(),
        ]);
    }

    public function update(Request $request, User $admin)
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required',
            'role' => 'required',
            'status' => 'required',
            'email' => 'required|email|unique:users,email,'.$admin->id,
            'password' => 'same:confirm-password',
        ]);

        $data = $request->all();
        if (! empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            $data = Arr::except($data, ['password']);
        }

        $admin->update($data);

        return redirect(route('admin.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    public function destroy(User $admin)
    {
        $admin->delete();

        return redirect(route('admin.index'))->with('toast_error', 'Berhasil Menghapus Data!');
    }
}
